<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="" class="text-nowrap logo-img">
                <img src="{{asset('public/admin/images/logos/dark-logo.svg')}}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/dashboard')])" href="{{route('admin.dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Users Section</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" data-bs-toggle="collapse" href="#submenuSettings">
                    <span>
                        <i class="ti ti-settings"></i>
                    </span>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul class="collapse list-unstyled" id="submenuSettings">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.users.list')}}">All Users</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.users.active')}}">Active Users</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.users.inactive')}}">Inactive User</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Product Section</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/categories/list')])" href="{{route('admin.categories.list')}}" aria-expanded="false">
                        <span>
                          <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/colors/list')])" href="{{route('admin.colors.list')}}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Color</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/brands/list')])" href="{{route('admin.brands.list')}}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Brand</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" data-bs-toggle="collapse" href="#subProductSetting">
                    <span>
                        <i class="ti ti-settings"></i>
                    </span>
                        <span class="hide-menu">Product</span>
                    </a>
                    <ul class="collapse list-unstyled" id="subProductSetting">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.products.list')}}">All Product</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.products.active')}}">Active Product</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('admin.products.inactive')}}">Inactive Product</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Stock Section</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/suppliers/list')])" href="{{route('admin.suppliers.list')}}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Suppliers</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Shipping Section</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link @class(['active'=>request()->is('admin/shipping/list')])" href="{{route('admin.shipping.list')}}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Shipping</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
