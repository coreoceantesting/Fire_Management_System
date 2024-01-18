<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');




// Guest Users
Route::middleware(['guest','PreventBackHistory'])->group(function()
{
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'] )->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'] )->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');

});




// Authenticated users
Route::middleware(['auth','PreventBackHistory'])->group(function()
{

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'] )->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'] )->name('change-password');



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class );
    Route::resource('firestations', App\Http\Controllers\Admin\Masters\FireStationController::class );
    Route::resource('vehicle_details', App\Http\Controllers\Admin\Masters\VehicleDetailsController::class );
    Route::resource('designations', App\Http\Controllers\Admin\Masters\DesignationsController::class );
    Route::resource('driver_details', App\Http\Controllers\Admin\Masters\DriversDetailsController::class );



    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class );
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle' ])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire' ])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword' ])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole' ])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole' ])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class );

    // Generate Slips 
    Route::get('slips-list', [App\Http\Controllers\GenerateSlipsController::class, 'index'])->name('slips_list');
    Route::post('store-slip', [App\Http\Controllers\GenerateSlipsController::class, 'store_slip'])->name('store_slip');
    Route::get('/download-slip-pdf/{slip_id}', [App\Http\Controllers\GenerateSlipsController::class, 'downloadSlipPdf'])->name('download-slip-pdf');
    Route::get('/filter', [App\Http\Controllers\GenerateSlipsController::class, 'filter'])->name('filter');

    // new generated slips
    Route::get('new-generated-slips', [App\Http\Controllers\GenerateSlipsController::class, 'new_generated_slip'])->name('new_generated_slip');
    Route::get('/view-slip/{slipId}', [App\Http\Controllers\GenerateSlipsController::class, 'view_generated_slip'])->name('view_generated_slip');
    // Take Action Form
    Route::post('store-slip-action-form', [App\Http\Controllers\GenerateSlipsController::class, 'store_slip_action_form'])->name('store_slip_action_form');

});




Route::get('/php', function(Request $request){
    if( !auth()->check() )
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
