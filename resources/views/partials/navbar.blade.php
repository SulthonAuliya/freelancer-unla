<nav class="navbar navbar-expand-md navbar-light fixed-top fw-bold" style="background-color: #e3f2fd; ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Freelancer Unla</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
            </li>
            @auth
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" aria-current="page" href="/profile/{{ auth()->user()->slug }}">Profile</a>
            </li>
            @can('freelancer')
                
            <li class="nav-item">
                <a class="nav-link {{ Request::is('lamar') ? 'active' : '' }}" aria-current="page" href="/lamar">My Lamaran</a>
            </li>

            @endcan
            
            @can('provider')
                
            <li class="nav-item">
                <a class="nav-link {{ Request::is('jobs/create') ? 'active' : '' }}" href="/jobs/create">Tambah Job</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('jobs/create') ? 'active' : '' }}" href="/lamarans">Lamaran Masuk</a>
            </li>
            
            @endcan

            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link"> Logout</button>
                  </form>
            </li>

            @else
            <li class="nav-item">
                <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
            </li>
            @endauth

        </ul>
        </div>
    </div>
</nav>