@extends('layouts.main')

@section('title', $page->getTranslatedAttribute('title'))
@section('meta_description', $page->getTranslatedAttribute('meta_description') ?? '')
@section('meta_keywords', $page->getTranslatedAttribute('meta_keywords') ?? '')
@section('og_url', route('start'))

@section('header')
    @include('shared.header', ['logo_text' => 'Youtube Thumbnail Picker', 'page' => $page])
@endsection

@section('content')
    <section id="app" style="display:flex; flex: 1; flex-direction: column; align-items: center;">

        <section class="app-content-section">
            <h1>{{ __('views.index.h1') }}</h1>
            <h2 class="additional">{{ __('views.index.h2_additional') }}</h2>
            <p>{{ __('views.index.description') }}</p>
            <div class="notes-div">
                <span class="note_title">{{ __('views.index.note') }}</span>
                <span class="note_txt">{{ __('views.index.note_txt') }}</span>
            </div>

            <section class="input-group-section">
                <article class="input-group">
                    <form method="POST">
                        <input id="youtube_url" type="text" name="youtube_url" placeholder="https://www.youtube.com/watch?v=XvtrI5hOIij7">
                        <div class="err-container">
                            <span class="error-txt"></span>
                        </div>
                        <button id="sendUrl" type="button" class="submit-btn position-relative">
                            <span class="btn-text">{{ __('views.index.fetch') }}</span>
                        </button>
                    </form>
                </article>
            </section>
        </section>

        <section id="fetch-result" class="app-content-section d-none">
            <article class="result-container">
                <h2>{{ __('views.index.result_title') }}:</h2>
                <p id="result-resolution" class="result-resolution"></p>
                <div class="result-img-container">
                    <img id="result-img" class="result-img" src="#">
                </div>
                <div class="result-description">
                    <p style="text-align: center">
                        <span class="note_title">{{ __('views.index.note') }}</span><span
                            class="note_txt">{{ __('views.index.links_note') }}</span>
                    </p>
                    <h3>{{ __('views.index.h3_links') }}</h3>
                    <div id="thumbnails-table-wrap" class="table-responsive" style="margin-bottom: 30px;">
                        <!-- AJAX POPULATED -->
                    </div>
                    <h3>{{ __('views.index.h3_zip') }}</h3>
                    <div class="zip-link-container">
                        <a id="zip-archive-url" href="#" class="zip-url">
                            <img style="width: 32px; margin-right: 10px" src="{{ asset('images/archive.png') }}"> <span>thumbnails.zip</span>
                        </a>
                    </div>
                    <p style="text-align: center">
                        <span class="note_title">{{ __('views.index.note') }}</span><span
                            class="note_txt">{{ __('views.index.archive_note') }}</span>
                    </p>
                    <div class="zip-link-container">
                        <button id="clearResults" class="skip-btn">
                            {{ __('views.index.clear') }}
                        </button>
                    </div>
                </div>
            </article>
        </section>
        <section class="about-section">
            <div class="wrap_container">
                <h2>{{ __('views.index.about_service') }}</h2>
                <article class="service_description">
                    <p>{{ __('views.index.service_description') }}</p>
                    <h4>{{ __('views.index.h4') }}</h4>
                    <ul>
                        <li>{{ __('views.index.ul_li_1') }}</li>
                        <li>{{ __('views.index.ul_li_2') }}</li>
                        <li>{{ __('views.index.ul_li_3') }}</li>
                        <li>{{ __('views.index.ul_li_4') }}</li>
                        <li>{{ __('views.index.ul_li_5') }}</li>
                    </ul>
                    <p><b>{{ __('views.index.conclusion') }}</b></p>
                </article>
            </div>
        </section>

        {!! $page->getTranslatedAttribute('body') !!}

    </section>
@endsection

