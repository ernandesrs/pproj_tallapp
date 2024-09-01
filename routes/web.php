<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Front\Home::class)->name('front.home');

Route::get('/mailable', function () {
    $user = \App\Models\User::first();
    return new \App\Mail\RegisterVerificationMail($user);
});

Route::group([
    'prefix' => 'auth'
], function () {

    Route::get('/login', \App\Livewire\Auth\Login::class)->name('auth.login');

    Route::get('/logout', function () {
        \Auth::logout();
        return redirect(route('front.home'));
    })->name('auth.logout');

    Route::get('/register-verification/{token}', \App\Livewire\Auth\RegisterVerification::class)
        ->name('auth.registerVerification');

});

Route::group([
    'prefix' => 'account',
    'middleware' => ['auth']
], function () {

    Route::get('/', \App\Livewire\Account\Profile::class)->name('account.profile');

});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin_access']
], function () {

    Route::get('/', \App\Livewire\Admin\Overview::class)->name('admin.overview');

    Route::get('/users', \App\Livewire\Admin\Users\Index::class)->name('admin.users.index');
    Route::get('/users/create', \App\Livewire\Admin\Users\Create::class)->name('admin.users.create');
    Route::get('/users/{user}/edit', \App\Livewire\Admin\Users\Edit::class)->name('admin.users.edit');

    Route::get('/roles', \App\Livewire\Admin\Roles\Index::class)->name('admin.roles.index');
    Route::get('/roles/create', \App\Livewire\Admin\Roles\Create::class)->name('admin.roles.create');
    Route::get('/roles/{role}/edit', \App\Livewire\Admin\Roles\Edit::class)->name('admin.roles.edit');

});
