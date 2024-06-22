@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Jurusan</h3>

                <form method="post" action="{{route('periode.update')}}">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="id" class="text-white mb-3">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="Masukan ID"
                                   required name="id" readonly value="{{ $periodeData->id }}">
                        </div>
                        <div class="form-group m-2">
                            <label for="nama" class="text-white mb-3">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukana Nama"
                                   required name="nama" value="{{ $periodeData->nama }}">
                        </div>
                        <div class="form-group m-2">
                            <label for="status" class="text-white mb-3">Status</label>
                            <input type="text" class="form-control" id="status" placeholder="1 / 0"
                                   required name="status" value="{{ $periodeData->status }}">
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
