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
                            <label for="periode" class="text-white mb-3">Periode</label>
                            <input type="text" class="form-control" id="periode" placeholder="Masukan Periode"
                                   required name="periode">
                        </div>
                        <div class="form-group m-2">
                            <label for="tglAwal" class="text-white mb-3">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tglAwal" placeholder="Tanggal Awal"
                                   required name="tglAwal">
                        </div>
                        <div class="form-group m-2">
                            <label for="tglAkhir" class="text-white mb-3">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tglAkhir" placeholder="Tanggal Akhir"
                                   required name="tglAkhir">
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
