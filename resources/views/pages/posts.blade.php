@extends('layouts.main')

@section('title', $page->getTranslatedAttribute('title'))
@section('meta_description', $page->getTranslatedAttribute('meta_description') ?? '')
@section('meta_keywords', $page->getTranslatedAttribute('meta_keywords') ?? '')
@section('og_url', route('start'))

@section('header')
    @include('shared.header', ['logo_text' => 'Youtube Thumbnail Picker', 'page' => $page])
@endsection

@section('content')
    <section class="posts">
        <article>
            <header>
                <h1 class="posts__h1">{{ __('views.blog')  }}</h1>
                @if(!empty($page->body))
                    <div class="posts__note">{!! $page->getTranslatedAttribute('body') !!}</div>
                @endif
            </header>
        </article>
        <section class="posts__container">
            @foreach($posts as $post)
                <a href="{{ route('post', $post->slug) }}" class="posts__container__post_card">
                    <article>
                        <picture>
                            <img class="posts__container__post_card__thumbnail" src="{{ storage_url($post->image) }}"
                                 alt="post-thumbnail">
                        </picture>
                        <div class="posts__container__post_card__body">
                            <h3 class="posts__container__post_card__title">{{ $post->getTranslatedAttribute('title') }}</h3>
                            <p class="posts__container__post_card__excerpt">{{ $post->getTranslatedAttribute('excerpt') }}&nbsp;&nbsp;<span class="posts__container__post_card__read_more">&gt;&gt;&gt;</span></p>
                        </div>
                    </article>
                </a>
            @endforeach
            <div class="posts__pagination_container">
                {{ $posts->links() }}
            </div>
        </section>
    </section>
@endsection

