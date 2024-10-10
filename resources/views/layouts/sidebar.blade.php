  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      @canany(['view-users', 'view-roles'])
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-people"></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @can('view-users')
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-circle"></i><span>Users</span>
                        </a>
                    </li>
                @endcan

                @can('view-roles')
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="bi bi-circle"></i><span>Roles</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
      @endcanany
<!-- End Forms Nav -->

    </ul>

  </aside><!-- End Sidebar-->