<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="">
            <img src="assets/img/Maranatha_Logo.png" width="100px">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Daftar Sekarang</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('fakultas.index')}}">Fakultas</a></li>
                            <li><a class="dropdown-item" href="{{route('programStudi.index')}}">Program Studi</a></li>
                            <li><a class="dropdown-item" href="{{route('jenisBeasiswa.index')}}">Jenis Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{route('users.index')}}">Users</a></li>
                            <li><a class="dropdown-item" href="{{route('periode.index')}}">Periode Beasiswa</a></li>
                            <li><a class="dropdown-item" href="{{route('tanggalPeriode.index')}}">Tanggal Periode Beasiswa</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Periode</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Contact</a></li>
                    </li>
                </ul>
            </div>

            <!-- Profile Icon and Logout Menu -->
            <div class="profile-container">
                <img src="assets/img/profile.jpg" alt="Profile" class="profile-icon" id="profileIcon">
                <div class="menu" id="menu">
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" class="menu-item" id="logoutButton">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

@section('spc-css')

@endsection
