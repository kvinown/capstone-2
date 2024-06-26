@extends('layouts.master')

@section('web-content')
    @if(auth()->user()->role_id == "1")
        <div class="content m-5 bg-secondary bg-gradient p-3">
            <div class="container-fluid">
                <div class="card p-4">
                    <h3 class="text-center mb-3">Tabel Pengguna</h3>
                    <div class="mb-3 mt-2 ms-2">
                        <a href="{{route('users.create')}}">
                            <button class="btn btn-primary">Tambah Pengguna</button>
                        </a>
                    </div>
                    <table class="table table-striped border border-secondary">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Program Studi</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!empty($usersData))
                            @foreach ($usersData as $user)

                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ $user->role ? $user->role->nama : 'N/A' }}</td>
                                    <td>{{ $user->programStudi ? $user->programStudi->nama : 'N/A' }}</td>
                                    <td>
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning" role="button"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{route('users.delete', $user->id)}}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-button"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('spc-js')

@endsection
