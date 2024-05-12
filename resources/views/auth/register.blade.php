@extends('layouts.feauth')

@section('content')
    <!-- Start Register -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Đăng ký</h2>
                        <h2 class="ec-title">Đăng ký</h2>
                        <p class="sub-title mb-3">Cảm ơn bạn đã tin tưởng chúng tôi.</p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form id="form_register" method="post">
                                <span class="ec-login-wrap">
                                    <label class="f-serif">Nhập tên*</label>
                                    <input type="text" name="name" placeholder="Nhập họ tên của bạn..." required />
                                </span>
                                <span class="ec-login-wrap">
                                    <label class="f-serif">Nhập email*</label>
                                    <input type="email" name="email" placeholder="Nhập tài khoản hoặc email của bạn..." required />
                                </span>
                                <span class="ec-login-wrap">
                                    <label class="f-serif">Nhập mật khẩu*</label>
                                    <input type="password" name="password" placeholder="Nhập mật khẩu" required />
                                </span>
                                <span class="ec-login-wrap ec-login-fp">
                                    <label><a href="#">Quên mật khẩu?</a></label>
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary" type="button" id="send_form_register">Đăng ký</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register -->
@endsection

@section('JS')
    <script>
        $('#send_form_register').click(function (){
            return _POST_FORM('#form_register', '{{route('register')}}')
        })
    </script>
@endsection


