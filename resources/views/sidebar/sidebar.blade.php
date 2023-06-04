<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <!-- <li class="{{set_active(['setting/page'])}}">
                    <a href="{{ route('setting/page') }}">
                        <i class="fas fa-cog"></i> 
                        <span>Settings</span>
                    </a>
                </li> -->
                <li class="submenu {{set_active(['home','teacher/dashboard','student/dashboard'])}}">
                    <a href="#"><i class="fas feather-grid"></i>
                        <span>Dashboard</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{set_active(['home'])}}">Super Admin</a></li>
                        <!-- <li><a href="{{ route('teacher/dashboard') }}" class="{{set_active(['teacher/dashboard'])}}">Admin Wisata</a></li>
                        <li><a href="{{ route('student/dashboard') }}" class="{{set_active(['student/dashboard'])}}">User</a></li> -->
                        <li><a href="admin-wisata.html">Admin Wisata</a></li>
                        <li><a href="user.html">Pengguna</a></li>
                    </ul>
                </li>

                <!-- USER MANAGEMENT -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/users'])}}">
                    <a href="#"><i class="fas fa-shield-alt"></i>
                        <span>Manajemen User</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/users') }}" class="{{set_active(['list/users'])}}">Semua</a>
                        </li>
                        <li>
                            <a href="{{ route('list/users/super') }}" class="{{set_active(['list/users/super'])}}">Super Admin</a>
                        </li>
                        <li>
                            <a href="{{ route('list/users/admin') }}" class="{{set_active(['list/users/admin'])}}">Admin Wisata</a>
                        </li>
                        <li>
                            <a href="{{ route('list/users/pengguna') }}" class="{{set_active(['list/users/pengguna'])}}">Pengguna</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- USER MANAGEMENT -->

                <!-- KATEGORI -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/categories','categories/create','categories/edit'])}}">
                    <a href="#"><i class="fas fa-th-list"></i>
                        <span>Kategori</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/categories') }}" class="{{set_active(['list/categories'])}}">Kategori List</a>
                        </li>
                        <li>
                            <a href="{{ route('categories/create') }}" class="{{set_active(['categories/create'])}}">Kategori Add</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- KATEGORI -->

                <!-- TEMPAT -->
                <li class="submenu">
                    <a href="#"><i class="fas fa-map-marked-alt"></i>
                        <span>Tempat</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="subjects.html">Tempat List</a></li>
                        <li><a href="add-subject.html">Tempat Add</a></li>
                        <li><a href="edit-subject.html">Tempat Edit</a></li>
                    </ul>
                </li>
                <!-- TEMPAT -->

                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span>Others Menu</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="invoices.html">Menu List</a></li>
                        <li><a href="invoice-grid.html">Menu Grid</a></li>
                        <li><a href="add-invoice.html">Add Menu</a></li>
                        <li><a href="edit-invoice.html">Edit Menu</a></li>
                        <li><a href="view-invoice.html">Menu Details</a></li>
                        <li><a href="invoices-settings.html">Menu Settings</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Account</span>
                </li>
                <!-- Profile -->
                <li class="{{set_active(['profile/user'])}}">
                    <a href="{{ route('profile/user') }}" class="{{set_active(['profile/user'])}}"><i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- Profile -->

                <li>
                    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>