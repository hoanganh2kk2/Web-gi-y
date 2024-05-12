<!-- Footer navigation panel for responsive display -->
<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i class="fi fi-rr-menu-burger"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                @if(auth()->check())
                <a id="check_cart" href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i class="fi-rr-shopping-basket"></i>
                    <span class="ec-cart-noti ec-header-count cart-count-lable">{{check_cart()}}</span></a>
                @else
                    <a id="check_cart" href="javascript:void (0)" onclick="replace('{{route('login')}}')" class="toggle-cart ec-header-btn ec-side-toggle"><i class="fi-rr-shopping-basket"></i></a>
                @endif
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{route('fe.home')}}" class="ec-header-btn"><i class="fi-rr-home"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="javascript:void(0)" class="ec-header-btn"><i class="fi-rr-heart"></i><span class="ec-cart-noti">4</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                @if(auth()->check())
                <a href="{{route('fe.customer')}}" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                @else
                    <a href="{{route('login')}}" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Footer navigation panel for responsive display end -->