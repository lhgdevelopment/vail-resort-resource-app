<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LtoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SMTPSettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('frontend.welcome');
// });

//Frontend Routes.....................................
Route::get('/', [FrontendController::class, 'index']);
Route::get('category/{id}', [FrontendController::class, 'categoryDetails'])->name('category.details');
// Route::get('category-list', [FrontendController::class, 'categoryList'])->name('category.index');
Route::get('lto-list', [FrontendController::class, 'ltoList'])->name('lto.index');
Route::get('resource/{id}', [FrontendController::class, 'resourceDetails'])->name('resource.details');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('admin/profile', [UserController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('admin/profile', [UserController::class, 'updateProfile'])->name('admin.profile.update');


    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update/{id}', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/smtp', [SMTPSettingController::class, 'index'])->name('smtp.index');
    Route::put('settings/smtp', [SMTPSettingController::class, 'update'])->name('smtp.update');
    Route::get('/verify/{token}', [RegisteredUserController::class, 'verifyEmail'])->name('verify.email');



    // Route to view all sliders (index)
    Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index')->middleware('can:view-sliders');
    Route::get('sliders/create', [SliderController::class, 'create'])->name('sliders.create')->middleware('can:create-sliders');
    Route::post('sliders', [SliderController::class, 'store'])->name('sliders.store')->middleware('can:create-sliders');
    Route::get('sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit')->middleware('can:edit-sliders');
    Route::put('sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update')->middleware('can:edit-sliders');
    Route::get('sliders/{slider}/show', [SliderController::class, 'show'])->name('sliders.show')->middleware('permission:view-sliders');
    Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy')->middleware('can:delete-sliders');


    // Role Management Routes
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view-roles');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create-roles');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create-roles');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit-roles');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit-roles');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete-roles');

    // User Management Routes 
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('permission:view-users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-users');
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit-users');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit-users');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete-users');

    // Category Management Routes
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('permission:view-categories');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('permission:create-categories');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('permission:create-categories');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('permission:edit-categories');
    Route::get('categories/{category}/show', [CategoryController::class, 'show'])->name('categories.show')->middleware('permission:view-categories');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('permission:edit-categories');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('permission:delete-categories');

    // Resource Management Routes with Permission Checks
    Route::get('resources', [ResourceController::class, 'index'])->name('resources.index')->middleware('permission:view-resources');
    Route::get('resources/create', [ResourceController::class, 'create'])->name('resources.create')->middleware('permission:create-resources');
    Route::post('resources', [ResourceController::class, 'store'])->name('resources.store')->middleware('permission:create-resources');
    Route::get('resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit')->middleware('permission:edit-resources');
    Route::get('resources/{resource}/show', [ResourceController::class, 'show'])->name('resources.show')->middleware('permission:view-resources');
    Route::put('resources/{resource}', [ResourceController::class, 'update'])->name('resources.update')->middleware('permission:edit-resources');
    Route::delete('resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy')->middleware('permission:delete-resources');

    Route::middleware(['auth'])->group(function () {
        Route::resource('ltos', LtoController::class);
    });
});

require __DIR__.'/auth.php';
