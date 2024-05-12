@extends('layouts.auth')

@section('content')
    <form id="send_form">

        <div class="mb-3">
            <label class="form-label" for="useremail">Email</label>
            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username">
        </div>

        <div class="mb-3">
            <label class="form-label" for="userpassword">Password</label>
            <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="auth-terms-condition-check">
            <label class="form-check-label" for="auth-terms-condition-check">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
        </div>



        <div class="mt-3 text-end">
            <button class="btn btn-primary w-sm waves-effect waves-light" type="button" onclick="show_alert_warn('Chúng tôi hiện chưa cung cấp dịch vụ này.')">Register</button>
        </div>

        <div class="mt-4 text-center">
            <div class="signin-other-title">
                <h5 class="font-size-14 mb-3 title">Sign up using</h5>
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
            <p class="text-muted mb-0">Already have an account ? <a href="{{route('admin.login')}}" class="fw-medium text-primary"> Login</a></p>
        </div>
    </form>
@endsection
