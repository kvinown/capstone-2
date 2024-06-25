@extends('layouts.master')

@section('web-content')
    @if(auth()->user()->role_id == "1")
    <div class="content m-5 bg-secondary bg-gradient p-3">
        <div class="container-fluid">
            <div class="card p-4">
                <h3 class="text-center mb-3">Penambahan Pengguna</h3>
                <form method="post" action="{{route('users.update')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$usersData->id}}">
                    <div class="card-body bg-secondary rounded-3">
                        <div class="form-group m-2">
                            <label for="name" class="text-white mb-3">Nama Pengguna</label>
                            <input type="text"  class="form-control mb-3" id="name" placeholder="Masukan Nama Pengguna"
                                   required name="name" value="{{$usersData->name}}">
                        </div>

                        <div class="form-group m-2">
                            <label for="email" class="text-white mb-3">Email</label>
                            <input type="email" class="form-control mb-3" id="email" placeholder="Masukan Email"
                                   required name="email" value="{{$usersData->email}}" readonly>
                        </div>

                        <div class="form-group m-2">
                            <label for="password" class="text-white mb-3">Password</label>
                            <input type="password" class="form-control mb-3" id="password" placeholder="Masukan Password"
                                   required name="password">
                        </div>
                        <div class="form-group m-2">
                            <label for="password_confirmation" class="text-white mb-3">Confirm Password</label>
                            <input type="password" class="form-control mb-3" id="password_confirmation" placeholder="Masukan Password"
                                   required name="password_confirmation">
                        </div>

                        <div class="form-group m-2">
                            <label for="role_id" class="text-white mb-3">Role</label>
                            <select class="form-control mb-3" id="role_id" name="role_id"  required>
                                <option value="{{$usersData->id}}">{{$usersData->role_id}}</option>
                                @foreach($roleData as $role)
                                    <option value="{{$role->id}}">{{$role->id}} - {{$role->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-2">
                            <label for="programStudi_id" class="text-white mb-3">Program Studi</label>
                            <select class="form-control mb-3" id="programStudi_id" name="programStudi_id"  required>
                                @foreach($programStudiData as $programStudi)
                                    <option value="{{$programStudi->id}}">{{$programStudi->id}} - {{$programStudi->nama}}</option>
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
