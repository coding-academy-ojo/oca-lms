<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/img/orange-logo.svg')}}" width="50" height="50" alt="Boosted - Back to Home" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-end" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth('staff')
                @if(in_array(Auth::guard('staff')->user()->role, ['super_manager', 'manager']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supermanager-dashboard') ? 'active' : '' }} " aria-current="page" href="{{route('supermanager-dashboard')}}">Home</a>
                </li>
                @endif
                
                @if(in_array(Auth::guard('staff')->user()->role, ['super_manager', 'manager']))

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('academies') ? 'text-primary' : '' }}"" href="{{route('academies')}}">Academies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.index') ? 'text-primary' : '' }}" href="{{ route('staff.index') }}">Staff</a>
               
                </li>
         
                @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('addTrainee')}}">Add Trainee </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('skillsFramework')}}">Skills Framework</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Technology category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profile.index')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </ul>
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item m-1">
                    <a class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}" href="{{route('profile.index')}}">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                    </a>
                </li>
                
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


<div class="bg-dark text-white text-center py-5" style="background-image: url('{{ asset('assets/img/coding-1.png') }}'); background-size:cover; background-position: center;">
    <div class=" container">
        <h1 class="display-3">
            @yield('title')
        </h1>
        <p class="lead">Your central hub for learning</p>
    </div>
</div>


