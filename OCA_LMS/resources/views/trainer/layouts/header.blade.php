<header>
    <div class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-brand me-auto">
                <a class="stretched-link" href="#">
                    <img src="{{ asset('assets/img/orange-logo.svg') }}" width="50" height="50"
                        alt="Boosted - Back to Home" loading="lazy">
                </a>
                <h3 class="me-auto m-2 navbar-item"> Orange Coding Academy</h1>
            </div>

            <div class="d-flex pt-2">
                <ul class="align-self-start d-flex flex-row gap-3 navbar-nav">
                    <li class=" nav-item active">
                        <a class="nav-link active" href="#" aria-current="page">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Assignment</a>
                    </li>

                </ul>
            </div>
            {{-- <div class="d-flex ">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#" aria-current="page">Active</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                  </ul>
            </div> --}}

        <div class="d-flex align-content-center justify-content-center p-1">
            
            <div class="d-flex navbar-item">
                <button class="btn-primary navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="material-icons add-icon" data-bs-toggle="modal"
                        data-bs-target="#createClassModal">add</span>
                </button>
            </div>
          
            <div class="d-flex navbar-item">
                <button class="btn-primary navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                        aria-controls="offcanvasScrolling"></span>
                </button>
            </div>

        </div>
    </div>
</div>
<div class="navbar navbar-dark bg-dark">
    <div class="container-fluid justify-content-center">
        <span style="color: white !important" class="p-3   mb-0 h6"> Al Balqa Academy</span>
    </div>
</div>
    
</header>
