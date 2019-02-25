@extends('layouts.admin')

@section('title', 'Blog Articles')

@section('content')
    <div class="container">
        <section class="card">

            <header class="card-header d-flex justify-content-between align-items-center">
                <h1 class="card-title">Blog Articles</h1>
                <a href="{{ route('article.create') }}" class="btn btn-primary">Add Article</a>
            </header>

            @include('article._admin_list', ['articles' => $articles, 'show' => true])

        </section>
    </div>
@endsection
