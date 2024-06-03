@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Fakultas</h3>
                <form method="post" action="">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="idFakultas" class="text-white mb-3">Fakultas</label>
                            <select class="form-control mb-3" id="idFakultas" name="namaFakultas"  required>
                                <option value="">12345 - Teknologi Informasi</option>
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="prodi" class="text-white mb-3">Nama Program Studi</label>
                            <input type="text" minlength="5" class="form-control mb-3" id="prodi" placeholder="Masukan Nama Program Studi"
                                   required name="prodi">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info text-white mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('spc-js')
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        const socket = io('http://127.0.0.1:3000');

        socket.on('connect', () => {
            console.log('Connected to server');
        });

        socket.on('socket-id', (id) => {
            document.getElementById('socket-id-value').textContent = id;
        });
    </script>
@endsection
