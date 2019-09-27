<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
class AdminLoginController extends Controller
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

    use AuthenticatesUsers;
    protected $guard = 'admin';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       // $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()

    {
        // if(empty (\Auth::guard('klien')))
        // {
        //    return redirect('klien/home');
        // }
        return view('auth.adminlogin');

    }



    public function login(Request $request)

    {

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>true])) {

           return redirect()->route('admin.home');

        }



        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }
}
