@extends('layouts.admin')

@section('title', 'Edit Blog Article')

@section('content')
    <div class="container">
        <section class="card">

            <header class="card-header d-flex justify-content-between align-items-center">
                <h1 class="card-title">Edit Article</h1>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#article-{{ $article->id }}">Remove</button>
            </header>

            <form action="{{ route('article.update', $article) }}" method="post" class="card-body">
                @method('patch')
                @csrf

                @include('layouts._errors')

                <div class="row">
                    <div class="form-group col-md-6 required">
                        <label for="category_id" class="control-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach( $categories as $cat )
                                <option value="{{ $cat->id }}" {{ $article->category_id === $cat->id? 'selected':'' }}>{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 required">
                        <label for="publish_at" class="control-label">publish At</label>
                        <input type="text" name="publish_at" id="publish_at" value="{{ old('publish_at')?? $article->input_publish }}" class="form-control">
                    </div>
                </div>

                <div class="form-group required">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title')?? $article->title }}" class="form-control" maxlength="60" required="true">
                </div>
                <div class="form-group required">
                    <label for="description" class="control-label">Description</label>
                    <input type="text" name="description" id="description" value="{{ old('description')?? $article->description }}" class="form-control" maxlength="550" required="true">
                </div>

                <div class="form-group required">
                    <label for="content" class="control-label">Content</label>
                    <textarea name="content" id="content" class="form-control" required="true">{{ old('description')?? $article->content }}</textarea>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </section>
        @include('article._remove', ['article' => $article, 'id' => $article->id])
    </div>
@endsection
