<?php

use App\Http\Controllers\ManagementAccess\MenuGroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagementAccess\RouteController;
use App\Http\Controllers\ManagementAccess\PermissionController;
use App\Http\Controllers\ManagementAccess\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    $superAdmin = 'role:super-admin';
    // $user = 'role:user';
    Route::resource('route', RouteController::class)->middleware($superAdmin)->only('index', 'store', 'update', 'destroy');
    Route::resource('permission', PermissionController::class)->middleware($superAdmin)->only('index', 'store', 'update', 'destroy');
    Route::resource('role', RoleController::class)->middleware($superAdmin)->only('index', 'store', 'update', 'destroy');
    Route::resource('menu', MenuGroupController::class)->middleware($superAdmin)->only('index', 'store', 'update', 'destroy');

});

require __DIR__ . '/auth.php';
