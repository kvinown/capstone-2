@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jurusan</h3>

                <form id="addForm" method="post" action="{{route('fakultas.store')}}">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="id" class="text-white mb-3">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="Masukan ID" required name="id">
                        </div>
                        <div class="form-group m-2">
                            <label for="namaFakultas" class="text-white mb-3">Nama Jurusan</label>
                            <input type="text" minlength="5" class="form-control" id="namaFakultas" placeholder="Masukan Nama Fakultas"
                                   required name="nama">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info text-white mt-2" id="addSubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
@endsection
