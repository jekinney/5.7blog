@extends('layouts.admin')

@section('title', 'Blog Categories')

@section('content')
    <div class="container">
        <section class="card">

            <header class="card-header d-flex justify-content-between align-items-center">
                <h1 class="card-title">Blog Categories</h1>
                <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
            </header>

            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th width="10%" class="text-center">Articles</th>
                        <th width="15%" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $categories as $cat )
                        <tr>
                            <td>{{ $cat->title }}</td>
                            <td>{{ $cat->description }}</td>
                            <td class="text-center">{{ $cat->articles_count }}</td>
                            <td class="text-center">
                                <a href="{{ route('category.edit', $cat) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('category.details', $cat) }}" class="btn btn-sm btn-success">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    </div>
@endsection
