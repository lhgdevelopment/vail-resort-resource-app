<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @canany(['view-categories'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categories.*', 'resources.*', 'ltos.*', 'lto_months.*') ? '' : 'collapsed' }}" data-bs-target="#categories-nav" data-bs-toggle="collapse" href="#" aria-expanded="{{ request()->routeIs('categories.*', 'resources.*') ? 'true' : 'false' }}">
                    <i class="bi bi-folder"></i><span>Manage Resource</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="categories-nav" class="nav-content collapse {{ request()->routeIs('categories.*', 'resources.*', 'ltos.*', 'lto_months.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                    @can('view-categories')
                        <li>
                            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Categories</span>
                            </a>
                        </li>
                    @endcan

                    @can('view-resources')
                        <li>
                            <a href="{{ route('resources.index') }}" class="{{ request()->routeIs('resources.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Resources</span>
                            </a>
                        </li>
                    @endcan

                    @can('view-lto-month')
                        <li>
                            <a href="{{ route('lto_months.index') }}" class="{{ request()->routeIs('lto_months.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>LTO Month</span>
                            </a>
                        </li>
                    @endcan
                    @can('view-ltos')
                        <li>
                            <a href="{{ route('ltos.index') }}" class="{{ request()->routeIs('ltos.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>LTO</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['view-users', 'view-roles'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.*', 'roles.*') ? '' : 'collapsed' }}" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#" aria-expanded="{{ request()->routeIs('users.*', 'roles.*') ? 'true' : 'false' }}">
                    <i class="bi bi-people"></i><span>Manage User</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="users-nav" class="nav-content collapse {{ request()->routeIs('users.*', 'roles.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                    @can('view-users')
                        <li>
                            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Users</span>
                            </a>
                        </li>
                    @endcan

                    @can('view-roles')
                        <li>
                            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Roles</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['view-settings', 'view-sliders', 'view-footer-banner', 'view-feel-special'])
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.*', 'sliders.*', 'admin.*', 'footer-banner.*', 'feel_special.*') ? '' : 'collapsed' }}" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#" aria-expanded="{{ request()->routeIs('settings.*', 'sliders.*', 'admin.*') ? 'true' : 'false' }}">
                    <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="settings-nav" class="nav-content collapse {{ request()->routeIs('settings.*', 'smtp.*', 'sliders.*', 'admin.*', 'footer-banner.*', 'feel_special.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                    @can('view-settings')
                        <li>
                            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>General Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('smtp.index') }}" class="{{ request()->routeIs('smtp.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>SMTP Settings</span>
                            </a>
                        </li>
                    @endcan

                    @can('view-sliders')
                        <li>
                            <a href="{{ route('sliders.index') }}" class="{{ request()->routeIs('sliders.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Sliders</span>
                            </a>
                        </li>
                    @endcan
                    @can('view-footer-banner')
                        <li>
                            <a href="{{ route('footer-banner.create') }}" class="{{ request()->routeIs('footer-banner.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Footer Banner</span>
                            </a>
                        </li>
                    @endcan
                    @can('view-feel-special')
                        <li>
                            <a href="{{ route('feel_special.index') }}" class="{{ request()->routeIs('feel_special.*') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Feel Special</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{route('admin.profile.edit')}}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>My Profile</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany
    </ul>
</aside><!-- End Sidebar-->
