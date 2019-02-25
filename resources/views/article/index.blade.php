@extends('layouts.app')

@section('title', 'Blog Articles')

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">Welcome</h1>
            </header>

            <div class="list-group">
                @foreach( $articles as $art )
                    <a href="{{ route('article.show', $art->slug) }}" class="list-group-item list-group-item-action">
                        <header class="d-flex justify-content-between">
                            <h5 class="mb-1">{{ $art->title }}</h5>
                                By {{ $art->author->name }} for category 
                                <a href="{{ route('category.show', $art->category->slug) }}">{{ $art->category->title }}</a> 
                                on {{ $art->display_publish }}
                        </header>
                        <p class="mb-1">{{ $art->description }}</p>
                    </a>
                @endforeach
            </div>

        </section>
    </div>
@endsection
