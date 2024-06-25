@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Dokumen Pengajuan</h3>
                <h1 class="text-center mb-3">Berkas yang dikirimkan</h1>
                <div class="row d-block fw-bold">
                    <table class="table table-striped border border-secondary">
                        <thead>
                        <tr>
                            <th>ID Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis Beasiswa</th>
                            <th>Periode</th>
                            <th>IPK</th>
                            <th>Poin Portofolio</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$data->users_id}}</td>
                                <td>{{$data->users->name}}</td>
                                <td>{{$data->jenisBeasiswa->nama}}</td>
                                <td>{{$data->periodeBeasiswa->nama}}</td>
                                <td>{{$data->ipk}}</td>
                                <td>{{$data->point_portofolio}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col fw-bold">Dokumen: </div>
                    <div class="col fw-bold border border-dark">
                        @if(!empty($data->dokumen))
                            @foreach($data->dokumen as $dokumen)
                                <div class="col fw-bold">{{$dokumen->jenisDokumen->nama}}</div>
                                <div>
                                    <iframe src="{{ asset( $dokumen->path) }}" width="100%" height="600px"></iframe>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">Tidak ada data</div>
                        @endif
                    </div>
                    <div class="col fw-bold">
                        @if(auth()->user()->role_id == '1')
                            <a href="" class="btn btn-primary">Approve</a>
                        @elseif(auth()->user()->role_id == '2')
                            <a href="" class="btn btn-primary">Approve</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')

@endsection
