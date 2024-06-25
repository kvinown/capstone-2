@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Tanggal Periode</h3>

                <form method="post" action="{{route('tanggalPeriode.store')}}" id="addForm">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="jenisBeasiswa_id" class="text-white mb-3">Jenis Beasiswa</label>
                            <select class="form-select mb-3" name="jenisBeasiswa_id" id="jenisBeasiswa_id" required>
                                @foreach($jenisBeasiswaData as $jenisBeasiswa)
                                    <option value="{{$jenisBeasiswa->id}}">{{$jenisBeasiswa->id}} - {{$jenisBeasiswa->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="periodeBeasiswa_id" class="text-white mb-3">Periode Beasiswa</label>
                            <select class="form-select mb-3" name="periodeBeasiswa_id" id="periodeBeasiswa_id" required>
                                @foreach($periodeBeasiswaData as $periodeBeasiswa)
                                    <option value="{{$periodeBeasiswa->id}}">{{$periodeBeasiswa->id}} - {{$periodeBeasiswa->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-2 d-flex justify-content-between">
                            <div class="col-md-5">
                                <label for="start_date" class="form-label text-white mb-3">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-5">
                                <label for="end_date" class="form-label  text-white mb-3">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
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
