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
                            <span v-if="!is_data_loading">{{ __('views.index.fetch') }}</span>
                            <img style="width: 25px; height: 25px" v-else src="{{ asset('images/preloader.gif') }}">
                        </button>
                    </form>
                </article>
            </section>
        </section>

        <section v-if="Object.keys(thumbnails_data).length" class="app-content-section" >
            <article class="result-container">
                <h2>{{ __('views.index.result_title') }}:</h2>
                <p class="result-resolution">@{{ max_resolution_thumbnail.width }} x @{{ max_resolution_thumbnail.height }}</p>
                <div class="result-img-container">
                    <img class="result-img" :src="max_resolution_thumbnail.url">
                </div>
                <div class="result-description">
                    <p style="text-align: center">
                        <span class="note_title">{{ __('views.index.note') }}</span><span class="note_txt">{{ __('views.index.links_note') }}</span>
                    </p>
                    <h3>{{ __('views.index.h3_links') }}</h3>
                    <div class="table-responsive" style="margin-bottom: 30px;">
                        <table class="links-table">
                            <thead>
                            <tr>
                                <td>{{ __('views.index.resolution') }}</td>
                                <td>{{ __('views.index.link') }}</td>
                            </tr>
                            </thead>
                            <tr v-for="(thumbnail, index) in thumbnails_data.thumbnails">
                                <td>
                                    @{{ thumbnail.width }} x @{{ thumbnail.height }}
                                </td>
                                <td style="min-width: 450px;">
                                    <a :href="thumbnail.url" target="_blank">@{{ thumbnail.url }}</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h3>{{ __('views.index.h3_zip') }}</h3>
                    <div class="zip-link-container">
                        <a :href="thumbnails_data.zip_archive_url" class="zip-url">
                            <img style="width: 32px; margin-right: 10px" src="{{ asset('images/archive.png') }}"> <span>thumbnails.zip</span>
                        </a>
                    </div>
                    <p style="text-align: center">
                        <span class="note_title">{{ __('views.index.note') }}</span><span class="note_txt">{{ __('views.index.archive_note') }}</span>
                    </p>
                    <div class="zip-link-container">
                        <div @click="clearResults()" class="skip-btn">
                            {{ __('views.index.clear') }}
                        </div>
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

