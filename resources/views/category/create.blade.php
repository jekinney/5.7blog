@extends('layouts.app')

@section('title', 'Create Blog Category')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <section class="card">

                    <header class="card-header">
                        <h1 class="card-title">Add Category</h1>
                    </header>

                    <form action="{{ route('category.store') }}" method="post" class="card-body">
                        @csrf

                        @include('layouts._errors')
                        
                        <div class="form-group required">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" maxlength="60" required="true">
                        </div>

                        <div class="form-group required">
                            <label for="description" class="control-label">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control" maxlength="255" required="true">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </section>

            </div>
        </div>
    </div>
@endsection
