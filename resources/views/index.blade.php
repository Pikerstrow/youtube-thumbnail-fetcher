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
            <a href="#" class="a-lng" title="english">
                <img src="{{ url('images/united_kingdom.png') }}" class="a-img" alt="english">
            </a>
            <a href="#" class="a-lng" title="русский">
                <img src="{{ url('images/russian.png') }}" class="a-img" alt="русский">
            </a>
        </div>
    </nav>
</header>

<section id="app" style="display:flex; flex: 1">
    <section v-if="Object.keys(thumbnails_data).length" class="app-content-section" >
        <article class="result-container">
            <h2>{{ __('views.result_title') }}:</h2>
            <p class="result-resolution">@{{ max_resolution_thumbnail.width }} x @{{ max_resolution_thumbnail.height }}</p>
            <div class="result-img-container">
                <img class="result-img" :src="max_resolution_thumbnail.url">
            </div>
            <div class="result-description">
                <p>
                    You can download this image by right click of the mouse or use links below. Also you can download zip archive
                    with all available resolutions. Please, pay attention, that link for zip archive is valid only or 24 hours.
                </p>
                <div class="resources-container">
                    <table>
                        <thead>
                        <tr>
                            <td>Resolution</td>
                            <td>Link</td>
                        </tr>
                        </thead>
                        <tr v-for="(thumbnail, index) in thumbnails_data.thumbnails">
                            <td>
                                @{{ thumbnail.width }} x @{{ thumbnail.height }}
                            </td>
                            <td>
                                @{{ thumbnail.url }}
                            </td>
                        </tr>
                    </table>
                    <div>
                        <a :href="thumbnails_data.zip_archive_ur">
                            <img style="width: 20px" src="{{ asset('images/archive.png') }}"> Archive
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section v-else class="app-content-section">
        <h1>{{ __('views.h1') }}</h1>
        <p>{{ __('views.description') }}</p>
        <div>
            <span class="note_title">{{ __('views.note') }}</span>
            <span class="note_txt">{{ __('views.note_txt') }}</span>
        </div>

        <section class="input-group-section">
            <aside>
                <div class="adds-container">
                </div>
            </aside>
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
                    <button @click="sendUrl()" type="button" class="submit-btn">Fetch Image</button>
                </form>
            </article>
            <aside>
                <div class="adds-container">
                </div>
            </aside>
        </section>
    </section>
</section>
<footer>

</footer>
<script src="{{ mix('js/app.js')  }}"></script>
</body>
</html>
