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
                                    {{ __('views.index.main_page') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('posts') }}">
                                    {{ __('views.index.blog') }}
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
            <section class="post__article__latest">
                <h3 class="post__article__latest__title">{{ __('views.index.latests_posts') }}</h3>
                @foreach($latest_posts as $new_post)
                    <a href="{{ route('post', $new_post->slug) }}" class="post__article__latest__post_card">
                        <article>
                            <picture>
                                <img class="post__article__latest__post_card__thumbnail" src="{{ storage_url($new_post->image) }}"
                                     alt="post-thumbnail">
                            </picture>
                            <div class="post__article__latest__post_card__body">
                                <h3 class="post__article__latest__post_card__title">{{ $new_post->getTranslatedAttribute('title') }}</h3>
                                <span class="post__article__latest__post_card__date">{{ reformat_date($new_post->created_at) }}</span>
                            </div>
                        </article>
                    </a>
                @endforeach
            </section>
        </article>

    </section>
@endsection

