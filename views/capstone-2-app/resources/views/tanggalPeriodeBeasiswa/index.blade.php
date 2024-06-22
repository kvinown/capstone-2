@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Tanggal Periode Beasiswa</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('tanggalPeriode.create')}}">
                        <button class="btn btn-primary">Tambah Tanggal Periode Beasiswa</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Periode</th>
                        <th>Jenis Beasiswa</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    @if(!empty($tanggalPeriodeData))
                        @foreach($tanggalPeriodeData as $tanggalPeriode)
                            <tr>
                                <td>{{$tanggalPeriode->id}}</td>
                                <td>{{$tanggalPeriode->periodeBeasiswa->nama}}</td>
                                <td>{{$tanggalPeriode->jenisBeasiswa->nama}}</td>
                                <td>{{ date('Y-m-d', strtotime($tanggalPeriode->start_date)) }}</td>
                                <td>{{ date('Y-m-d', strtotime($tanggalPeriode->end_date)) }}</td>
                                <td>
                                    <a href="{{route('tanggalPeriode.edit', $tanggalPeriode->id)}}" class="btn btn-warning" role="button"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <form action="" method="POST">
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
