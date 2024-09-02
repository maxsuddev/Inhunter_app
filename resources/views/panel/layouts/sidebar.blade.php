<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard')? '' : 'collapsed'  }}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.index')? '' : 'collapsed'  }}" href="{{route('users.index')}}">
                <i class="ri-account-circle-fill"></i>
                <span>User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('role.index')? '' : 'collapsed'  }}" href="{{route('role.index')}}">
                <i class="ri-admin-fill"></i>
                <span>Role</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('permission.index')? '' : 'collapsed'  }}" href="{{route('permission.index')}}">
                <i class="bi bi-person-check-fill"></i>
                <span>Permission</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('candidate.index')? '' : 'collapsed'  }}" href="{{route('candidate.index')}}">
                <i class="ri-open-arm-fill"></i>
                <span>Candidate</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('company.index')? '' : 'collapsed'  }}" href="{{route('company.index')}}">
                <i class="ri-government-fill"></i>
                <span>Company</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('category.index')}}">
                <i class="ri-grid-fill"></i>
                <span>Category</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('vacancy.index')}}">
                <i class="ri-briefcase-4-fill"></i>
                <span>Vacancy</span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->
