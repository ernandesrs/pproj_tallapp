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
    'prefix' => 'admin'
], function () {

    Route::get('/', \App\Livewire\Admin\Overview::class)->name('admin.overview');

});
