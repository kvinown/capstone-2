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
                <form method="post" action="{{route('pengajuanBeasiswa.store')}}">
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
                        <div class="form-group m-2">
                            <label for="ipk" class="text-white mb-3">IPK Terakhir</label>
                            <input type="text" class="form-control" id="ipk" placeholder="Masukan IPK Terakhir"
                                   required name="ipk">
                        </div>
                        <div class="form-group m-2">
                            <label for="poin" class="text-white mb-3">Poin Portofolio</label>
                            <input type="text" class="form-control" id="poin" placeholder="Masukan Poin Portofolios"
                                   required name="point_portofolio">
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
