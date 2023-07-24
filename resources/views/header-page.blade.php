<div id="page-site-wrapper" class="site-wrapper-full">
    <div class="container-site-wrapper__mlh">
        <div class="header site-header __moonlight-hotel-header">
            <div class="site-header-content">
                <div class="site-branding logo-heading">
                    <a href="{{ route('welcome') }}" class="custom-branding-link">
                        <img src="{{ URL::asset('image/sm-logo.jpeg') }}" class="img-logo-on-custom sm-logo-link">
                    </a>
                </div>
                <nav class="main-navigation main-nav-link-header">
                    <div class="primary-menu-wrapper primary-menu-container">
                        <ul id="primary-menu-nav" class="menu nav-menu primary-nav-menu">
                            <li class="pri-nav-menu-content" id="menu-boarding-site">
                                <a href="{{ route('boardingShop') }}"
                                    class="{{ request()->is('boarding*') ? 'activated' : '' }}"
                                    id="boarding-site-link">Boarding</a>
                            </li>
                            <li class="pri-nav-menu-content menu-shop-site" id="menu-shop-site">
                                <a href="{{ route('shop') }}" class="{{ request()->is('shop*') ? 'activated' : '' }}"
                                    id="shop-site-link">Shop</a>
                            </li>
                            <li class="pri-nav-menu-content menu-blogs-site" id="menu-blogs-site">
                                <a href="{{ route('blogs_page') }}" class="{{ request()->is('blogs*') ? 'activated' : '' }}"
                                    id="blogs-site-link">Blogs</a>
                            </li>
                            <li class="pri-nav-menu-content menu-services-site" id="menu-services-site">
                                <a href="{{ route('services') }}"
                                    class="{{ request()->is('services*') ? 'activated' : '' }}"
                                    id="services-site-link">Services</a>
                            </li>
                            <li class="pri-nav-menu-content menu-pages-site">
                                <a href="#" class="{{ request()->is('pages*') ? 'activated' : '' }}">Pages <i
                                        class="fas fa-caret-down"></i></a>
                                <ul class="pages-submenu-dropdown">
                                    <li class="submenu-dropdown-item">
                                        <a href="{{ route('pages.aboutUs') }}"
                                            class="{{ request()->is('pages/aboutUs*') ? 'activated' : '' }}"
                                            id="aboutUs-site-link">About Us</a>
                                    </li>
                                    <li class="submenu-dropdown-item">
                                        <a href="{{ route('pages.shopAddress') }}"
                                            class="{{ request()->is('pages/shopAddress*') ? 'activated' : '' }}"
                                            id="address-contact-site-link">Address & Contact</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="navigation-submenu-links">
                    <div class="header-account-link-wrapper header__link_wrapper">

                        @if (Session::has('user_id'))
                            <a href="{{ route('users.user_info') }}"
                                class="{{ request()->is('users/user_info*') ? 'activated' : '' }}"
                                id="user-info-site-link">
                                <i class="fas fa-user-circle"></i>
                                @if (Session::has('user_id'))
                                    {{ Session::get('name') }}
                                @endif
                            </a>
                            <div class="header-account-menu" id="accountMenu">
                                <nav class="nav-account-head">
                                    <ul class="dropdown-menu-nav">
                                        <li class="navbar nav-item-dropdown">
                                            <a href="{{ route('users.user_info') }}">
                                                <i class="fas fa-address-book"></i> Account
                                            </a>
                                        </li>

                                        <li class="navbar nav-item-dropdown">
                                            <a href="{{ route('users.logout') }}">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @else
                            <div class="header-login-menu">
                                <div class="login-container-link">
                                    <a class="{{ request()->is('users/user_login*') ? 'activated' : '' }}"
                                        href="{{ route('users.user_login') }}">Login</a>
                                    <p>/</p>
                                    <a class="{{ request()->is('users/user_register*') ? 'activated' : '' }}"
                                        href="{{ route('users.user_register') }}">Register</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="header-cart-link-wrapper header__link_wrapper">
                        <a href="{{ route('users.products_cart_users') }}"
                            class="{{ request()->is('users/products_cart_users*') ? 'activated' : '' }}"
                            id="shopping-cart-site-link">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <div class="header-search-wrapper header__link_wrapper">
                        <a href="{{ route('users.products_wishlist') }}"
                            class="{{ request()->is('users/products_wishlist*') ? 'activated' : '' }}"
                            id="wishlist-site-link">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="header-search-wrapper header__link_wrapper">
                        <button data-toggle="modal" data-target="#searchDataPage" id="search-site-link">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="modal modal-search-everything" id="searchDataPage">
                        <div class="form-search">
                            <form class="form-searching-every full-screen-search" id="searchingThings" method="GET" action="{{ route('searching_all') }}">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h1 class="title-search-form">Searching something ...</h1>
                                    <div class="block-input-tp">
                                        <input type="text" name="searchingAll" class=".full-screen-search__input input-search form-control" placeholder="Keywords...">
                                    <button class="btn-action btn-search" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="header-contact-wrapper">
                        <a href="tel:0123456789" id="tel-contact-site-link">
                            <i class="fas fa-phone"></i>
                            0123456789
                        </a>
                    </div>
                </div>
            </div>
        </div>

