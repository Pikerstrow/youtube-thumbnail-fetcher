@extends('layouts.main')

@section('title', $page->getTranslatedAttribute('title'))
@section('meta_description', $page->getTranslatedAttribute('meta_description') ?? '')
@section('meta_keywords', $page->getTranslatedAttribute('meta_keywords') ?? '')
@section('og_url', route('start'))

@section('header')
    @include('shared.header', ['logo_text' => 'Youtube Thumbnail Picker', 'page' => $page])
@endsection

@section('content')
    @foreach($posts as $post)
    <h3>{{ $post->title }}</h3>
    @endforeach
@endsection

