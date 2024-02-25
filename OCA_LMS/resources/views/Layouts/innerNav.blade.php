{{-- <div class="d-flex justify-content-center mt-4">
    <ul class="nav nav-pills py-2">
        <li class="nav-item ">
            <a class="nav-link active " href="{{route('view_material')}}">Materials</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  " href="{{route('announcements')}}">Announcements</a>
        </li>

        <li class="nav-item ">
            <a class="nav-link " href="{{route('assignment')}} ">Assignments</a>
        </li>
       
        <li class="nav-item ">
            <a class="nav-link " href="{{route('topics')}}">Topics</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{route('project')}}">Projects</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{route('attendance')}}">Attendance</a>
        </li>
        <li class=" nav-item ">
            <a class="nav-link" href="{{route('traineesProgress')}}">Trainee Progress</a>
        </li>
        <li class=" nav-item ">
            <a class="nav-link" href="{{route('staff')}}">Staff</a>
        </li>
    </ul>
</div> --}}


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <ul class="nav nav-pills py-2 flex-column flex-sm-row justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('view_material') }}">Materials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('announcements') }}">Announcements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('assignments') }}">Assignments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('topics') }}">Topics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('project') }}">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('attendance') }}">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('absence') }}">Absence</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('traineesProgress') }}">Trainee Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staff') }}">Staff</a>
                </li>
            </ul>
        </div>
    </div>
</div> 
<hr>
