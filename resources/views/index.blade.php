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

<section id="app" class="app-content-section">
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
                <input v-model="youtube_url" type="text" name="youtube_url">
                <button @click="sendUrl()" type="button" class="submit-btn">Fetch Image</button>
            </form>
        </article>
        <aside>
            <div class="adds-container">
            </div>
        </aside>
    </section>
</section>
<footer>

</footer>
<script src="{{ mix('js/app.js')  }}"></script>
</body>
</html>
