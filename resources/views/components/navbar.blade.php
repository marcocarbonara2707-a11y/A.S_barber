<nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top" id="mainNavbar">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-3">
                @auth
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('booking.create') }}">Prenota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('booking.my-appointments') }}">I miei appuntamenti</a>
                    </li>
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link custom-link" href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('home') }}">Home</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                @auth
                    <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle me-1"></i>
                    </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-logout-custom btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-custom btn-sm" href="{{ route('register') }}">Registrati</a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<script>
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 40) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
</script>