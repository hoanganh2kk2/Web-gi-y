@extends('layouts.feauth')

@section('content')
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Đăng nhập</h2>
                        <h2 class="ec-title">Đăng nhập</h2>
                        <p class="sub-title mb-3">Cảm ơn bạn đã tin tưởng chúng tôi.</p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form id="form_login" method="post">
                                <span class="ec-login-wrap">
                                    <label class="f-serif">Nhập email*</label>
                                    <input type="text" name="email" placeholder="Nhập tài khoản hoặc email của bạn..." required />
                                </span>
                                <span class="ec-login-wrap">
                                    <label class="f-serif">Nhập mật khẩu*</label>
                                    <input type="password" name="password" placeholder="Nhập mật khẩu" required />
                                </span>
                                <span class="ec-login-wrap ec-login-fp">
                                    <label><a href="#">Quên mật khẩu?</a></label>
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary" type="button" id="send_form_login">Đăng nhập</button>
                                    <a href="{{route('register')}}" class="btn btn-secondary">Đăng ký</a>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('JS')
    <script>
        $('#send_form_login').click(function (){
            return _POST_FORM('#form_login', '{{route('login')}}')
        })
    </script>
@endsection


