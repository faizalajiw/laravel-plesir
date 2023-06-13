<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu</span>
                </li>
                <!-- <li class="{{set_active(['setting/page'])}}">
                    <a href="{{ route('setting/page') }}">
                        <i class="fas fa-cog"></i> 
                        <span>Settings</span>
                    </a>
                </li> -->

                <!-- DASHBOARD -->
                <li class="{{set_active(['home'])}}">
                    <a href="{{ route('home') }}" class="{{set_active(['home'])}}"><i class="fas feather-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- DASHBOARD -->

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

                <!-- SLIDER -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/sliders','sliders/create','sliders/edit'])}}">
                    <a href="#"><i class="fas fa-th-list"></i>
                        <span>Slider Banner</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/sliders') }}" class="{{set_active(['list/sliders'])}}">Slider Banner</a>
                        </li>
                        <li>
                            <a href="{{ route('sliders/create') }}" class="{{set_active(['sliders/create'])}}">Tambah Slider Banner</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- SLIDER -->

                <!-- KATEGORI -->
                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['list/categories','categories/create','categories/edit'])}}">
                    <a href="#"><i class="fas fa-th-list"></i>
                        <span>Kategori</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('list/categories') }}" class="{{set_active(['list/categories'])}}">Kategori</a>
                        </li>
                        <li>
                            <a href="{{ route('categories/create') }}" class="{{set_active(['categories/create'])}}">Tambah Kategori</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- KATEGORI -->

                <!-- TEMPAT -->
                <!-- SUPER ADMIN & ADMIN WISATA -->
                @if (Session::get('role_name') === 'Super Admin' || Session::get('role_name') === 'Admin Wisata')
                <li class="submenu {{set_active(['list/places','places/create','places/edit'])}}">
                    <a href="#"><i class="fas fa-map-marked-alt"></i>
                        <span>Tempat</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <!-- ONLY SUPER ADMIN -->
                        @if (Session::get('role_name') === 'Super Admin')
                        <li><a href="{{ route('list/places') }}" class="{{set_active(['list/places'])}}">Kelola Semua Tempat</a></li>
                        @endif
                        <li><a href="{{ route('list/my_places') }}" class="{{set_active(['list/my_places'])}}">Kelola Tempat Saya</a></li>
                        <li><a href="{{ route('places/create') }}" class="{{set_active(['places/create'])}}">Tambah Tempat</a></li>
                    </ul>
                </li>
                @endif
                <!-- TEMPAT -->

                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span>Rating & Ulasan</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="#">Lihat Ulasan Saya</a></li>
                        <li><a href="#">Edit Ulasan</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Akun</span>
                </li>
                <!-- Profile -->
                <li class="{{set_active(['profile/user'])}}">
                    <a href="{{ route('profile/user') }}" class="{{set_active(['profile/user'])}}"><i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- Profile -->

                <li>
                    <a href="{{ route('index') }}"><i class="fas fa-sign-out-alt"></i><span>Web</span></a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>