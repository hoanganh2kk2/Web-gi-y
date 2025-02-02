<!-- Header start  -->
<header class="ec-header">
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="{{route('fe.home')}}"><img src="{{asset('assets/images/logo.png')}}" alt="Site Logo" /><img
                                        class="dark-logo" src="{{asset('assets/images/logo.png')}}" alt="Site Logo"
                                        style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="#">
                                <input class="form-control" placeholder="Tìm kiếm thông tin ..." type="text">
                                <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                @if(!auth()->check())
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="{{route('register')}}">Đăng ký</a></li>
                                        <li><a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a></li>
                                    </ul>
                                @else
                                    <button  class="dropdown-toggle auth-customer" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                                @endif
                            </div>
                            <!-- Header User End -->
                            <!-- Header wishlist Start -->
                            <a href="javascipt:void(0)" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                <span class="ec-header-count">4</span>
                            </a>
                            <!-- Header wishlist End -->
                            <!-- Header Cart Start -->
                            @if(auth()->check())
                                <a id="check_cart" href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                    <div class="header-icon"><i class="fi-rr-shopping-basket"></i></div>
                                    <span class="ec-header-count ec-cart-count cart-count-lable cart-count">{{check_cart()}}</span>
                                </a>
                            @else
                                <a id="check_cart" href="javascript:void (0)" onclick="replace('{{route('login')}}')" class="ec-header-btn ec-side-toggle">
                                    <div class="header-icon"><i class="fi-rr-shopping-basket"></i></div>
                                </a>
                            @endif

                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="index.html"><img src="assets/images/logo/logo-9.png" alt="Site Logo" /><img
                                    class="dark-logo" src="assets/images/logo/dark-logo-8.png" alt="Site Logo"
                                    style="display: none;" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="#">
                            <input class="form-control" placeholder="Enter Your Product Name..." type="text">
                            <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">
                        <ul>
                            <li><a href="{{route('fe.home')}}">Home</a></li>
                            <li class="dropdown position-static"><a href="javascript:void(0)">Categories</a>
                                <ul class="mega-menu d-block">
                                    <li class="d-flex">
                                        <ul class="d-block">
                                            <li class="menu_title"><a href="javascript:void(0)">Classic
                                                    Variation</a></li>
                                            <li><a href="shop-left-sidebar-col-3.html">Left sidebar 3 column</a>
                                            </li>
                                            <li><a href="shop-left-sidebar-col-4.html">Left sidebar 4 column</a>
                                            </li>
                                            <li><a href="shop-right-sidebar-col-3.html">Right sidebar 3 column</a>
                                            </li>
                                            <li><a href="shop-right-sidebar-col-4.html">Right sidebar 4 column</a>
                                            </li>
                                            <li><a href="shop-full-width.html">Full width 4 column</a></li>
                                        </ul>
                                        <ul class="d-block">
                                            <li class="menu_title"><a href="javascript:void(0)">Classic
                                                    Variation</a></li>
                                            <li><a href="shop-banner-left-sidebar-col-3.html">Banner left sidebar 3
                                                    column</a></li>
                                            <li><a href="shop-banner-left-sidebar-col-4.html">Banner left sidebar 4
                                                    column</a></li>
                                            <li><a href="shop-banner-right-sidebar-col-3.html">Banner right sidebar
                                                    3 column</a></li>
                                            <li><a href="shop-banner-right-sidebar-col-4.html">Banner right sidebar
                                                    4 column</a></li>
                                            <li><a href="shop-banner-full-width.html">Banner Full width 4 column</a>
                                            </li>
                                        </ul>
                                        <ul class="d-block">
                                            <li class="menu_title"><a href="javascript:void(0)">Columns
                                                    Variation</a></li>
                                            <li><a href="shop-full-width-col-3.html">3 Columns full width</a></li>
                                            <li><a href="shop-full-width-col-4.html">4 Columns full width</a></li>
                                            <li><a href="shop-full-width-col-5.html">5 Columns full width</a></li>
                                            <li><a href="shop-full-width-col-6.html">6 Columns full width</a></li>
                                            <li><a href="shop-banner-full-width-col-3.html">Banner 3 Columns</a>
                                            </li>
                                        </ul>
                                        <ul class="d-block">
                                            <li class="menu_title"><a href="javascript:void(0)">List Variation</a>
                                            </li>
                                            <li><a href="shop-list-left-sidebar.html">Shop left sidebar</a></li>
                                            <li><a href="shop-list-right-sidebar.html">Shop right sidebar</a></li>
                                            <li><a href="shop-list-banner-left-sidebar.html">Banner left sidebar</a>
                                            </li>
                                            <li><a href="shop-list-banner-right-sidebar.html">Banner right
                                                    sidebar</a></li>
                                            <li><a href="shop-list-full-col-2.html">Full width 2 columns</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul class="ec-main-banner w-100">
                                            <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img
                                                            class="img-responsive" src="assets/images/menu-banner/1.jpg"
                                                            alt=""></a></li>
                                            <li><a class="p-0" href="shop-left-sidebar-col-4.html"><img
                                                            class="img-responsive" src="assets/images/menu-banner/2.jpg"
                                                            alt=""></a></li>
                                            <li><a class="p-0" href="shop-right-sidebar-col-3.html"><img
                                                            class="img-responsive" src="assets/images/menu-banner/3.jpg"
                                                            alt=""></a></li>
                                            <li><a class="p-0" href="shop-right-sidebar-col-4.html"><img
                                                            class="img-responsive" src="assets/images/menu-banner/4.jpg"
                                                            alt=""></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{route('fe.category',['cmd' => 'san-pham'] )}}">Products</a>
                            </li>
                            <li class="dropdown"><a href="javascript:void(0)">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">Blog right sidebar</a></li>
                                    <li><a href="blog-detail-left-sidebar.html">Blog detail left sidebar</a></li>
                                    <li><a href="blog-detail-right-sidebar.html">Blog detail right sidebar</a></li>
                                    <li><a href="blog-full-width.html">Blog full width</a></li>
                                    <li><a href="blog-detail-full-width.html">Blog detail full width</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="javascript:void(0)">About</a>
                                <ul class="sub-menu">
                                    <li><a href="elemets-products.html">Products</a></li>
                                    <li><a href="elemets-typography.html">Typography</a></li>
                                    <li><a href="elemets-title.html">Titles</a></li>
                                    <li><a href="elemets-categories.html">Categories</a></li>
                                    <li><a href="elemets-buttons.html">Buttons</a></li>
                                    <li><a href="elemets-tabs.html">Tabs</a></li>
                                    <li><a href="elemets-accordions.html">Accordions</a></li>
                                    <li><a href="elemets-blog.html">Blogs</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="javascript:void(0)">Categories</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">Classic Variation</a>
                                <ul class="sub-menu">
                                    <li><a href="shop-left-sidebar-col-3.html">Left sidebar 3 column</a></li>
                                    <li><a href="shop-left-sidebar-col-4.html">Left sidebar 4 column</a></li>
                                    <li><a href="shop-right-sidebar-col-3.html">Right sidebar 3 column</a></li>
                                    <li><a href="shop-right-sidebar-col-4.html">Right sidebar 4 column</a></li>
                                    <li><a href="shop-full-width.html">Full width 4 column</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Classic Variation</a>
                                <ul class="sub-menu">
                                    <li><a href="shop-banner-left-sidebar-col-3.html">Banner left sidebar 3
                                            column</a></li>
                                    <li><a href="shop-banner-left-sidebar-col-4.html">Banner left sidebar 4
                                            column</a></li>
                                    <li><a href="shop-banner-right-sidebar-col-3.html">Banner right sidebar 3
                                            column</a></li>
                                    <li><a href="shop-banner-right-sidebar-col-4.html">Banner right sidebar 4
                                            column</a></li>
                                    <li><a href="shop-banner-full-width.html">Banner Full width 4 column</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Columns Variation</a>
                                <ul class="sub-menu">
                                    <li><a href="shop-full-width-col-3.html">3 Columns full width</a></li>
                                    <li><a href="shop-full-width-col-4.html">4 Columns full width</a></li>
                                    <li><a href="shop-full-width-col-5.html">5 Columns full width</a></li>
                                    <li><a href="shop-full-width-col-6.html">6 Columns full width</a></li>
                                    <li><a href="shop-banner-full-width-col-3.html">Banner 3 Columns</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">List Variation</a>
                                <ul class="sub-menu">
                                    <li><a href="shop-list-left-sidebar.html">Shop left sidebar</a></li>
                                    <li><a href="shop-list-right-sidebar.html">Shop right sidebar</a></li>
                                    <li><a href="shop-list-banner-left-sidebar.html">Banner left sidebar</a></li>
                                    <li><a href="shop-list-banner-right-sidebar.html">Banner right sidebar</a></li>
                                    <li><a href="shop-list-full-col-2.html">Full width 2 columns</a></li>
                                </ul>
                            </li>
                            <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img class="img-responsive"
                                                                                        src="assets/images/menu-banner/1.jpg" alt=""></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Products</a>
                        <ul class="sub-menu">
                            <li><a href="javascript:void(0)">Product page</a>
                                <ul class="sub-menu">
                                    <li><a href="product-left-sidebar.html">Product left sidebar</a></li>
                                    <li><a href="product-right-sidebar.html">Product right sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Product 360</a>
                                <ul class="sub-menu">
                                    <li><a href="product-360-left-sidebar.html">360 left sidebar</a></li>
                                    <li><a href="product-360-right-sidebar.html">360 right sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Product vodeo</a>
                                <ul class="sub-menu">
                                    <li><a href="product-video-left-sidebar.html">vodeo left sidebar</a></li>
                                    <li><a href="product-video-right-sidebar.html">vodeo right sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Product gallery</a>
                                <ul class="sub-menu">
                                    <li><a href="product-gallery-left-sidebar.html">Gallery left sidebar</a></li>
                                    <li><a href="product-gallery-right-sidebar.html">Gallery right sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="product-full-width.html">Product full width</a></li>
                            <li><a href="product-360-full-width.html">360 full width</a></li>
                            <li><a href="product-video-full-width.html">Video full width</a></li>
                            <li><a href="product-gallery-full-width.html">Gallery full width</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Others</a>
                        <ul class="sub-menu">
                            <li><a href="javascript:void(0)">Mail Confirmation</a>
                                <ul class="sub-menu">
                                    <li><a href="email-template-confirm-1.html">Mail Confirmation 1</a></li>
                                    <li><a href="email-template-confirm-2.html">Mail Confirmation 2</a></li>
                                    <li><a href="email-template-confirm-3.html">Mail Confirmation 3</a></li>
                                    <li><a href="email-template-confirm-4.html">Mail Confirmation 4</a></li>
                                    <li><a href="email-template-confirm-5.html">Mail Confirmation 5</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Mail Reset password</a>
                                <ul class="sub-menu">
                                    <li><a href="email-template-forgot-password-1.html">Reset password 1</a></li>
                                    <li><a href="email-template-forgot-password-2.html">Reset password 2</a></li>
                                    <li><a href="email-template-forgot-password-3.html">Reset password 3</a></li>
                                    <li><a href="email-template-forgot-password-4.html">Reset password 4</a></li>
                                    <li><a href="email-template-forgot-password-5.html">Reset password 5</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Mail Promotional</a>
                                <ul class="sub-menu">
                                    <li><a href="email-template-offers-1.html">Offer Mail 1</a></li>
                                    <li><a href="email-template-offers-2.html">Offer Mail 2</a></li>
                                    <li><a href="email-template-offers-3.html">Offer Mail 3</a></li>
                                    <li><a href="email-template-offers-4.html">Offer Mail 4</a></li>
                                    <li><a href="email-template-offers-5.html">Offer Mail 5</a></li>
                                    <li><a href="email-template-offers-6.html">Offer Mail 6</a></li>
                                    <li><a href="email-template-offers-7.html">Offer Mail 7</a></li>
                                    <li><a href="email-template-offers-8.html">Offer Mail 8</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Vendor Account Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                    <li><a href="vendor-profile.html">Vendor Profile</a></li>
                                    <li><a href="vendor-uploads.html">Vendor Uploads</a></li>
                                    <li><a href="vendor-settings.html">Vendor Settings</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">User Account Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="user-profile.html">User Profile</a></li>
                                    <li><a href="user-history.html">User History</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="track-order.html">Track Order</a></li>
                                    <li><a href="user-invoice.html">User Invoice</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Construction Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="404-error-page.html">404 Error Page</a></li>
                                    <li><a href="under-maintenance.html">Maintenance Page</a></li>
                                    <li><a href="coming-soon.html">Comming Soon Page</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Vendor Catalog Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="catalog-single-vendor.html">Catalog Single Vendor</a></li>
                                    <li><a href="catalog-multi-vendor.html">Catalog Multi Vendor</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="compare.html">Compare</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="track-order.html">Track Order</a></li>
                            <li><a href="terms-condition.html">Terms Condition</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="javascript:void(0)">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Blog right sidebar</a></li>
                            <li><a href="blog-detail-left-sidebar.html">Blog detail left sidebar</a></li>
                            <li><a href="blog-detail-right-sidebar.html">Blog detail right sidebar</a></li>
                            <li><a href="blog-full-width.html">Blog full width</a></li>
                            <li><a href="blog-detail-full-width.html">Blog detail full width</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="javascript:void(0)">Elements</a>
                        <ul class="sub-menu">
                            <li><a href="elemets-products.html">Products</a></li>
                            <li><a href="elemets-typography.html">Typography</a></li>
                            <li><a href="elemets-title.html">Titles</a></li>
                            <li><a href="elemets-categories.html">Categories</a></li>
                            <li><a href="elemets-buttons.html">Buttons</a></li>
                            <li><a href="elemets-tabs.html">Tabs</a></li>
                            <li><a href="elemets-accordions.html">Accordions</a></li>
                            <li><a href="elemets-blog.html">Blogs</a></li>
                        </ul>
                    </li>
                    <li><a href="offer.html">Hot Offers</a></li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <div class="header-top-lan-curr">
                    <!-- Language Start -->
                    <div class="header-top-lan dropdown">
                        <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu">
                            <li class="active"><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Italiano</a></li>
                        </ul>
                    </div>
                    <!-- Language End -->
                    <!-- Currency Start -->
                    <div class="header-top-curr dropdown">
                        <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu">
                            <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                            <li><a class="dropdown-item" href="#">EUR €</a></li>
                        </ul>
                    </div>
                    <!-- Currency End -->
                </div>
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- ekka mobile Menu End -->
</header>
<!-- Header End  -->