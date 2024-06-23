@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Jenis Beasiswa</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('jenisBeasiswa.create')}}">
                        <button class="btn btn-primary">Tambah Beasiswa</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Beasiswa</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($jenisBeasiswaData))
                        @foreach($jenisBeasiswaData as $jenisBeasiswa)
                            <tr>
                                <td>{{$jenisBeasiswa->id}}</td>
                                <td>{{$jenisBeasiswa->nama}}</td>
                                <td>
                                    <a href="{{route('jenisBeasiswa.edit', $jenisBeasiswa->id)}}" class="btn btn-warning" role="button"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('jenisBeasiswa.delete', $jenisBeasiswa->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
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
