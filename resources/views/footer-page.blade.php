<div class="__section-vertical_standard_footer">
    <div class="main-footer section-footer__main col-12">
        <div class="standart__footer-left col-lg-4 col-md-4 col-sm-12">
            <h3 class="title-standart__footer">Follow us</h3>
            <div class="box-content-vertical-left_foot">
                <div class="logo__footer-content">
                    <a href="#"><img class="logo-footer" src="{{ URL::asset('image/logo.jpg') }}"></a>
                    <p class="content-quotes">
                        <i>“Pets are humanizing. They remind us we have an obligation and responsibility to preserve and
                            nurture and care for all life.” </i>
                        <b style="text-align:right;">James Cromwell, American Actor</b>
                    </p>
                </div>
                <div class="contact__footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="standart__footer-center col-lg-3 col-md-3 col-sm-12">
            <div class="footer-menu-nav navigation-center__footer">
                <h3 class="title-standart__footer">Links</h3>
                <nav class="navbar-nav-footer-menu">
                    <ul>
                        <li><a href="{{ route('welcome') }}" class="{{ request()->is('welcome*') ? 'activated' : '' }} {{ request()->is('/') ? 'activated' : '' }}">Home</a></li>
                        <li><a href="{{ route('boardingShop') }}" class="{{ request()->is('boarding*') ? 'activated' : '' }}">Boarding</a></li>
                        <li><a href="{{ route('services') }}" class="{{ request()->is('services*') ? 'activated' : '' }}">Services</a></li>
                        <li><a href="{{ route('shop') }}" class="{{ request()->is('shop*') ? 'activated' : '' }}">Shop</a></li>
                        <li><a href="#" class="{{ request()->is('blog*') ? 'activated' : '' }}">Blogs</a></li>
                        <li><a href="{{ route('pages.shopAddress') }}" class="{{ request()->is('pages/shopAddress*') ? 'activated' : '' }}">Adddress & Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="standart__footer-right col-lg-5 col-md-5 col-sm-12">
            <div class="footer-follow-us standart-footer__follow-us">
                <h3 class="title-standart__footer">Find us</h3>
                <div class="box-content-vertical-right_foot">
                    <div class="about-find-us">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                    </div>
                    <div class="address-find-us find-us-content">
                        <i class="fas fa-map-marked-alt"></i>
                        <div>
                            <p class="content">Hà Nội: 63A/447 - Ngọc Lâm - Long Biên - Hà Nội</p>
                            <p class="content">HCM: 79/24/34E Âu Cơ, Phường 14, Quận 11, Thành
                                phố Hồ Chí Minh, Việt Nam</p>
                        </div>
                    </div>
                    <div class="tel-find-us find-us-content">
                        <i class="fas fa-phone-volume"></i>
                        <div>
                            <p class="content">0123456789 (from 8am to 6pm)</p>
                            <p class="content">0123777782 (available 24/7)</p>
                        </div>
                    </div>
                    <div class="email-find-us find-us-content">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <p class="content">giakhanh010200@gmail.com</p>
                            <p class="content">moonlighthotel@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
