<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('users.index')}}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('role.index')}}">
                <i class="bi bi-person"></i>
                <span>Role</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('permission.index')}}">
                <i class="bi bi-person"></i>
                <span>Permission</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('candidate.index')}}">
                <i class="bi bi-person"></i>
                <span>Candidate</span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->
