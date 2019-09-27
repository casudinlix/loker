<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/dosen/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('dosen.auth:dosen');
    }

    /**
     * Show the Dosen dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return redirect()->route('dosen.home');
    }

}
