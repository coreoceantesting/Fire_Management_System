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
    // return redirect()->route('login');
    return view('welcome');
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
    Route::delete('/firestations/{firestation}/inactive', [App\Http\Controllers\Admin\Masters\FireStationController::class, 'inactive'])->name('firestations.inactive');
    Route::delete('/firestations/{firestation}/active', [App\Http\Controllers\Admin\Masters\FireStationController::class, 'active'])->name('firestations.active');
    Route::resource('vehicle_details', App\Http\Controllers\Admin\Masters\VehicleDetailsController::class );
    Route::resource('designations', App\Http\Controllers\Admin\Masters\DesignationsController::class );
    Route::resource('driver_details', App\Http\Controllers\Admin\Masters\DriversDetailsController::class );
    Route::resource('equipments', App\Http\Controllers\EquipmentsController::class );
    Route::delete('/equipments/{equipment}/inactive', [App\Http\Controllers\EquipmentsController::class, 'inactive'])->name('equipments.inactive');
    Route::delete('/equipments/{equipment}/active', [App\Http\Controllers\EquipmentsController::class, 'active'])->name('equipments.active');



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

    // notification
    Route::get('/notifications/count', [App\Http\Controllers\GenerateSlipsController::class, 'getCount'])->name('getCount');
    Route::get('/notifications', [App\Http\Controllers\GenerateSlipsController::class, 'getNotifications'])->name('getNotifications');

    // new generated slips
    Route::get('new-generated-slips', [App\Http\Controllers\GenerateSlipsController::class, 'new_generated_slip'])->name('new_generated_slip');
    Route::get('/view-slip/{slipId}', [App\Http\Controllers\GenerateSlipsController::class, 'view_generated_slip'])->name('view_generated_slip');
    // Take Action Form
    Route::post('store-slip-action-form', [App\Http\Controllers\GenerateSlipsController::class, 'store_slip_action_form'])->name('store_slip_action_form');

    // occurance book
    Route::get('action-taken-slips-list', [App\Http\Controllers\OccuranceBookController::class, 'action_taken_slips_list'])->name('action_taken_slips_list');
    Route::get('/view-action-taken-slip/{slipId}', [App\Http\Controllers\OccuranceBookController::class, 'view_action_taken_slip'])->name('view_action_taken_slip');
    Route::post('store-additional-help', [App\Http\Controllers\OccuranceBookController::class, 'store_additional'])->name('store_additional');
    Route::post('store-occurance-book', [App\Http\Controllers\OccuranceBookController::class, 'store_occurance_book'])->name('store_occurance_book');

    // list for vardi ahaval
    Route::get('list-for-vardi-ahaval', [App\Http\Controllers\OccuranceBookController::class, 'vardi_ahaval_list'])->name('vardi_ahaval_list'); 
    Route::get('/get-slip-details/{slipId}', [App\Http\Controllers\OccuranceBookController::class, 'slip_details'])->name('slip_details');
    Route::post('/store-vardi-ahval', [App\Http\Controllers\OccuranceBookController::class, 'store_vardi_ahaval'])->name('store_vardi_ahaval');
    Route::get('/generate-vardi-ahaval-pdf/{slipId}', [App\Http\Controllers\OccuranceBookController::class, 'vardi_ahaval_pdf'])->name('generate.vardi.ahaval.pdf');

    // All Listing Count
    Route::get('todays-slips', [App\Http\Controllers\ReportController::class, 'todays_list'])->name('todays_list');
    Route::get('monthly-slips', [App\Http\Controllers\ReportController::class, 'monthly_list'])->name('monthly_list');
    Route::get('yearly-slips', [App\Http\Controllers\ReportController::class, 'yearly_list'])->name('yearly_list');
    Route::get('action-taken-slips', [App\Http\Controllers\ReportController::class, 'action_taken_list'])->name('action_taken_list');

    // filters 
    Route::get('/filter', [App\Http\Controllers\FiltersController::class, 'filter'])->name('filter');
    Route::get('/new-generated-slips-filter', [App\Http\Controllers\FiltersController::class, 'new_generated_filter'])->name('new_generated_filter');
    Route::get('/action-taken-slips-filter', [App\Http\Controllers\FiltersController::class, 'action_taken_slips_filter'])->name('action_taken_slips_filter');
    Route::get('/vardi-ahaval-filter', [App\Http\Controllers\FiltersController::class, 'vardi_ahaval_filter'])->name('vardi_ahaval_filter');
    Route::get('/yearly-slips-filter', [App\Http\Controllers\FiltersController::class, 'yearly_slips_filter'])->name('yearly_slips_filter');
    Route::get('/action-taken-report-filter', [App\Http\Controllers\FiltersController::class, 'action_taken_report_filter'])->name('action_taken_report_filter');

    // Equipment Management
    Route::get('add-in-stock', [App\Http\Controllers\EquipmentsController::class, 'add_stock'])->name('add_stock');
    Route::post('store-stock', [App\Http\Controllers\EquipmentsController::class, 'store_stock'])->name('store_stock');
    Route::get('/view-stock-list/{equipmentId}', [App\Http\Controllers\EquipmentsController::class, 'view_stock_list'])->name('view_stock_list');

    // vehicle history 
    Route::get('add-vehicle-history-details', [App\Http\Controllers\VehicleHistoryController::class, 'add_vechicle_details'])->name('add_vechicle_details');
    Route::post('store-vehicle-history-details', [App\Http\Controllers\VehicleHistoryController::class, 'store_vechicle_details'])->name('store_vechicle_details');
    Route::get('/view-vehicle-detail/{vehicleId}', [App\Http\Controllers\VehicleHistoryController::class, 'view_vehicle_detail'])->name('view_vehicle_detail');
    Route::post('update-vehicle-history-details', [App\Http\Controllers\VehicleHistoryController::class, 'update_vehicle_details'])->name('update_vehicle_details');
    Route::delete('/retire-vehicle/{id}', [App\Http\Controllers\VehicleHistoryController::class, 'destroy'])->name('vehicle.destroy');
    Route::get('retired-vehicle-history-list', [App\Http\Controllers\VehicleHistoryController::class, 'expire_vechicle_list'])->name('expire_vechicle_list');
    Route::post('store-vehicle-action-history-details', [App\Http\Controllers\VehicleHistoryController::class, 'store_vechicle_action_details'])->name('store_vechicle_action_details');
    Route::get('/view-action-list/{vehicleId}', [App\Http\Controllers\VehicleHistoryController::class, 'view_action_list'])->name('view_action_list');
    Route::get('/old-document-list/{vehicleId}', [App\Http\Controllers\VehicleHistoryController::class, 'old_doument_list'])->name('old_doument_list');


    Route::get('supply-stock', [App\Http\Controllers\EquipmentsController::class, 'supply_stock'])->name('supply_stock');
    Route::post('store-supply-stock', [App\Http\Controllers\EquipmentsController::class, 'store_supply_stock'])->name('store_supply_stock');
    Route::get('/view-supply-stock-list/{equipmentId}', [App\Http\Controllers\EquipmentsController::class, 'view_supply_stock_list'])->name('view_supply_stock_list');

    Route::get('expire-stock', [App\Http\Controllers\EquipmentsController::class, 'expire_stock'])->name('expire_stock');
    Route::post('store-expire-stock', [App\Http\Controllers\EquipmentsController::class, 'store_expire_stock'])->name('store_expire_stock');
    Route::get('/view-expire-stock-list/{equipmentId}', [App\Http\Controllers\EquipmentsController::class, 'view_expire_stock_list'])->name('view_expire_stock_list');

    Route::get('/get-available-quantity/{equipmentId}', [App\Http\Controllers\EquipmentsController::class, 'get_available_quantity'])->name('get_available_quantity');
    Route::get('/get-supplied-quantity/{equipmentId}', [App\Http\Controllers\EquipmentsController::class, 'get_supplied_quantity'])->name('get_supplied_quantity');
    Route::get('/get-supplied-quantity-new', [App\Http\Controllers\EquipmentsController::class, 'get_supplied_quantity_new'])->name('get_supplied_quantity_new');

    Route::get('/overall-stock-detail', [App\Http\Controllers\EquipmentsController::class, 'overall_stock_detail'])->name('overall_stock_detail');
    
});




Route::get('/php', function(Request $request){
    if( !auth()->check() )
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
