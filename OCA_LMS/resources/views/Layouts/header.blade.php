
<header class="bg-dark text-light py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <!-- Your logo goes here -->
                <img src="{{ asset('assets/img/orange.png') }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-9">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('staff') ? 'active' : '' }}" href="/staff">Staff</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('classes') ? 'active' : '' }}" href="/classes">Classes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('skills') ? 'active' : '' }}" href="/skills">Skills</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
