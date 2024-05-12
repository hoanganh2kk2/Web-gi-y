<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\Home\HomeController;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, SEOTools;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        app(HomeController::class)->setNameBreadcrumb('Đăng ký');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $this->seo()->setTitle('Đăng ký');
        SEOMeta::setKeywords('register');
        $description = 'Đăng ký là quá trình tạo tài khoản cá nhân trên trang web. Việc đăng ký cho phép người dùng truy cập và sử dụng các tính năng của trang web một cách đầy đủ, bao gồm mua hàng, đăng bài đăng tin, tham gia diễn đàn và nhiều hoạt động khác. Để đăng ký, người dùng cần cung cấp các thông tin cá nhân như tên, địa chỉ email, mật khẩu, số điện thoại và địa chỉ liên lạc. Trang web thường sử dụng các biện pháp bảo mật để đảm bảo rằng thông tin của người dùng được bảo vệ và tránh bị lộ ra ngoài. Sau khi đăng ký thành công, người dùng sẽ nhận được một tài khoản trên trang web và có thể đăng nhập vào bất cứ lúc nào.';
        $this->seo()->setDescription($description);

        $schema =[
            'type' => 'register',
            'name' => 'Đăng ký',
            'description' => $description,
            'url' => route('register'),
        ];
        $schema = setSchema($schema);
        $tpl['schema'] = $schema;
        return view('auth.register', $tpl);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        set_request();
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customer'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
            'email' => ':attribute hợp lệ',
            'string' => ':attribute hợp lệ',
            'min' => ':attribute tối thiểu 8 kí tự',
            'max' => ':attribute tối đa 255 kí tự',
        ], [
           'name' => 'Tên khách hàng',
           'email' => 'Email',
           'password' => 'Mật khẩu',
        ]);
    }

    public function register(Request $request)
    {
        set_request();
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        $redirect = [
            'redirect' => route('fe.home')
        ];

        $success  = [
            'msg' => 'Đăng ký thành công',
            'status' => 200,
            'result' => $redirect
        ];
        return $request->wantsJson()
            ? new JsonResponse($success, 200)
            : redirect(route('fe.home'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);
    }
}
