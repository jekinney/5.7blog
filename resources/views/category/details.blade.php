@extends('layouts.admin')

@section('title', 'Blog Category Details')

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">{{ $category->title }}</h1>
                <p>{{ $category->description }}</p>
            </header>

            @include('article._admin_list', ['articles' => $category->articles, 'show' => false])

        </section>
    </div>
@endsection
