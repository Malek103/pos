<?php

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\bills\SaleController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\bills\BuyingController;
use App\Http\Controllers\debentures\catchController;
use App\Http\Controllers\reports\CustomerController;
use App\Http\Controllers\reports\ProductsController;
use App\Http\Controllers\reports\SupplierController;
use App\Http\Controllers\definition\ClientController;
use App\Http\Controllers\definition\ProductController;
use App\Http\Controllers\reports\ReportSaleController;
use App\Http\Controllers\debentures\ReceipthController;

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

Route::get('/', function () {
    return view('welcome');
});



// definition
// 1- client
Route::resource('/definition', ClientController::class)->middleware('auth');
// 2-product
Route::resource('/products', ProductController::class)->middleware('auth');
Route::get('/product-search', [ProductController::class, 'search'])->name('product.search')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/client-search', [ClientController::class, 'search'])->name('client.search')->middleware('auth');
Route::resource('/buying', BuyingController::class)->middleware('auth');
Route::get('/invoice-search', [BuyingController::class, 'search'])->name('invoice.search')->middleware('auth');
Route::get('/show-delete', [BuyingController::class, 'showDelete'])->name('delete.show')->middleware('auth');
Route::get('/receipt-delete', [ReceipthController::class, 'showDelete'])->name('delete.receipt')->middleware('auth');

Route::resource('/sales', SaleController::class)->middleware('auth');
Route::resource('/catching', catchController::class)->middleware('auth');
Route::resource('/receipt', ReceipthController::class)->middleware('auth');
Route::get('/receipt-search', [ReceipthController::class, 'search'])->middleware('auth')->name('receipt.search');
Route::get('barcode/{barcode}', [ProductController::class, 'barcode'])->middleware('auth');
Route::resource('/reports-sale', ReportSaleController::class)->middleware('auth');
Route::resource('/reports-supplier', SupplierController::class)->middleware('auth');
Route::resource('/reports-customer', CustomerController::class)->middleware('auth');
Route::get('/supplier-search', [SupplierController::class, 'search'])->middleware('auth')->name('supplier.search');
Route::get('/customer-search', [CustomerController::class, 'search'])->middleware('auth')->name('customer.search');
Route::get('/sale-search', [ReportSaleController::class, 'search'])->middleware('auth')->name('sale.search');
Route::resource('/reports-products', ProductsController::class)->middleware('auth');
Route::get('/reports-product-search', [ProductsController::class, 'search'])->middleware('auth')->name('reports.product.search');
Route::get('/receipts/chart', [SaleController::class, 'chart'])->name('chart');

Route::get('/profile', [UserProfileController::class, 'index'])->name('profile')->middleware(['auth', 'password.confirm']);
Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
Auth::routes();
Route::get('/secret', function () {

    return 'malek';
})->middleware('password.confirm');
