<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-brand">
            <a class="stretched-link" href="#">
                <img src="{{asset('assets/img/orange-logo.svg')}}" width="50" height="50" alt="Boosted - Back to Home" loading="lazy">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-end" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth('staff')
                @if(Auth::guard('staff')->user()->role === 'super_manager')
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{route('supermanager-dashboard')}}">Home</a>
                </li>
                @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('academies')}}">Academies</a>
                </li>
                @auth('staff')
                @if(Auth::guard('staff')->user()->role === 'super_manager')
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#createAcademyOffcanvas" aria-controls="createAcademyOffcanvas">
                            Add Academy
                        </button>
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
                    <a class="nav-link" href="{{route('categories.indexCohort')}}">Roadmap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profile')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
                
            </ul>

        </div>
    </div>
</nav>
<div class="bg-dark text-white text-center py-5" style="background-image: url('{{ asset('assets/img/img_bookclub.jpg') }}'); background-size:cover; background-position: center;">
    <div class=" container">
        <h1 class="display-3">
            @yield('title')
        </h1>
        <p class="lead">Your central hub for learning</p>
    </div>
</div>


