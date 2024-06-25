@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jenis Beasiswa</h3>

                <form method="post" action="{{route('jenisBeasiswa.store')}}" id="addForm">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for=id" class="text-white mb-3">ID</label>
                            <input type="text" minlength="5" class="form-control" id="id" placeholder="Masukan ID"
                                   required name="id">
                        </div>
                        <div class="form-group m-2">
                            <label for="namaBeasiswa" class="text-white mb-3">Jenis Beasiswa</label>
                            <input type="text" minlength="5" class="form-control" id="namaBeasiswa" placeholder="Masukan Jenis Beasiswa"
                                   required name="nama">
                        </div>
                    </div>
                    <button type="submit" id="addSubmit" class="btn btn-info text-white mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
@endsection
