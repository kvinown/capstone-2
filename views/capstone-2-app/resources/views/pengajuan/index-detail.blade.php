@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Dokumen Pengajuan</h3>
                <h1 class="text-center mb-3">Berkas yang dikirimkan</h1>
                <div class="row d-block fw-bold">
                    <div class="col fw-bold">ID Mahasiswa : {{$data->users_id}}</div>
                    <div class="col fw-bold">Mahasiswa : {{$data->users->name}}</div>
                    <div class="col fw-bold">Jenis Beasiswa : {{$data->jenisBeasiswa->nama}}</div>
                    <div class="col fw-bold">Periode Beasiswa : {{$data->periodeBeasiswa->nama}}</div>
                    <div class="col fw-bold">
                        Dokumen :
                        @if(!empty($data->dokumen))
                            @foreach($data->dokumen as $dokumen)
                                <div class="col fw-bold">{{$dokumen->jenisDokumen_id}}</div>
                                <div>
                                    <iframe src="{{ asset( $dokumen->path) }}" width="100%" height="600px"></iframe>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">Tidak ada data</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')

@endsection
