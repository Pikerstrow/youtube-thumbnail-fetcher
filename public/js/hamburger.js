class Hamburger {
    isActive = false;

    constructor() {
        this.registerEvents();
    }

    registerEvents() {
        this.menuClickListener();
    }

    getScrollbarWidth = () => {
        return window.innerWidth - document.documentElement.clientWidth;
    }

    menuClickListener() {
        const self = this;
        $('#hamburger_menu').on('click', function() {
            self.isActive = !self.isActive;

            if (self.isActive) {
                let marginRight = self.getScrollbarWidth();
                document.documentElement.style.overflow = 'hidden';
                document.body.style.marginRight = marginRight + 'px';

                $(this).find('span').addClass('active');
                $('#nav-menu-list').addClass('active');
            } else {
                document.documentElement.style.overflow = 'auto';
                document.body.style.marginRight = '0px';

                $(this).find('span').removeClass('active');
                $('#nav-menu-list').removeClass('active');
            }
        })
    }
}

$(document).ready(() => {
    new Hamburger();
});
