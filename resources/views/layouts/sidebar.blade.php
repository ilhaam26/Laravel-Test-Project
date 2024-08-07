<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link" style="color:#eee;">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @if (auth()->user()->can('view-users') ||
            auth()->user()->can('create-users') ||
            auth()->user()->can('edit-users') ||
            auth()->user()->can('delete-users') ||
            auth()->user()->can('view-roles') ||
            auth()->user()->can('create-roles') ||
            auth()->user()->can('edit-roles') ||
            auth()->user()->can('delete-roles') ||
            auth()->user()->can('view-permission') ||
            auth()->user()->can('create-permission') ||
            auth()->user()->can('edit-permission') ||
            auth()->user()->can('delete-permission'))
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link" style="color:#eee;">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User Manajement
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (auth()->user()->can('view-permission'))
                        <li class="nav-item">
                            <a href="{{ url('permission') }}" class="nav-link" style="color:#aaa;">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('view-roles'))
                        <li class="nav-item">
                            <a href="{{ url('roles') }}" class="nav-link" style="color:#aaa;">
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('view-users'))
                        <li class="nav-item">
                            <a href="{{ url('users') }}" class="nav-link" style="color:#aaa;">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (auth()->user()->can('view-employee'))
        <li class="nav-item has-treeview">
                <a href="#" class="nav-link" style="color:#eee;">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                     @if (auth()->user()->can('view-employee'))
                        <li class="nav-item">
                            <a href="{{ url('/employee') }}" class="nav-link" style="color:#aaa;">
                                <i class="far fa-user nav-icon"></i>
                                <p>Employee</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
        @endif
        
        <li class="nav-item">
            <a href="{{ url('/setting-web') }}" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    Setting Web
                </p>
            </a>
        </li>
        
    </ul>
</nav>
