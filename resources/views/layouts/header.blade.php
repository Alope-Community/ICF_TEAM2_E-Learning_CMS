<header class="header-navbar fixed">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="sidebar-toggle action-toggle lg-hidden"><i class="fas fa-bars"></i></div>
        </div>
        <div class="header-content">
            <div class="theme-switch-icon" hidden></div>
            <div class="dropdown dropdown-menu-end">
                <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="label">
                        <span></span>
                        <div>{{ auth()->user()->role }}</div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</header>


