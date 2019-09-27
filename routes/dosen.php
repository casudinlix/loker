<?php

Route::group(['namespace' => 'Dosen'], function() {

    Route::get('/', 'HomeController@index')->name('dosen.home');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('dosen.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('dosen.logout');

    // Register
    //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('dosen.register');
    //Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('dosen.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('dosen.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('dosen.password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('dosen.verification.resend');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('dosen.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('dosen.verification.verify');

});
