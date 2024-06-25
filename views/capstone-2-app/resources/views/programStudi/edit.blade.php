@extends('layouts.master')

@section('web-content')
    @if(auth()->user()->role_id != "1")
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Pengubahan Program Studi</h3>

                <form method="POST" action="{{ route('programStudi.update') }}">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="id" class="text-white mb-3">ID Jurusan</label>
                            <input type="text" maxlength="5" class="form-control" id="id" placeholder="ID Program Studi"
                                   required name="id" readonly value="{{$programStudiData->id}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="nama" class="text-white mb-3">Nama Jurusan</label>
                            <input type="text" maxlength="100" class="form-control" id="nama" placeholder="Nama Program Studi"
                                   required name="nama" value="{{$programStudiData->nama}}">
                        </div>
                        <div class="form-group m-2">
                            <label for="fakultas_id" class="text-white mb-3">Fakultas</label>
                            <select class="form-select mb-3" name="fakultas_id" id="fakultas_id">
                                <option value="{{$programStudiData->fakultas_id}}"></option>
                                @foreach($fakultasData as $fakultas)
                                    <option value="{{$fakultas->id}}">{{$fakultas->id}} - {{$fakultas->nama}}</option>
                                @endforeach
                            </select>
                        </div>
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
