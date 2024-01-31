<footer class="bg-dark text-light py-3 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <!-- Your footer logo goes here -->
                <img src="{{ asset('assets/img/orange.png') }}" alt="Footer Logo" class="img-fluid">
            </div>
            <div class="col-md-9">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNavFooter">
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
</footer>