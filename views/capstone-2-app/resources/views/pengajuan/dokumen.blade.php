@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jurusan</h3>
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{implode('',$errors->all(':message'))}}
                    </div>
                @endif
                <form method="post" action="{{route('pengajuanBeasiswa.storeDocument')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="user_id" class="text-white mb-3">ID</label>
                            <input type="text" name="user_id" id="user_id" class="form-control" readonly value="{{ $data->users_id }}">
                        </div>
                        <input type="hidden" name="periodeBeasiswa_id" id="periodeBeasiswa_id" value="{{ $data->periodeBeasiswa_id }}">
                        <input type="hidden" name="jenisBeasiswa_id" id="jenisBeasiswa_id" value="{{ $data->jenisBeasiswa_id }}">
                            <div class="form-group m-2">
                                <label for="dokumenPengajuan" class="text-white mb-3">Dokumen Pengajuan</label>
                                <input type="file" class="form-control" id="dokumenPengajuan" placeholder="Upload Dokumen Pengajuan"
                                       required name="dokumenPengajuan">
                            </div>
                            <div class="form-group m-2">
                                <label for="suratEkonomiLemah" class="text-white mb-3">Surat Eknomi Lemah </label>
                                <input type="file" class="form-control" id="suratEkonomiLemah" placeholder="Upload Dokumen Pendukung"
                                       name="suratEkonomiLemah">
                            </div>
                            <div class="form-group m-2">
                                <label for="aktivisOrganisasi" class="text-white mb-3">Surat Keterangan Aktivis Organisasi Masyarakat</label>
                                <input type="file" class="form-control" id="aktivisOrganisasi" placeholder="Upload Dokumen Pendukung"
                                       name="aktivisOrganisasi">
                            </div>
                        <button type="submit" class="btn btn-info text-white mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
@endsection
