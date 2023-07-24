<header>
    <div class="fixed-header nav-header-admin">
        <div class="box-header-left flex-left">
            <div class="box-logo view-page-logo">
                <div class="logo-wrap" id="btnLogo">
                    <img src="{{ URL::asset('image/sm-logo.jpeg') }}" class="sm-logo-header-admin hover-show-link"/>
                    <span class="admin-logo-text" id="branding-logo">Moonlight</span>
                </div>
                <ul class="menu-paged menu-logo-dropdown">
                    <li class="menu-logo-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Trang chủ admin
                        </a>
                    </li>
                    <li class="menu-logo-item">
                        <a href="{{ route('welcome') }}" target="_blank">
                            Moonlight pet hotel
                        </a>
                    </li>
                </ul>
            </div>
            <button class="menu-aside-button" id="asideFullMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="box-info-admin flex-right view-admin-info">
            <button class="nav-admin-info header-admin-info" id="showInfoAdmin">
                <i class="fas fa-user-cog"></i>
                {{ Session::get('name') }}
            </button>
            <div class="box-nav-menu-info info-menu" id="menuAdmin">
                <ul class="nav-admin">
                    <li class="nav-admin-item">
                        <a href="#">
                            <i class="fas fa-address-book"></i>
                            Thông tin
                        </a>
                    </li>
                    <li class="nav-admin-item">
                        <a href="{{ route('admin.logout')}}">
                            <i class="fas fa-sign-out-alt"></i>
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<script type="text/javascript" src="{{ URL::asset('js/header.js') }}">
</script>
