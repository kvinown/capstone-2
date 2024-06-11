@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Fakultas</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('fakultas.create')}}">
                        <button class="btn btn-primary">Tambah Fakultas</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID Fakultas</th>
                        <th>Nama Fakultas</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($fakultasData))
                        @foreach($fakultasData as $fakultas)
                            <tr>
                                <td>{{$fakultas->id}}</td>
                                <td>{{$fakultas->nama}}</td>
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
