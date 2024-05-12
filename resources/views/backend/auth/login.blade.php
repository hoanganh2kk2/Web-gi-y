@extends('layouts.auth')

@section('content')
    <form id="send_login">
        <div class="mb-3">
            <label class="form-label" for="username">Email</label>
            <input type="text" class="form-control" name="email" id="username" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <div class="float-end">
                <a href="javascript:void(0)" onclick="show_alert_warn('Chức năng đang bảo trì. Vui lòng quay lại sau.')" class="text-muted">Forgot password?</a>
            </div>
            <label class="form-label" for="userpassword">Password</label>
            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="auth-remember-check">
            <label class="form-check-label" for="auth-remember-check">Remember me</label>
        </div>

        <div class="mt-3 text-end">
            <button class="btn btn-primary w-sm waves-effect waves-light" type="button" id="send_data">Log In</button>
        </div>



        <div class="mt-4 text-center">
            <div class="signin-other-title">
                <h5 class="font-size-14 mb-3 title">Sign in with</h5>
            </div>


            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="javascript:void(0)" class="social-list-item bg-primary text-white border-primary">
                        <i class="mdi mdi-facebook"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="javascript:void(0)" class="social-list-item bg-danger text-white border-danger">
                        <i class="mdi mdi-google"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="mt-4 text-center">
            <p class="mb-0">Don't have an account ? <a href="{{route('admin.register')}}" class="fw-medium text-primary"> Signup now </a> </p>
        </div>
    </form>
@endsection

@push('JS')
    <script>
        $('#send_data').click(function (){
            return _POST_FORM('#send_login', '{{route('save_login')}}')
        })
    </script>
@endpush


