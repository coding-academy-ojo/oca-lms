

<header>
    <div class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-brand me-auto">
                <a class="stretched-link" href="#">
                    <img src="{{ asset('assets/img/orange-logo.svg') }}" width="50" height="50" alt="Boosted - Back to Home" loading="lazy">
                </a>
                <h3 class="me-auto m-2 navbar-item">Orange Coding Academy</h3>
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
            @if(Auth::user() && Auth::user()->role === 'manager')
            <!-- The Modal -->
         <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="createClassModalLabel">Create class</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <form method="POST" action="{{ route('classrooms.store') }}">
                            @csrf
                             <div class="mb-3">
                                 <input type="text" name="name" class="form-control" placeholder="Class name (required)" required>
                             </div>
                             <div class="mb-3">
                                <textarea id="textarea" class="form-control" placeholder="Description (required)" name="description" rows="3" required></textarea>
                             </div>
                             <input type="text" name="picture" value="img_bookclub.jpg"  hidden>
                           
                             <div class="mb-3">
                                <div class="dropdown">
                                    <button style="color: black !important;" class="btn btn-orange dropdown-toggle form-control" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Trainers
                                    </button>
                                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                                        @if($trainers && $trainers->count() > 0)
                                            @foreach($trainers as $trainer)
                                                <li class="p-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="trainers[]" value="{{ $trainer->id }}" id="trainerCheckbox{{ $trainer->id }}">
                                                        <label style="color: black !important;" class="form-check-label" for="trainerCheckbox{{ $trainer->id }}">
                                                            {{ $trainer->name }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="p-1" style="color: black !important;">No trainers available</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                           
                             <div class="modal-footer d-flex gap-2 justify-content-end">
                                 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                 <button type="submit" class="btn btn-primary">Create</button>
                             </div>
                         </form>
                     </div>
                     
                 </div>
             </div>
         </div>
         <!-- modal end -->
         <div class="d-flex navbar-item">
             <button class="btn-primary navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                     data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                     aria-expanded="false" aria-label="Toggle navigation">
                 <span class="material-icons add-icon" data-bs-toggle="modal"
                       data-bs-target="#createClassModal">add</span>
             </button>
         </div>
         @endif
         
        
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
        <span style="color: white !important" class="p-3   mb-0 h6"> {{ $academyName ?? 'Al Balqa Academy' }}</span>
    </div>
</div>
    
</header>
