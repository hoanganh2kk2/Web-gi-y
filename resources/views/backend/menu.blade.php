<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('home')}}" class="logo logo-dark text-center">
                        <span class="logo-sm fw-bold" style="font-size: 20px !important;">
                           <img width="130" src="{{url('assets/images/logo.png')}}" alt="logo">
                        </span>
            <span class="logo-lg fw-bold" style="font-size: 20px !important;">
             <img width="130" height="70" src="{{url('assets/images/logo-giay.png')}}" alt="logo">
                        </span>
        </a>

        <a href="{{route('home')}}" class="logo logo-light">
                        <span class="logo-sm fw-bold" style="font-size: 20px !important;">
                       <img width="130" src="{{url('assets/images/logo.png')}}" alt="logo">
                        </span>
            <span class="logo-lg fw-bold" style="font-size: 20px !important;">
                <img width="130" src="{{url('assets/images/logo.png')}}" alt="logo">
                        </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="mm-active">
                    <a href="{{route('home')}}" class="active">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Khách hàng</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-chat-bubble-user"></i>
                        <span>Quản lý tài khoản</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('member')}}">Danh sách tài khoản</a></li>
                        <li><a href="{{route('member', ['cmd' => 'input'])}}">Thêm mới tài khoản</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-square"></i>
                        <span>Quản lý khách hàng</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('customer')}}">Danh sách khách hàng</a></li>
                        <li><a href="{{route('customer', ['cmd' => 'input'])}}">Thêm mới khách hàng</a></li>
                    </ul>
                </li>


                <li class="menu-title">Danh mục</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-alarm-panel-outline"></i>
                        <span>Quản danh mục</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('categories')}}">Danh mục</a></li>
                        <li><a href="{{route('categories', ['cmd' => 'input'])}}">Thêm mới danh mục</a></li>
                    </ul>
                </li>

                <li class="menu-title">Sản phẩm </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('products', ['type' => 1])}}">Quản lý sản phẩm</a></li>
                        <li><a href="{{route('products', ['type' => 0])}}">Xem bản nháp</a></li>
                        <li><a href="{{route('products', ['cmd' => 'input'])}}">Thêm mới sản phẩm</a></li>
                    </ul>
                </li>
                <li class="menu-title">Đơn hàng </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('products', ['type' => 1])}}">Danh sách đơn hàng</a></li>--}}
{{--                    </ul>--}}
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
