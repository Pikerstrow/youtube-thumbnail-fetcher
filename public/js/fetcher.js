class Fetcher {
    thumbnails_data = {};
    max_resolution_thumbnail = {};
    error = null;
    youtube_url = null;
    is_data_loading = false;

    constructor() {
        this.registerEvents();
    }

    registerEvents() {
        this.fetchBtnClickListener();
        this.clearResultsBtnClickListener();
    }

    fetchBtnClickListener() {
        const self = this;
        $('#app').on('click', '#sendUrl', function() {
            const btn = $(this);
            let youtubeUrl = $('#youtube_url').val().trim();
            if (!youtubeUrl || self.is_data_loading) {
                return;
            }
            self.youtube_url = youtubeUrl;

            //Make Request
            self.is_data_loading = true;
            self.showBtnPreloader(btn);
            axios.post('/api/fetch-thumbnail', {youtube_url: youtubeUrl})
                .then(response => {
                    if (!response.data) {
                        return self.error = 'Something went wrong...';
                    }
                    self.thumbnails_data = response.data;
                    self.defineMaxResolutionImg(response.data);
                    self.handleResponse();
                })
                .catch(err => {
                    if (err && err.response && err.response.data && err.response.data.errors) {
                        self.error = err.response.data.errors['youtube_url'][0];
                    } else if (err && err.response && err.response.data && err.response.data.message) {
                        self.error = err.response.data.message;
                    } else {
                        self.error = 'Something went wrong...';
                    }
                    if (self.error) {
                        $('.err-container').find('.error-txt').text(self.error);
                    }
                })
                .finally(() => {
                    self.hideBtnPreloader(btn);
                    self.is_data_loading = false;
                });

        })
    }

    clearResultsBtnClickListener() {
        $('#clearResults').on('click', () => {
            this.clearResults();
        })
    }

    handleResponse() {
        $('#zip-archive-url').attr('href', this.thumbnails_data.zip_archive_url);
        $('#thumbnails-table-wrap').html(this.thumbnails_data.thumbnails_table_html);
        $('#result-img').attr('src', this.max_resolution_thumbnail.url);
        $('#result-resolution').text(`${this.max_resolution_thumbnail.width} x ${ this.max_resolution_thumbnail.height}`)
        $('#fetch-result').removeClass('d-none');
    }

    clearResults() {
        this.thumbnails_data = {};
        this.max_resolution_thumbnail = {};
        this.error = null;
        this.youtube_url = null;
        $('#fetch-result').addClass('d-none');
        $('.err-container').find('.error-txt').text('');
        $('#zip-archive-url').attr('href', '#');
        $('#thumbnails-table-wrap').html('');
        $('#result-resolution').text('');
        $('#result-img').attr('src', '#');
    }

    defineMaxResolutionImg(data) {
        let thumbnails = data.thumbnails;
        let maxResolutionWidth = 0;
        let maxResolutionImg;
        for (let key in thumbnails) {
            if (thumbnails[key].width > maxResolutionWidth) {
                maxResolutionWidth = thumbnails[key].width;
                maxResolutionImg = thumbnails[key];
            }
        }
        this.max_resolution_thumbnail = maxResolutionImg;
    }

    showBtnPreloader = (btn, size = 26) => {
        $(btn).find('.btn-text').addClass('d-none');
        let style = '';
        let html = `
            <div class="preloader-ajax z-50">
                <div style="width:${size}px; height:${size}px; ${style}" class="preloader-ajax__loader"></div>
            </div>
        `;
        $(btn).append(html);
    }

    hideBtnPreloader = (btn) => {
        $(btn).find('.preloader-ajax').remove();
        $(btn).find('.btn-text').removeClass('d-none');
    }
}

$(document).ready(() => {
    new Fetcher();
});
