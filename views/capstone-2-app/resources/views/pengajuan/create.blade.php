@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jurusan</h3>

                <form method="post" action="">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="ipk" class="text-white mb-3">IPK Terakhir</label>
                            <input type="text" minlength="5" class="form-control" id="ipk" placeholder="Masukan IPK Terakhir"
                                   required name="ipk">
                        </div>

                        <div class="form-group m-2">
                            <label for="dokumenPengajuan" class="text-white mb-3">Dokumen Pengajuan</label>
                            <input type="file" class="form-control" id="dokumenPengauan" placeholder="Upload Dokumen Pengajuan"
                                   required name="dokumenPengajuan">
                        </div>

                        <div class="form-group m-2">
                            <label for="dokumenPendukung" class="text-white mb-3">Dokumen Pendukung</label>
                            <input type="file" class="form-control" id="dokumenPendukung" placeholder="Upload Dokumen Pendukung"
                                   required name="dokumenPendukung">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info text-white mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
@endsection