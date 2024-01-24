<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <!-- Off-canvas sidebar -->
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Sidebar content here -->
        <ul class="list-group list-group-flush">
            <!-- Home -->
            <li class="list-group-item">
                <span class="material-icons">home</span> Home
            </li>
            <!-- Calendar -->
            <li class="list-group-item">
                <span class="material-icons">event</span> Calendar
            </li>
            <!-- Teaching toggle -->
            <li class="list-group-item" data-bs-toggle="collapse" data-bs-target="#teachingSubMenu" aria-expanded="false" aria-controls="teachingSubMenu">
                <span class="material-icons">school</span> Teaching
                <span class="material-icons">expand_more</span>
            </li>
            <div class="collapse" id="teachingSubMenu">
                <li class="list-group-item">
                    JS Class
                </li>
                <li class="list-group-item">
                    PHP Class
                </li>
            </div>
            <!-- To review -->
            <li class="list-group-item">
                <span class="material-icons">check_circle</span> To review
            </li>
            <!-- Enrolled toggle -->
            <li class="list-group-item" data-bs-toggle="collapse" data-bs-target="#enrolledSubMenu" aria-expanded="false" aria-controls="enrolledSubMenu">
                <span class="material-icons">class</span> Enrolled
                <span class="material-icons">expand_more</span>
            </li>
            <div class="collapse" id="enrolledSubMenu">
                <li class="list-group-item">
                    CSS Class
                </li>
                <li class="list-group-item">
Laravel Class                </li>
            </div>
            <!-- To-do -->
            <li class="list-group-item">
                <span class="material-icons">done_all</span> To-do
            </li>

            <!-- Archived classes -->
            <li class="list-group-item">
                <span class="material-icons">archive</span> Archived classes
            </li>
            <!-- Settings -->
            <li class="list-group-item">
                <span class="material-icons">settings</span> Settings
            </li>
            <!-- logout -->
            <li class="list-group-item justify-self-center ">
                <span class="material-icons">exit_to_app</span>     <a style="text-decoration: none" href="{{ route('logout') }}">Logout</a>
                
            </li>
        </ul>
    </div>
</div>