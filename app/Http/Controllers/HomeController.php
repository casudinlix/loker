<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Gate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = 'home';

    public function __construct()
    {
      // $this->middleware('auth');
       $this->middleware('auth:web');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('mahasiswa.home');
    }
    function home()
    {
      $this->authorize('xx');
      return redirect()->route('mahasiswa.home');

    }
    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('mahasiswa.home');
    }
}
