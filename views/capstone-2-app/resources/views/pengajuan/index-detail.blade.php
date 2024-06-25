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
                            <th>Status Appoval Prodi</th>
                            <th>Status Appoval Fakultas</th>
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
                                <td>{{$data->statusProdiApproved}}</td>
                                <td>{{$data->statusFakultasApproved}}</td>
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
                        @if(auth()->user()->role_id == '3' and $data->statusProdiApproved == '0')
                            <a href="{{route('pengajuanBeasiswa.approveProdi',['users_id' => $data->users_id, 'jenisBeasiswa_id' => $data->jenisBeasiswa_id, 'periodeBeasiswa_id' => $data->periodeBeasiswa_id])}}" class="btn btn-primary">Approve Prodi</a>
                        @elseif(auth()->user()->role_id == '2' and $data->statusProdiApproved == '1' and $data->statusFakultasApproved == '0')
                            <a href="{{route('pengajuanBeasiswa.approveFakultas',['users_id' => $data->users_id, 'jenisBeasiswa_id' => $data->jenisBeasiswa_id, 'periodeBeasiswa_id' => $data->periodeBeasiswa_id])}}" class="btn btn-primary">Approve Fakultas</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')

@endsection
