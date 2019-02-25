@extends('layouts.app')

@section('title', $article->title )

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">{{ $article->title }}</h1>
                <p>
                    <strong>Written by {{ $article->author->name }} in category {{ $article->category->title }} on {{ $article->display_publish }}</strong>
                </p>
            </header>

            <article class="card-body">
                {!! $article->content !!}
            </article>
        </section>
    </div>
@endsection
