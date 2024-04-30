<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/orange-logo.svg') }}" width="50" height="50" alt="Boosted - Back to Home"
                loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-end" id="navbarText">
            @auth('students')

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }} "
                            aria-current="page" href="{{ route('student.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                            aria-current="page" href="{{ route('student.assignments') }}">Assignments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                            aria-current="page" href="{{ route('show_all_projects') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link "  aria-current="page" href="{{ route('Announcements') }}">Announcements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                            aria-current="page" href="#">Roadmap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                            aria-current="page" href="#">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                            aria-current="page" href="#">Skills Framework</a>
                    </li>


                </ul>

            @endauth

            @auth('staff')
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if (Auth::guard('staff')->user()->role == 'super_manager')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('supermanager-dashboard') ? 'active' : '' }} "
                            aria-current="page" href="{{ route('supermanager-dashboard') }}">Home</a>
                    </li>
                    @endif
                    @if (in_array(Auth::guard('staff')->user()->role, ['super_manager', 'manager']))


                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('academies') ? 'text-primary' : '' }}""
                                href=" {{ route('academies') }}">Academies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('staff.index') ? 'text-primary' : '' }}"
                                href="{{ route('staff.index') }}">Staff</a>

                        </li>
                    @endif
                    @if (Auth::guard('staff')->user()->role == 'trainer')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Student Inputs
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="nav-link text-dark {{ request()->routeIs('assignments') ? 'text-primary' : '' }}"
                                        href="{{ route('assignments') }}">Assignments</a>
                                <a class="nav-link text-dark  {{ request()->routeIs('show_all_projects') ? 'text-primary' : '' }}"
                                    href="{{ route('show_all_projects') }}">Projects</a>
                                <a class="nav-link text-dark {{ request()->routeIs('Announcements') ? 'text-primary' : '' }}"
                                    href="{{ route('Announcements') }}">Announcements</a>
                                    <a class="nav-link text-dark {{ request()->routeIs('Masterpiece') ? 'text-primary' : '' }}"
                                    href="{{ route('Masterpiece') }}">Masterpiece</a>
                                <a class="nav-link text-dark {{ request()->routeIs('attendance') ? 'text-primary' : '' }}"
                                    href="{{ route('attendance') }}">Attendance</a>
                                    <a class="nav-link text-dark {{ request()->routeIs('soft-skills.*') ? 'text-primary' : '' }}"
                                        href="{{ route('soft-skills.index') }}">Soft Skills</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Material
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link text-dark " href="{{ route('skillsFramework') }}">Skills Framework</a>
                                <a class="nav-link text-dark " href="{{ route('categories.index') }}">Technology
                                    category</a>
                                <a class="nav-link text-dark  {{ request()->routeIs('categories.indexCohort') ? 'text-primary' : '' }}"
                                    href="{{ route('categories.indexCohort') }}">Roadmap</a>
                            </div>
                        </li>
                    @endif

                    @if (in_array(Auth::guard('staff')->user()->role, ['manager', 'trainer']))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('absence') ? 'text-primary' : '' }}"
                                href="{{ route('absence') }}">Absence</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('trainees.progress') ? 'text-primary' : '' }}"
                                href="{{ route('trainees.progress') }}">Trainees Progress</a>
                        </li>
                    @endif
                </ul>
            @endauth
            <ul class="navbar-nav ms-auto ">

                {{-- <li class="nav-item m-1">
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                href="{{ route('profile') }}">
                <span class="material-symbols-outlined">
                    person
                </span>
                </a>
                </li> --}}

                <li class="nav-item m-1">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                    </a>
                </li>

            </ul>
        </div>


    </div>
</nav>
{{-- <img class="card-img-top" src="{{ asset('assets/img/coding-1.png') }}" alt="Cohort Image"> --}}


<div class="bg-dark text-white text-center py-5"
    style="background-image: url('{{ asset('assets/img/coding-1.png') }}'); background-size:cover; background-position: center;">
    <div class=" container">
        <h1 class="display-3 ">
            @yield('title')
        </h1>
        <p class="lead">Your central hub for learning</p>
    </div>
</div>
