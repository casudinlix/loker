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
class DosenLoginController extends Controller
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
    protected $guard = 'dosen';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dosen/home';

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
        return view('auth.dosenlogin');

    }



    public function login(Request $request)

    {

        if (auth()->guard('dosen')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>true])) {

           return redirect()->route('dosen.home');

        }



        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }
    public function logout()
    {
        \Auth::guard('dosen')->logout();
        return redirect()->route('dosen-login');
    }
}
