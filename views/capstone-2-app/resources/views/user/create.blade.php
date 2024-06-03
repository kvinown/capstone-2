@extends('layouts.master')

@section('web-content')
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Pengguna</h3>
                <form method="post" action="">
                    @csrf
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="nama" class="text-white mb-3">Nama Pengguna</label>
                            <input type="text" minlength="5" class="form-control mb-3" id="nama" placeholder="Masukan Nama Pengguna"
                                   required name="nama">
                        </div>

                        <div class="form-group m-2">
                            <label for="email" class="text-white mb-3">Email</label>
                            <input type="email" minlength="5" class="form-control mb-3" id="email" placeholder="Masukan Email"
                                   required name="mail">
                        </div>

                        <div class="form-group m-2">
                            <label for="phone" class="text-white mb-3">Nomor Telepon</label>
                            <input type="text" minlength="5" class="form-control mb-3" id="phone" placeholder="Masukan Nomor Telepon"
                                   required name="phone">
                        </div>

                        <div class="form-group m-2">
                            <label for="role" class="text-white mb-3">Role yang digunakan</label>
                            <select class="form-control mb-3" id="role" name="role"  required>
                                <option value="">Admin</option>
                            </select>
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
