@extends('layouts.main')

@section('title', $post->getTranslatedAttribute('seo_title'))
@section('meta_description', $post->getTranslatedAttribute('meta_description') ?? '')
@section('meta_keywords', $post->getTranslatedAttribute('meta_keywords') ?? '')
@section('og_url', route('start'))

@section('header')
    @include('shared.header', ['logo_text' => 'Youtube Thumbnail Picker', 'page' => $page])
@endsection

@section('content')
    <section class="posts">
        <article>
            <header>
                <h1 class="posts__h1">{{ $post->title  }}</h1>
            </header>
        </article>

    </section>
@endsection

