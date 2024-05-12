<?php

namespace App\Http\Controllers\BackEnd\Auth;

use App\Hps\eJson;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, SEOTools;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $response;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->seo()->setTitle('Đăng nhập');
        $this->response = app(eJson::class);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    protected function sendFailedLoginResponse(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tài khoản hoặc mật khẩu đăng nhập không chính xác.'],
        ]);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        $redirect = [
            'redirect' => route('home')
        ];

        $success  = [
            'msg' => 'Đăng nhập thành công',
            'status' => 200,
            'result' => $redirect
        ];
        return $request->wantsJson()
            ? new JsonResponse($success, 200)
            : redirect(route('/'));
    }



    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login'));
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function validateLogin(Request $request): array
    {
        set_request();
        $rules = [
            'email' => 'required|email|min:3|max:64|exists:users,email',
            'password' => 'required|min:3',
        ];
        return $this->validate($request,$rules,[
            'required' => ':attribute không được để trống',
            'email' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 3 kí tự',
        ], [
            'account' => 'Tài khoản khách hàng',
            'password' => 'Mật Khẩu'
        ]);
    }
}
