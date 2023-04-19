<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal  menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item {{ is_route('admin', 'active') }}">
                <a href="{{ route('admin') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>
            <!-- Form Pertanyaan -->
            <li class="menu-item {{ is_route('admin.question', 'active') }}">
                <a href="{{ route('admin.question') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-content"></i>
                    <div data-i18n="Form Kuisioner">Form Kuisioner</div>
                </a>
            </li>
            <!-- Manajemen Alumni -->
            <li class="menu-item {{ is_route('user.index', 'active') }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Manajemen Alumni">Manajemen Alumni</div>
                </a>
            </li>
            <!-- Manajemen Jurusan -->
            <li class="menu-item {{ is_route('major.index', 'active') }}">
                <a href="{{ route('major.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-blanket"></i>
                    <div data-i18n="Manajemen Jurusan">Manajemen Jurusan</div>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Layouts">Manajemen Alumni</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-menu"></i>
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                            <i class="menu-icon tf-icons bx bx-vertical-center"></i>
                            <div data-i18n="Vertical">Vertical</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-fluid.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-fullscreen"></i>
                            <div data-i18n="Fluid">Fluid</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-container.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-exit-fullscreen"></i>
                            <div data-i18n="Container">Container</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-blank.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-square-rounded"></i>
                            <div data-i18n="Blank">Blank</div>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</aside>
