
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <ul class="nav nav-pills py-2 flex-column flex-sm-row justify-content-center">
                @auth('staff')
                @if(Auth::guard('staff')->user()->role == 'trainer')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('skillsFramework')}}">Skills Framework</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.index')}}">Technology category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.indexCohort') ? 'text-primary' : '' }}" href="{{ route('categories.indexCohort') }}">Roadmap</a>
        
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('Announcements') ? 'text-primary' : '' }}" href="{{ route('Announcements') }}">Announcements</a>
               
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('assignments') ? 'text-primary' : '' }}" href="{{ route('assignments') }}">Assignments</a>
             
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('show_all_projects') ? 'text-primary' : '' }}" href="{{ route('show_all_projects') }}">Projects</a>
               
                </li>
               
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('attendance') ? 'text-primary' : '' }}" href="{{ route('attendance') }}">Attendance</a>
              
                </li>
               
                @endif
                @if(in_array(Auth::guard('staff')->user()->role, ['super_manager', 'manager', 'trainer']))

                
               
                @endif
                @if(in_array(Auth::guard('staff')->user()->role, [ 'manager', 'trainer']))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('absence') ? 'text-primary' : '' }}" href="{{ route('absence') }}">Absence</a>
              
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('traineesProgress') ? 'text-primary' : '' }}" href="{{ route('traineesProgress') }}">Progress</a>
       
                </li>
               
                @endif
               

                @endauth
            </ul>
        </div>
    </div>
</div>
@auth('staff')

@if(in_array(Auth::guard('staff')->user()->role, [ 'manager', 'trainer']))


<hr>
    
@endif
@endauth