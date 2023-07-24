<div class="main">
    <aside class="aside-nav-menu">
        <div class="admin-menu-control">
            <ul class="side-nav-control nav-nicescroll">
                <li class="aside-nav-title aside-nav-control-item">
                    <button id="asideMain">
                        <i class="fas fa-angle-double-right"></i>
                        <p class="aside-item-text">main</p>
                    </button>
                </li>
                <li class="aside-nav-for-main aside-nav-items">
                    <div class="main-aside-menu" id="menuAsideForMain">
                        <ul>
                            <li class="aside-main-items aside-nav-control-item" id="menuDashboard">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/dashboard*') ? 'activated' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <p class="aside-item-text">Dashboard</p>
                                </a>
                            </li>
                            <li class="aside-main-items aside-nav-control-item" id="menuChart">
                                <a href="{{ route('admin.chart') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/chart*') ? 'activated' : '' }}">
                                    <i class="fas fa-chart-area"></i>
                                    <p class="aside-item-text">Statistical</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="aside-nav-title aside-nav-control-item">
                    <button id="asidePB">
                        <i class="fas fa-angle-double-right"></i>
                        <p class="aside-item-text">Products & Blogs</p>
                    </button>
                </li>
                <li class="aside-nav-for-pb aside-nav-items">
                    <div class="pb-aside-menu" id="menuAsideForPB">
                        <ul>
                            <li class="aside-pb-items aside-nav-control-item" id="menuBlog">
                                <a href="{{ route('admin.blog') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/blog*') ? 'activated' : '' }}">
                                    <i class="fas fa-pen-nib"></i>
                                    <p class="aside-item-text">Blog</p>
                                </a>
                            </li>
                            <li class="aside-pb-items aside-nav-control-item" id="menuProduct">
                                <a href="{{ route('admin.product') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/product*') ? 'activated' : '' }}">
                                    <i class="fas fa-box"></i>
                                    <p class="aside-item-text">Product</p>
                                </a>
                            </li>
                            <li class="aside-pb-items aside-nav-control-item" id="menuCategory">
                                <a href="{{ route('admin.category') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/category*') ? 'activated' : '' }}">
                                    <i class="fab fa-buffer"></i>
                                    <p class="aside-item-text">Category</p>
                                </a>
                            </li>
                            <li class="aside-pb-items aside-nav-control-item" id="menuPet">
                                <a href="{{ route('admin.pet') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/pet*') ? 'activated' : '' }}">
                                    <i class="fas fa-paw"></i>
                                    <p class="aside-item-text">Pet</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="aside-nav-title aside-nav-control-item">
                    <button id="asideSv">
                        <i class="fas fa-angle-double-right"></i>
                        <p class="aside-item-text">Services</p>
                    </button>
                </li>
                <li class="aside-nav-for-sv aside-nav-items">
                    <div class="sv-aside-menu" id="menuAsideForSv">
                        <ul>
                            <li class="aside-sv-items aside-nav-control-item" id="menuService">
                                <a href="{{ route('admin.service') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/service*') ? 'activated' : '' }}">
                                    <i class="fas fa-briefcase-medical"></i>
                                    <p class="aside-item-text">Service</p>
                                </a>
                            </li>
                            <li class="aside-sv-items aside-nav-control-item" id="menuBoarding">
                                <a href="{{ route('admin.boarding') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/boarding*') ? 'activated' : '' }}">
                                    <i class="fas fa-moon"></i>
                                    <p class="aside-item-text">Boarding</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="aside-nav-title aside-nav-control-item">
                    <button id="asideCart">
                        <i class="fas fa-angle-double-right"></i>
                        <p class="aside-item-text">Carts</p>
                    </button>
                </li>
                <li class="aside-nav-for-cart aside-nav-items">
                    <div class="cart-aside-menu" id="menuAsideForCart">
                        <ul>
                            <li class="aside-cart-items aside-nav-control-item" id="menuPrdCart">
                                <a href="{{ route('admin.cart_product') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/cart_product*') ? 'activated' : '' }}">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <p class="aside-item-text">Product cart</p>
                                </a>
                            </li>
                            <li class="aside-cart-items aside-nav-control-item" id="menuSvCart">
                                <a href="{{ route('admin.cart_service') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/cart_service*') ? 'activated' : '' }}">
                                    <i class="fas fa-cart-plus"></i>
                                    <p class="aside-item-text">Service cart</p>
                                </a>
                            </li>
                            <li class="aside-cart-items aside-nav-control-item" id="menuSvCart">
                                <a href="{{ route('admin.cart_boarding') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/cart_boarding*') ? 'activated' : '' }}">
                                    <i class="fas fa-cart-plus"></i>
                                    <p class="aside-item-text">Boarding cart</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="aside-nav-title aside-nav-control-item">
                    <button id="asideUA">
                        <i class="fas fa-angle-double-right"></i>
                        <p class="aside-item-text">Users & Admins</p>
                    </button>
                </li>
                <li class="aside-nav-for-ua aside-nav-items">
                    <div class="ua-aside-menu" id="menuAsideForUA">
                        <ul>
                            <li class="aside-ua-items aside-nav-control-item" id="menuUsers">
                                <a href="{{ route('admin.users') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/users*') ? 'activated' : '' }}">
                                    <i class="fas fa-id-card"></i>
                                    <p class="aside-item-text">Users</p>
                                </a>
                            </li>
                            <li class="aside-ua-items aside-nav-control-item" id="menuAdmin">
                                <a href="{{ route('admin.admin_control') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/admin*') ? 'activated' : '' }}">
                                    <i class="fas fa-id-card-alt"></i>
                                    <p class="aside-item-text">Admin</p>
                                </a>
                            </li>
                            <li class="aside-ua-items aside-nav-control-item" id="menuAdmin">
                                <a href="{{ route('admin.shop_address') }}"
                                    class="menu-side-nav-link {{ request()->is('admin/shop_address*') ? 'activated' : '' }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="aside-item-text">Shop</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
