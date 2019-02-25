@extends('layouts.app')

@section('title', 'Edit Blog Category')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <section class="card">

                    <header class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title">Edit Category</h1>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#category-{{ $category->id }}">Remove</button>
                    </header>

                    <form action="{{ route('category.update', $category) }}" method="post" class="card-body">
                        @method('patch')
                        @csrf

                        @include('layouts._errors')

                        <div class="form-group required">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title')?? $category->title }}" class="form-control" maxlength="60" required="true">
                        </div>

                        <div class="form-group required">
                            <label for="description" class="control-label">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description')?? $category->description }}" class="form-control" maxlength="255" required="true">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </section>

            </div>
        </div>
        @include('category._remove', ['category' => $category, 'id' => $category->id])
    </div>
@endsection
