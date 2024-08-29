<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\Front\Home::class)->name('front.home');

Route::group([
    'prefix' => 'auth'
], function () {

    Route::get('/login', function (\Illuminate\Http\Request $request) {
        $as = $request->get('as');
        $user = $as == 'admin' ? \App\Models\User::where('id', 2)->firstOrFail() : \App\Models\User::where('id', 1)->firstOrFail();

        // fake login
        \Auth::login($user);
        return redirect(route('admin.overview'));
    })->name('auth.login');

    Route::get('/logout', function () {
        \Auth::logout();
        return redirect(route('front.home'));
    })->name('auth.logout');

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

});
