@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">Edit User</h1>
            </header>

            <form action="{{ route('user.update', $user) }}" method="post" class="card-body">
                @method('patch')
                @csrf

                <p>{{ $user->name }}</p>
                <div class="form-group">

                    <label></label>
            </form>
        </section>
    </div>
@endsection
