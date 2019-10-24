<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use App\Notifications\UserWelcome;

Route::get('/', function () {
    return redirect('login');
});

Route::get('tesemail', function() {
  $user=User::find(4);

  $data=[
    'name'=>'TES',
    'email'=>$user->email,
    'old_password'=>123,
    'password'=>$user->old_password
  ];
   $kirim=$user->notify(new UserWelcome($data));
   if ($kirim) {
     return 'OK';
   }

});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/xx', 'HomeController@home')->name('home.tex');
// Route::get('admin-login','Auth\AdminLoginController@showLoginForm');
// Route::post('admin-login', ['as' => 'admin-login', 'uses' => 'Auth\AdminLoginController@login']);
// Route::get('admin-register','Auth\AdminLoginController@showRegisterPage');
// Route::post('admin-register', 'Auth\AdminLoginController@register')->name('admin.register');
//Route::get('logout-klien','Auth\KlienLoginController@logout')->name('logout.klien');
Route::get('admin-login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Auth\AdminLoginController@login']);
Route::get('admin-logout','Auth\AdminLoginController@logout')->name('admin.logout');
//dosens
Route::get('dosen-login', 'Auth\DosenLoginController@showLoginForm');
Route::post('dosen-login', ['as'=>'dosen-login','uses'=>'Auth\DosenLoginController@login']);
Route::get('dosen-logout','Auth\DosenLoginController@logout')->name('dosen.logout');
