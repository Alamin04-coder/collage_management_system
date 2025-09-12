<style>
    /* Navbar Custom Style */
    .navbar-custom {
        background: linear-gradient(90deg, #1d2b64, #f89);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 0.8rem 2rem;
    }

    .navbar-custom .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
        color: #fff;
        letter-spacing: 1px;
    }

    .navbar-custom .nav-link {
        color: #e0e0e0;
        margin-left: 1rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .navbar-custom .nav-link:hover {
        color: #fff;
        transform: scale(1.05);
    }

    .navbar-custom .navbar-toggler {
        border: none;
        outline: none;
        color: #fff;
    }
    .navbar-custom .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);

    }

    /* Optional: Small Screen Adjustments */
    @media (max-width: 768px) {
        .navbar-custom .nav-link {
            margin-left: 0;
            
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/logo2.png') }}" alt="Profile" class="rounded-circle me-2" width="35" height="35">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</nav>
