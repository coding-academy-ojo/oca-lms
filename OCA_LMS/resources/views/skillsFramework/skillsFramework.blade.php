@extends('layouts.app')
@section('title')
Profile
@endsection



@section('content')
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Skills Framework</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  mt-3">
    <div class="container">

        <div class="skillsFramework">
            <div class="actionbtn">
                <div class="col-md-2 ms-auto mb-3">
                    <a href="/addSkillsFramework">Add skills Framework</a>
                    &nbsp;
                </div>
                <div class="col-md-2 ms-auto mb-3">

                    <a href="/editSkillsFramework">Edit skills Framework</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 mb-3">

                    <div class="tab">
                        <button class="tablinks active" onclick="openCity(event, 'London')">Create mock-ups for an application</button>
                        <button class="tablinks" onclick="openCity(event, 'Paris')">Create static and adaptive web user interfaces</button>
                        <button class="tablinks" onclick="openCity(event, 'Tokyo')">Develop a dynamic web user interface</button>
                    </div>
                </div>
                <div class="col-sm-9 mb-3">
                    <div id="London" class="tabcontent" style="display: block;">
                        <div class="row">
                            <div class="actionbtn ">
                                <div class="col-md-3 ms-auto mb-3">
                                    <a href="/addSkillsFramework">Add level</a>
                                    &nbsp;
                                </div>
                                <div class="col-md-3 ms-auto mb-3">
                                    <a href="/editSkillsFramework">Edit level</a>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3 class="text-center">level 1 (imitate) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 2 (adapt) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 3 (transpose) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                        </div>

                    </div>
                    <div id="Paris" class="tabcontent">
                        <h3>Assessment criteria 2</h3>
                        <p>From an expression of need (mock-up) and an existing static user interface:

                            - I adapt the interface content (change the text, etc.)

                            - I make minor changes to the structure of the interface (I add a title, a paragraph, etc.)

                            - I adapt the formatting of the interface (change the color of a title, change the font, etc.)
                    </div>

                    <div id="Tokyo" class="tabcontent">
                        <h3>Assessment criteria 3</h3>
                        <p>From an expression of need and an existing dynamic page, I make minor changes to the page:

                            - in terms of the interface content, its structure or its formatting,

                            - in terms of the client-side processes (input field validation, etc.).
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
@endsection