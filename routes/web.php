<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\WorkshopPlaceController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RequestContext;

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
    return view('auth.login');
});
Auth::routes();
Route::middleware(['auth'])->group(
    function () {
        Route::get('/', [HomeController::class, 'index']);


        Route::get('/change_locale/{locale}', function ($locale) {
            App::setLocale($locale);
            session()->put('locale', $locale);
            return redirect()->back();
        })->name('change_locale');


        Route::get('/entryorexit', [WorkshopController::class, 'entryorexit']);
        Route::post('/add-new-workshop', [WorkshopController::class, 'store'])->name('whorkshops_store');
        Route::get('/get-maintenance-order-code', [WorkshopController::class, 'getMaintenanceOrderCode']);
        Route::get('/fetch-data', [WorkshopController::class, 'fetch_data']);
        Route::get('/fetch-photo', [WorkshopController::class, 'fetch_photo']);

        Route::get('/printIT/{id}', [WorkshopController::class, 'printing']);

        Route::post('/update_maintenance', [WorkshopController::class, 'update_maintenance'])->name('update_maintenance');
        Route::post('/savejob', [WorkshopController::class, 'savejob'])->name('savejob');
        Route::get('/get_worker/{id}', [WorkshopController::class, 'get_worker']);
        Route::get('/edit-service-task/{id}', [WorkshopController::class, 'editservicetask']);
        Route::post('/updatetaskk/{id}', [WorkshopController::class, 'updatetask'])->name('updatetask');
        Route::post('/save_changed_items', [WorkshopController::class, 'save_changed_items'])->name('save_changed_items');

        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/add-product', [ProductController::class, 'add_product']);
        Route::get('/edit-product/{id}', [ProductController::class, 'edit_prod'])->name('edit_prod');
        Route::put('/updateproduct/{id}', [ProductController::class, 'updateprod'])->name('updateproduct');

        Route::post('/productStore', [ProductController::class, 'productStore'])->name('productStore');
        Route::get('/all-stock', [StockController::class, 'index'])->name('allstock');
        Route::get('/all-item', [StockController::class, 'show'])->name('allitem');
        Route::get('/add-stock/{id}', [StockController::class, 'create'])->name('create_stock');
        Route::get('/edit-stock/{id}', [StockController::class, 'edit'])->name('edit_stock');
        Route::PUT('/update-stock/{id}', [StockController::class, 'update'])->name('update_stock');
        Route::post('/addstock/{id}', [StockController::class, 'savestock'])->name('addstock');
        Route::get('/stock/qrcode/{id}', [StockController::class, 'generateQRCode']);

        Route::get('/allrequests', [RequestController::class, 'index']);
        Route::post('/addrequest', [RequestController::class, 'saverequest'])->name('addrequest');
        Route::PUT('/update_reques/{id}', [RequestController::class, 'update_reques'])->name('updaterequestitem');
        Route::PUT('/update_request/{id}', [RequestController::class, 'update_request'])->name('update_request');
        Route::post('/add_req_item', [RequestController::class, 'add_req_item'])->name('add_req_item');
        Route::post('/add_stock_item', [RequestController::class, 'add_stock_item'])->name('add_stock_item');
        Route::get('/add-request', [RequestController::class, 'create']);
        Route::get('/get-product_history/{id}', [RequestController::class, 'getprodhistory']);
        Route::get('/get-request_list/{id}', [RequestController::class, 'getrequestlist']);
        Route::post('/confirmrequest/{id}', [RequestController::class, 'confirmrequest']);
        Route::get('/suggestedprice/{id}/{prod}', [RequestController::class, 'suggestedprice']);
        Route::get('/edit-request/{id}', [RequestController::class, 'edit_request'])->name('edit_request');
        Route::get('/restriction/{id}', [RequestController::class, 'restriction'])->name('restriction');
        Route::get('/editrequestitem/{id}', [RequestController::class, 'editrequestitem']);
        Route::get('/printrequest/{id}', [RequestController::class, 'printrequest'])->name('printrequest');
        Route::get('/transaction', [RequestController::class, 'transaction']);
        Route::get('/alltransaction', [RequestController::class, 'alltransaction']);
        Route::delete('/deletetransaction/{id}', [RequestController::class, 'deletetransaction'])->name('deletetransaction');


        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/dashboards', [AdminController::class, 'indexwith_time']);
        Route::get('/print/all_prod', [AdminController::class, 'all_prod']);
        Route::get('/print/all_service', [AdminController::class, 'all_service']);
        Route::get('/print/all_stocked_items', [AdminController::class, 'all_stocked_items']);
        Route::get('/print/all_requests', [AdminController::class, 'all_requests']);
        Route::get('/print/transaction', [AdminController::class, 'transaction']);
        Route::get('/print/bought_items', [AdminController::class, 'bought_items']);
        Route::get('/print/bought_items/garage', [AdminController::class, 'bought_items_garage']);
        Route::get('/print/finished', [AdminController::class, 'maintenance']);

        Route::resource('brand', BrandController::class);
        Route::resource('garage', GarageController::class);
        Route::resource('category', CategoriesController::class);
        Route::resource('supplier', SuppliersController::class);
        Route::resource('vehicle', TruckController::class);
        Route::resource('driver', DriversController::class);
        Route::resource('employee', EmployeesController::class);
        Route::resource('workshop', WorkshopPlaceController::class);
        Route::resource('setting', AllController::class);
    }
);
