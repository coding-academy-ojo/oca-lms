<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boosted demo</title>
    <!-- Copyright © 2014 Monotype Imaging Inc. All rights reserved -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <link href="{{asset('assets/boosted/dist/css/orange-helvetica.min.css')}}" rel="stylesheet" integrity="sha384-A0Qk1uKfS1i83/YuU13i2nx5pk79PkIfNFOVzTcjCMPGKIDj9Lqx9lJmV7cdBVQZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-fyenpx19UpfUhZ+SD9o9IdxeIJKE6upKx0B54OcXy1TqnO660Qw9xw6rOASP+eir" crossorigin="anonymous">
</head>

<body>
    <!-- sidebar offcanvas -->
  @include('trainer.layouts.sidebar')
    <!-- end sidebar offcanvas -->
    <!-- modal start -->
    <!-- The Modal -->
    <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createClassModalLabel">Create class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="description" class="form-control" placeholder="Class name (required)" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-control" name="subject">
                               
                                    <option value="">Reem</option>
                                    <option value="">Rawan</option>
                                    <option value="">Malak</option>
                                    
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Room">
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
    {{-- start header --}}
  @include('trainer.layouts.header')
    {{-- end header --}}

    {{-- content --}}
@yield('trainerHome')
    {{-- content --}}
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/js/boosted.bundle.min.js" integrity="sha384-+lAXqnipqQpjxMdd/9Hp2GOzB4aIouKEYRZ7AE66h68BDob7UlMLpZY7w7SqrC+M" crossorigin="anonymous"></script>
</body>

</html>