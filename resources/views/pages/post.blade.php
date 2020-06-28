@extends('layouts.main')

@section('title', $post->getTranslatedAttribute('seo_title'))
@section('meta_description', $post->getTranslatedAttribute('meta_description') ?? '')
@section('meta_keywords', $post->getTranslatedAttribute('meta_keywords') ?? '')
@section('og_url', route('start'))

@section('header')
    @include('shared.header', ['logo_text' => 'Youtube Thumbnail Picker', 'page' => $page])
@endsection

@section('content')
    <section class="post">
        <article class="post__article">
            <header class="post__header" style="background-image: url('{{ storage_url($post->image) }}')">
                <div class="post__header__content">
                    <h1 class="post__h1">{{ $post->getTranslatedAttribute('title')  }}</h1>
                    <p class="post__date">{{ reformat_date($post->created_at) }}</p>
                    <div class="post__header__content__breadcrumbs_container">
                        <ol>
                            <li>
                                <a href="{{ route('start') }}">
                                    {{ __('views.main_page') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('posts') }}">
                                    {{ __('views.blog') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('post', $post->slug) }}">
                                    {{ $post->getTranslatedAttribute('title') }}
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </header>
            <div class="post__article__body_container">
                {!! $post->getTranslatedAttribute('body') !!}
            </div>
        </article>

    </section>
@endsection

