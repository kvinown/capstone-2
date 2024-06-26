@extends('layouts.master')

@section('web-content')
    @if(auth()->user()->role_id == "3")
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jurusan</h3>
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ implode('', $errors->all(':message')) }}
                    </div>
                @endif
                <form method="post" action="{{ route('pengajuanBeasiswa.update') }}">
                    @csrf
                    <input type="hidden" id="users_id" readonly name="users_id" value="{{$beasiswaData->users_id}}">
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="periodeBeasiswa_id" class="text-white mb-3">Periode Beasiswa</label>
                            <input type="text" class="form-control" id="periodeBeasiswa_id"
                                   readonly name="periodeBeasiswa_id" value="{{$beasiswaData->periodeBeasiswa_id}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="jenisBeasiswa_id" class="text-white mb-3">Jenis Beasiswa</label>
                            <input type="text" class="form-control" id="jenisBeasiswa_id"
                                   readonly name="jenisBeasiswa_id" value="{{$beasiswaData->jenisBeasiswa_id}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="ipk" class="text-white mb-3">IPK Terakhir</label>
                            <input type="text" class="form-control" id="ipk"
                                   placeholder="Masukan IPK Terakhir" readonly name="ipk" value="{{$beasiswaData->ipk}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="poin" class="text-white mb-3">Poin Portofolio</label>
                            <input type="text" class="form-control"
                                   id="poin" placeholder="Masukan Poin Portofolios" readonly name="point_portofolio" value="{{$beasiswaData->point_portofolio}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="statusProdiApproved" class="text-white mb-3">Jenis Beasiswa</label>
                            <select class="form-select mb-3" name="statusProdiApproved" id="statusProdiApproved">
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <input type="hidden" id="statusFakultasApproved" readonly name="statusFakultasApproved" value="{{$beasiswaData->statusFakultasApproved}}">
                    </div>
                    <button type="submit" class="btn btn-info text-white mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('spc-js')
@endsection
