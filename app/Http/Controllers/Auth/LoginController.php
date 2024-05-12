<?php

namespace App\Http\Controllers\Auth;

use App\Hps\eJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Home\HomeController;
use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Facades\SEOMeta;
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
        $this->response = app(eJson::class);
        app(HomeController::class)->setNameBreadcrumb('Login');
    }

    protected function sendFailedLoginResponse(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tài khoản hoặc mật khẩu đăng nhập không chính xác.'],
        ]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $tpl = [];
        $this->seo()->setTitle('Đăng nhập');
        SEOMeta::setKeywords('login');
        $description = 'Đăng nhập là quá trình xác thực tài khoản người dùng trên hệ thống của một trang web hay ứng dụng. Việc đăng nhập giúp người dùng truy cập vào các chức năng, dịch vụ hoặc nội dung chỉ dành cho thành viên. Để đăng nhập, người dùng cần cung cấp thông tin đăng nhập như tên đăng nhập hoặc địa chỉ email cùng với mật khẩu đã đăng ký trước đó. Đăng nhập giúp tăng tính bảo mật của tài khoản cá nhân và giúp người dùng tiếp cận với nhiều chức năng hơn trên trang web hay ứng dụng một cách dễ dàng.';
        $this->seo()->setDescription($description);
        $schema =[
            'type' => 'login',
            'name' => 'Đăng nhập',
            'description' => $description,
            'url' => route('login'),
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        return view('auth.login', $tpl);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        $redirect = [
            'redirect' => route('fe.home')
        ];

        $success  = [
            'msg' => 'Đăng nhập thành công',
            'status' => 200,
            'result' => $redirect
        ];
        return $request->wantsJson()
            ? new JsonResponse($success, 200)
            : redirect(route('fe.home'));
    }



    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function validateLogin(Request $request): array
    {
        set_request();
        $rules = [
            'email' => 'required|email|min:3|max:64|exists:customer,email',
            'password' => 'required|min:3',
        ];
        return $this->validate($request,$rules,[
            'required' => ':attribute không được để trống',
            'email' => ':attribute hợp lệ',
            'exists' => ':attribute không tồn tại',
            'min' => ':attribute tối thiểu 3 kí tự',
            'max' => ':attribute tối đa 3 kí tự',
        ], [
            'email' => 'Tài khoản khách hàng',
            'password' => 'Mật Khẩu'
        ]);
    }
}
