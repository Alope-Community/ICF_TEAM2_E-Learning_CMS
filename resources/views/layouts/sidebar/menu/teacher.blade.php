<div class="sidebar-content" id="nav">
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="link">
                <i class="ti-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-category">
            <span class="text-uppercase">Menu</span>
        </li>
        <li>
            <a href="#" class="main-menu has-dropdown">
                <i class="ti-folder"></i>
                <span>Kategori Materi</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('categoryCourse') }}" class="link">
                        <span>kategori Materi</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="main-menu has-dropdown">
                <i class="ti-book"></i>
                <span>Materi</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('course') }}" class="link">
                        <span>Kelola Materi</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="main-menu has-dropdown">
                <i class="ti-write"></i>
                <span>Tugas</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('tasks') }}" class="link">
                        <span>Kelola tugas</span></a>
                </li>
            </ul>
        </li>
        <li class="menu-category">
            <span class="text-uppercase">Pengaturan</span>
        </li>
        <li>
            <a href="#" class="main-menu has-dropdown">
                <i class="ti-settings"></i>
                <span>info Akun</span>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('setings.profile') }}" class="link">
                        <span>Kelola Profile</span></a>
                </li>
                <li><a href="{{ route('setings.changePassword') }}" class="link">
                        <span>Ganti Sandi</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="link">
                <i class="ti-power-off"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</div>
