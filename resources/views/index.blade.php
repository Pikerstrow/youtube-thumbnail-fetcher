<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ __('views.title') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


</head>
<body class="app-container">
<header class="app-header">
    <nav class="app-nav">
        <div class="nav-item-container">
            <img src="{{ url('images/youtube_logo.png') }}" class="logo-img">
            <span class="logo-txt">Youtube Thumbnail Picker</span>
        </div>
        <div class="nav-item-container">
            <a href="{{ url('/en') }}" class="a-lng" title="english">
                <img src="{{ url('images/united_kingdom.png') }}" class="a-img" alt="english">
            </a>
            <a href="{{ url('/ru') }}" class="a-lng" title="русский">
                <img src="{{ url('images/russian.png') }}" class="a-img" alt="русский">
            </a>
        </div>
    </nav>
</header>

<section id="app" style="display:flex; flex: 1; flex-direction: column; align-items: center;">

    <section class="app-content-section">
        <h1>{{ __('views.h1') }}</h1>
        <p>{{ __('views.description') }}</p>
        <div class="notes-div">
            <span class="note_title">{{ __('views.note') }}</span>
            <span class="note_txt">{{ __('views.note_txt') }}</span>
        </div>

        <section class="input-group-section">
            <article class="input-group">
                <form>
                    <input
                        placeholder="https://www.youtube.com/watch?v=XvtrI5hOIij7"
                        v-model="youtube_url"
                        @focus="error = null"
                        type="text"
                        name="youtube_url"
                    >
                    <div class="err-container">
                        <span class="error-txt" v-if="error">@{{ error }}</span>
                    </div>
                    <button @click="sendUrl()" type="button" class="submit-btn">
                        <span v-if="!is_data_loading">{{ __('views.fetch') }}</span>
                        <img style="width: 25px; height: 25px" v-else src="{{ asset('images/preloader.gif') }}">
                    </button>
                </form>
            </article>
        </section>
    </section>

    <section v-if="Object.keys(thumbnails_data).length" class="app-content-section" >
        <article class="result-container">
            <h2>{{ __('views.result_title') }}:</h2>
            <p class="result-resolution">@{{ max_resolution_thumbnail.width }} x @{{ max_resolution_thumbnail.height }}</p>
            <div class="result-img-container">
                <img class="result-img" :src="max_resolution_thumbnail.url">
            </div>
            <div class="result-description">
                <p style="text-align: center">
                    <span class="note_title">{{ __('views.note') }}</span><span class="note_txt">{{ __('views.links_note') }}</span>
                </p>
                <h3>{{ __('views.h3_links') }}</h3>
                <div class="table-responsive" style="margin-bottom: 30px;">
                    <table class="links-table">
                        <thead>
                        <tr>
                            <td>{{ __('views.resolution') }}</td>
                            <td>{{ __('views.link') }}</td>
                        </tr>
                        </thead>
                        <tr v-for="(thumbnail, index) in thumbnails_data.thumbnails">
                            <td>
                                @{{ thumbnail.width }} x @{{ thumbnail.height }}
                            </td>
                            <td>
                                <a :href="thumbnail.url" target="_blank">@{{ thumbnail.url }}</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <h3>{{ __('views.h3_zip') }}</h3>
                <div class="zip-link-container">
                    <a :href="thumbnails_data.zip_archive_url" class="zip-url">
                        <img style="width: 32px; margin-right: 10px" src="{{ asset('images/archive.png') }}"> <span>thumbnails.zip</span>
                    </a>
                </div>
                <p style="text-align: center">
                    <span class="note_title">{{ __('views.note') }}</span><span class="note_txt">{{ __('views.archive_note') }}</span>
                </p>
                <div class="zip-link-container">
                    <div @click="clearResults()" class="skip-btn">
                        {{ __('views.clear') }}
                    </div>
                </div>
            </div>
        </article>
    </section>
</section>
<footer class="app-footer">
    &copy; @php echo date("Y"); @endphp&nbsp; <span class="logo-txt-footer">Youtube Thumbnail Picker</span>
</footer>
<script src="{{ mix('js/app.js')  }}"></script>
</body>
</html>
