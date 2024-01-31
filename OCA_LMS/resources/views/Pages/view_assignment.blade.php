@extends('trainer.layouts.master')
@section('trainerHome')

    <body>

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            .task:hover {
                box-shadow: 8px 1px 8px 1px rgb(197, 197, 197);
                border: 2px rgb(196, 196, 196);
                border-radius: 3px;

            }
        </style>

        <div class="main d-flex">
            <div class=" border-end" style="width: 20%"></div>
            <div class="m-auto" style="width: 80%">
                <nav class="navbar  navbar-expand-lg  supra"
                    aria-label="Supra navigation - With an additional languages navbar example">
                    <div class="container-xxl">
                        <ul class="navbar-nav me-auto mx-5 px-3">
                            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Stream</a>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">Classwork</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">People</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">Marks</a></li>

                        </ul>
                    </div>
                </nav>
                <div class="m-auto" style="width: 50%">
                    <div class="my-5">
                        <a href="" class="btn btn-primary rounded-pill m-auto" style="width: 90px; height:50px">Create</a>
                    </div>

          

                        <a href="" class="text-decoration-none">
                            <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                                style="height: 50px;">
                                <div class="d-flex">
                                    <div class="icon m-2">
                                        <span class="material-symbols-outlined">task</span>
                                    </div>
                                    <div class="text m-2 pt-1">php</div>
                                </div>
                                    <div class="clickable-icon " data-bs-toggle="dropdown" data-target="#optionsModal">
                                        <span class="material-symbols-outlined mt-2 me-2">more_vert</span>
                                        <ul class="dropdown-menu dropdown-menu-end rounded-2">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li>
                                                <form action="" method="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                            </div>
                            <div class="d-flex justify-content-between border-bottom border-light border-1 task"
                            style="height: 50px;">
                            <div class="d-flex">
                                <div class="icon m-2">
                                    <span class="material-symbols-outlined">task</span>
                                </div>
                                <div class="text m-2 pt-1">php</div>
                            </div>
                                <div class="clickable-icon " data-bs-toggle="dropdown" data-target="#optionsModal">
                                    <span class="material-symbols-outlined mt-2 me-2">more_vert</span>
                                    <ul class="dropdown-menu dropdown-menu-end rounded-2">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li>
                                            <form action="" method="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        </a>
                </div>
            </div>
        </div>
    </body>
    </html>
@endsection
