@extends('layouts.admin')

@section('title', 'Users list')

@section('content')
    <div class="container">
        <section class="card">
            <header class="card-header">
                <h1 class="card-title">Users</h1>
            </header>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="10%" class="text-center">Verified</th>
                        <th width="10%" class="text-center">Type</th>
                        <th width="10%" class="text-center">Created</th>
                        <th width="15%" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ $user->verified }}</td>
                            <td class="text-center">{{ $user->type }}</td>
                            <td class="text-center">{{ $user->created }}</td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </section>
    </div>
@endsection
