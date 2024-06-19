@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Role</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('role.create')}}">
                        <button class="btn btn-primary">Tambah Role</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($roleData))
                        @foreach($roleData as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->nama}}</td>
                                <td>
                                    <a href="{{route('role.edit', $role->id)}}" class="btn btn-warning" role="button"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('role.delete', $role->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        const socket = io('http://127.0.0.1:3000');

        socket.on('connect', () => {
            console.log('Connected to server');
        });

        socket.on('socket-id', (id) => {
            document.getElementById('socket-id-value').textContent = id;
        });
    </script>
@endsection
