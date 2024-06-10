@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Fakultas</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('fakultas-create')}}">
                        <button class="btn btn-primary">Tambah Fakultas</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID Program Studi</th>
                        <th>Nama Program Studi</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>12345</td>
                        <td>Fakultas Teknologi Informasi</td>
                        <td>
                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    @if(!empty($programStudiData))
                        @foreach($programStudiData as $programStudi)
                            <tr>
                                <td>{{$programStudi->id}}</td>
                                <td>{{$programStudi->nama}}</td>
                                <td>
                                    <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
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