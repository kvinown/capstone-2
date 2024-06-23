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
                <form method="post" action="{{route('pengajuanBeasiswa.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="periodeBeasiswa_id" class="text-white mb-3">Periode Beasiswa</label>
                            <select class="form-select mb-3" name="periodeBeasiswa_id" id="periodeBeasiswa_id">
                                @foreach($periodeBeasiswaData  as $periodeBeasiswa)
                                    <option value="{{$periodeBeasiswa->id}}">{{$periodeBeasiswa->id}} - {{$periodeBeasiswa->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="jenisBeasiswa_id" class="text-white mb-3">Jenis Beasiswa</label>
                            <select class="form-select mb-3" name="jenisBeasiswa_id" id="jenisBeasiswa_id">
                                @foreach($jenisBeasiswaData  as $jenisBeasiswa)
                                    <option value="{{$jenisBeasiswa->id}}">{{$jenisBeasiswa->id}} - {{$jenisBeasiswa->nama}}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="form-group m-2">--}}
{{--                            <label for="ipk" class="text-white mb-3">IPK Terakhir</label>--}}
{{--                            <input type="text" minlength="5" class="form-control" id="ipk" placeholder="Masukan IPK Terakhir"--}}
{{--                                   required name="ipk">--}}
{{--                        </div>--}}

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
{{--                        <div class="form-group m-2">--}}
{{--                            <label for="dokumenPendukung" class="text-white mb-3">Dokumen Pendukung</label>--}}
{{--                            <input type="file" class="form-control" id="dokumenPendukung" placeholder="Upload Dokumen Pendukung"--}}
{{--                                   name="dokumenPendukung[]" multiple="true">--}}
{{--                        </div>--}}
                    </div>
                    <button type="submit" class="btn btn-info text-white mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
@endsection
