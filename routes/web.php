<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dang-nhap', [HomeController::class, 'formLogin'])->name('login');
Route::post('/dang-nhap', [HomeController::class, 'login']);
Route::any('/dang-xuat', function (){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');
Route::get('/dang-ki', [UserController::class, 'registration'])->name('register');
Route::post('/dang-ki', [UserController::class, 'saveRegistration']);
Route::get('/phan-quyen', function(){
    $admin = User::find(16);
    $thuannh = User::find(2);
    $bdmin = User::find(9);

    // $admin->givePermissionTo('cap quyen user');
    // $admin->givePermissionTo('delete user');

    // $thuannh->givePermissionTo('show admin');
    // $thuannh->givePermissionTo('add product');
    // $thuannh->givePermissionTo('edit product');
    // $thuannh->givePermissionTo('delete product');
    // $thuannh->givePermissionTo('add category');
    // $thuannh->givePermissionTo('edit category');
    // $thuannh->givePermissionTo('delete category');


    // $admin->assignRole('admin');

    $admin->assignRole('nhan vien');

    // $bdmin->assignRole('nguoi dung');

});