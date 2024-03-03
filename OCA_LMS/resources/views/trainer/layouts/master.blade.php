<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boosted demo</title>
    <!-- Copyright © 2014 Monotype Imaging Inc. All rights reserved -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <link href="{{asset('assets/boosted/dist/css/orangeHelvetica.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/boosted/dist/css/boosted.min.css" rel="stylesheet')}}">
    
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-fyenpx19UpfUhZ+SD9o9IdxeIJKE6upKx0B54OcXy1TqnO660Qw9xw6rOASP+eir" crossorigin="anonymous">
  </head>
  
  <script src="{{asset('assets/boosted/dist/js/boosted.bundle.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/js/boosted.bundle.min.js"></script>
  <body>
 
    <!-- sidebar offcanvas -->
  @include('trainer.layouts.sidebar')
    <!-- end sidebar offcanvas -->
   
 
    {{-- start header --}}
  @include('trainer.layouts.header')
    {{-- end header --}}

    {{-- content --}}
@yield('trainerHome')
    {{-- content --}}
        <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/js/boosted.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.2/dist/js/boosted.bundle.min.js" integrity="sha384-+lAXqnipqQpjxMdd/9Hp2GOzB4aIouKEYRZ7AE66h68BDob7UlMLpZY7w7SqrC+M" crossorigin="anonymous"></script>
</body>

</html>