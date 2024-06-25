@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Tabel Pengajuan</h3>
                <div class="mb-3 mt-2 ms-2">
                    <a href="{{route('pengajuanBeasiswa.create')}}">
                        <button class="btn btn-primary">Lakukan Pengajuan</button>
                    </a>
                </div>
                <table class="table table-striped border border-secondary">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Periode</th>
                        <th>Jenis Beasiswa</th>
                        <th>IPK</th>
                        <th>Poin Portofolio</th>
                        <th>Status Prodi</th>
                        <th>Status Fakultas</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($pengajuanBeasiswaData))
                        @foreach($pengajuanBeasiswaData as $pengajuanBeasiswa)
                            <tr>
                                <td>{{$pengajuanBeasiswa->users->name}}</td>
                                <td>{{$pengajuanBeasiswa->periodeBeasiswa->nama}}</td>
                                <td>{{$pengajuanBeasiswa->jenisBeasiswa->nama}}</td>
                                <td>{{$pengajuanBeasiswa->ipk}}</td>
                                <td>{{$pengajuanBeasiswa->point_portofolio}}</td>
                                <td>{{$pengajuanBeasiswa->statusProdiApproved}}</td>
                                <td>{{$pengajuanBeasiswa->statusFakultasApproved}}</td>
                                <td>
                                    <a href="{{ route('pengajuanBeasiswa.detail', ['users_id' => $pengajuanBeasiswa->users_id, 'jenisBeasiswa_id' => $pengajuanBeasiswa->jenisBeasiswa_id, 'periodeBeasiswa_id' => $pengajuanBeasiswa->periodeBeasiswa_id, 'ipk' => $pengajuanBeasiswa->ipk, 'point_portofolio' => $pengajuanBeasiswa->point_portofolio ]) }}">
                                        Detail
                                    </a>
                                </td>

                                <td>
                                    <a href="{{route('dokumenBeasiswa.edit', $pengajuanBeasiswa->users_id)}}" class="btn btn-warning" role="button"><i class="bi bi-pencil-square"></i></a>
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
                            <td colspan="9" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('spc-js')

@endsection
