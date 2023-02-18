    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <i class="mdi mdi-speedometer menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/orders') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/orders') }}">
                    <i class="mdi mdi-sale menu-icon"></i>
                    <span class="menu-title">Orders</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#category"
                    aria-expanded="{{ Request::is('admin/category*') ? 'true' : 'false' }}">
                    <i class="mdi mdi-view-list menu-icon"></i>
                    <span class="menu-title">Category</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('admin/category*') ? 'show' : '' }}" id="category">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/category/create') ? 'active' : '' }}"
                                href="{{ url('admin/category/create') }}">Add
                                Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/*/edit') ? 'active' : '' }}"
                                href="{{ url('admin/category') }}">
                                View Category
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/product*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#products"
                    aria-expanded="{{ Request::is('admin/product*') ? 'true' : 'false' }}">
                    <i class="mdi mdi-plus-circle menu-icon"></i>
                    <span class="menu-title">Product</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('admin/product*') ? 'show' : '' }}" id="products">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a
                                class="nav-link {{ Request::is('admin/product/create') ? 'active' : '' }}"
                                href="{{ url('admin/product/create') }}">Add
                                Product</a></li>
                        <li class="nav-item"> <a
                                class="nav-link {{ Request::is('admin/product') || Request::is('admin/product/*/edit') ? 'active' : '' }}"
                                href="{{ url('admin/product') }}">View Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/brands') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/brands') }}">
                    <i class="mdi mdi-view-headline menu-icon"></i>
                    <span class="menu-title">Brands</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/colors') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/colors') }}">
                    <i class="mdi mdi-palette menu-icon"></i>
                    <span class="menu-title">Colors</span>
                </a>
            </li>
            <li class="nav-item  {{ Request::is('admin/users*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#user"
                    aria-expanded="{{ Request::is('admin/users*') ? 'true' : 'false' }}">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ Request::is('admin/users*') ? 'show' : '' }}" id="user">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/users/create') ? 'active' : '' }}"
                                href="{{ url('/admin/users/create') }}">
                                Add Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active' : '' }}"
                                href="{{ url('admin/users') }}">
                                View Users
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Request::is('admin/sliders') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/sliders') }}">
                    <i class="mdi mdi-view-carousel menu-icon"></i>
                    <span class="menu-title">Home Sliders</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/site-setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/site-setting') }}">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Site Setting</span>
                </a>
            </li>
        </ul>
    </nav>
