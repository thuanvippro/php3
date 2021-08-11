<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;


Route::prefix('quan-tri')->group( function(){

    Route::get('/list-user', [UserController::class, 'index'])->middleware('permission:cap quyen user')->name('listUser');
    Route::get('/add-user', [UserController::class, 'addFormUser'])->middleware('permission:cap quyen user')->name('addUser');
    Route::post('/add-user', [UserController::class, 'saveUser']);
    Route::get('/edit-user/{id}', [UserController::class, 'editFormUser'])->middleware('permission:cap quyen user')->name('editUser');
    Route::post('/edit-user/{id}', [UserController::class, 'saveEditUser']);
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->middleware('permission:cap quyen user')->name('delete.user');

    Route::get('/list-category', [CategoryController::class, 'index'])->middleware('permission:show admin')->name('listCategory');
    Route::get('/add-category', [CategoryController::class, 'addFormCategory'])->middleware('permission:add category')->name('addCategory');
    Route::post('/add-category', [CategoryController::class, 'saveAddCategory']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'editFormCategory'])->middleware('permission:edit category')->name('editCategory');
    Route::post('/edit-category/{id}', [CategoryController::class, 'saveEditCategory']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->middleware('permission:delete category')->name('delete.category');

    Route::get('/list-product', [ProductController::class, 'index'])->middleware('permission:show admin')->name('listProduct');
    Route::get('/add-product', [ProductController::class, 'addFormProduct'])->middleware('permission:add product')->name('addProduct');
    Route::post('/add-product', [ProductController::class, 'saveAddProduct']);
    Route::get('/edit-product/{id}', [ProductController::class, 'editFormProduct'])->middleware('permission:edit product')->name('edit.product');
    Route::post('/edit-product/{id}', [ProductController::class, 'saveEditProduct']);
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->middleware('permission:delete product')->name('delete.product');

    // Route::group(['middleware' => ['role:admin']], function () {
    //     Route::get('/list-user', [UserController::class, 'index'])->name('listUser');
    //     Route::get('/add-user', [UserController::class, 'addFormUser'])->name('addUser');
    //     Route::post('/add-user', [UserController::class, 'saveUser']);

    //     Route::get('/list-category', [CategoryController::class, 'index'])->name('listCategory');
    //     Route::get('/list-product', [ProductController::class, 'index'])->name('listProduct');
    // });
    //     Route::get('/list-category', [CategoryController::class, 'index'])->name('listCategory');
    //     Route::get('/add-category', [CategoryController::class, 'addFormCategory'])->name('addCategory');
    //     Route::post('/add-category', [CategoryController::class, 'saveAddCategory']);
    //     Route::get('/edit-category/{id}', [CategoryController::class, 'editFormCategory'])->name('editCategory');
    //     Route::post('/edit-category/{id}', [CategoryController::class, 'saveEditCategory']);
    //     Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');

    //     Route::get('/list-product', [ProductController::class, 'index'])->name('listProduct');
    //     Route::get('/add-product', [ProductController::class, 'addFormProduct'])->name('addProduct');
    //     Route::post('/add-product', [ProductController::class, 'saveAddProduct']);
    //     Route::get('/edit-product/{id}', [ProductController::class, 'editFormProduct'])->name('edit.product');
    //     Route::post('/edit-product/{id}', [ProductController::class, 'saveEditProduct']);
    //     Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
})
?>