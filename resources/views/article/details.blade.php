@extends('layouts.app')

@section('title', 'Blog Article Details')

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">{{ $article->title }}</h1>
                <p><strong>Written by {{ $article->author->name }} on {{ $article->display_publish }}</strong></p>
                <p><strong>Category: {{ $article->category->title }}</strong></p>
            </header>
            <article class="card-body pb-1">
                <p>{{ $article->description }}</p>
            </article>
            <hr>
            <article class="card-body">
                {!! $article->content !!}
            </article>
        </section>
    </div>
@endsection
