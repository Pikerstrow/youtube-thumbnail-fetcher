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
            @if($posts->count())
                @foreach($posts as $post)
                    <a href="{{ route('post', $post->slug) }}" class="posts__container__post_card">
                        <article>
                            <picture>
                                <img class="posts__container__post_card__thumbnail" src="{{ storage_url($post->image) }}"
                                     alt="post-thumbnail">
                            </picture>
                            <div class="posts__container__post_card__body">
                                <h3 class="posts__container__post_card__title">{{ $post->getTranslatedAttribute('title') }}</h3>
                                <span class="posts__container__post_card__date">{{ reformat_date($post->created_at) }}</span>
                                <p class="posts__container__post_card__excerpt">{{ $post->getTranslatedAttribute('excerpt') }}&nbsp;&nbsp;<span class="posts__container__post_card__read_more">&gt;&gt;&gt;</span></p>
                            </div>
                        </article>
                    </a>
                @endforeach
                <div class="posts__pagination_container">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="posts__container__no_content">
                    <img src="{{ url('images/logo.png') }}" class="posts__container__no_content__img" />
                    <h3 class="posts__container__no_content__title">{{ __('views.comming_soom') }}</h3>
                    <a href="{{ route('start') }}" class="posts__container__no_content__go_back">
                        <span>{{ __('views.to_main') }}</span>
                    </a>
                </div>
            @endif
        </section>
    </section>
@endsection

