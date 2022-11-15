<?php

// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\OrderController;
// use App\Product;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/',[DashboardController::class,'index'])->name('dashboard');


    Route::resource('customers', 'CustomerController');
    Route::get('customers/{customer}/delete', 'CustomerController@delete')->name('customers.delete');
    Route::get('customer/order/view/{id}', 'CustomerController@customerOrders')->name('customers.orders');

    Route::resource('products', 'ProductController');
    Route::get('products/{product}/delete', 'ProductController@delete')->name('products.delete');
    Route::get('stock/product','ProductController@stock')->name('stock.product');

    Route::resource('bundles', 'BundleController');
    Route::get('bundles/{bundle}/delete', 'BundleController@delete')->name('bundles.delete');

    Route::get('stocks/{product}/add', 'StockController@create')->name('stocks.add');

    // Route::get('stock/{product}/add',[StockController::class,'create'])->name('stocks.add');
    // Route::post('stocks/{product}/add',[StockController::class,'store'])->name('stocks.store');
    Route::post('stocks/{product}/add', 'StockController@store')->name('stocks.store');

    Route::resource('pos', 'PosController');

    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices/{orderId}/print', 'InvoiceController@printInvoice')->name('invoice.print');

    Route::get('receipts/create/{orderId}', 'ReceiptController@create')->name('receiptCreate');
    Route::resource('receipts', 'ReceiptController');
    Route::get('receipts/{orderId}/print', 'ReceiptController@printReceipt')->name('receipt.print');
    // Route::get('receipts/{orderId}/print', 'ReceiptController@printReceipt')->name('receipt.print');

    Route::resource('orders', 'OrderController');
    Route::get('paid/orders','OrderController@paidOrders')->name('orders.paid_orders');
    Route::get('due/orders','OrderController@unpaidOrders')->name('orders.due_orders');
    Route::get('all/cancel/orders','OrderController@allCancelOrders')->name('orders.all_cancel_orders');

    Route::get('orders/{order}/delete', 'OrderController@delete')->name('orders.delete');
    Route::get('orders/{order}/return', 'OrderController@return')->name('orders.return');
    Route::post('due/orders/pay/{id}','OrderController@dueOrderPay')->name('due.paid');
    // Order return route


    Route::resource('accounts', 'AccountController');
    Route::post('accounts', 'AccountController@filter')->name("account.filter");

    //stock
    //pos
    //receipt
    Route::get('settings', 'SettingController@edit')->name('settings.edit');
    Route::post('settings', 'SettingController@update')->name('settings.update');
    Route::get('settings/tos', 'SettingController@tos')->name('settings.tos'); // Order return route

    // Manage User Routes Go Here

    Route::get('manage/user', 'SettingController@manageUser')->name('settings.user');
    Route::get('manage/all/user', 'SettingController@manageAllUser')->name('manage.alluser');
    Route::post('user/store', 'SettingController@storeUser')->name('user.store');
    Route::get('delete/user/{id}', 'SettingController@deleteUser')->name('user.delete');
    Route::get('edit/user/{id}', 'SettingController@editUser')->name('user.edit');
    Route::Post('update/user/{id}', 'SettingController@updateUser')->name('user.update');

    // Category Routes Go here
    Route::get('/create/category', 'ProductController@createCategory')->name('products.category');
    Route::post('create/category', 'ProductController@categoryCreate')->name('category.store');
    Route::post('update/category/{id}', 'ProductController@categoryUpdate')->name('update.category');
    Route::get('/edit/category/{id}', 'ProductController@editCategory')->name('edit.category');
    Route::get('delete/category/{id}', 'ProductController@deleteCategory')->name('delete.category');


    // Suppliers Routes Go here
    Route::resource('suppliers', 'SupplierController');
    Route::get('delete/customer/{id}','SupplierController@delete')->name('suppliers.delete');


});

Auth::routes();
Route::get('/custom-logout', 'MyController@logout')->name('my.logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/shopByCategory/{category}', 'HomeController@shopByCategory')->name('shopByCategory');
Route::get('/bundleShop', 'HomeController@bundleShop')->name('bundleShop');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/product/{product}', 'ProductController@showProduct')->name('product');
Route::get('add/damage/products','ProductController@damageProduct')->name('product.damage');
Route::get('all/damage/products','ProductController@allDamageProduct')->name('all.damage.product');
Route::get('/damage/product/autocomplete', 'ProductController@getAutocompleteData')->name('autocomplete.damage');
Route::post('/damage/product/store', 'ProductController@damageProductStore')->name('damage.products.store');
Route::get('/bundle/{bundle}', 'ProductController@showBundle')->name('bundle');

Route::get('/','CustomerController@login');



Route::get('/test', function (){
    return session()->getId();
});

// require_once 'SimpleXLSX.php';
// Route::get('import', function() {
//     $file_destination = 'file.xlsx';

//     if ( $xlsx = SimpleXLSX::parse($file_destination) ) {
//         $names = array();
//         $writers = array();
//         $categories = array();
//         $publishers = array();
//         $dates = array();
//         $prices = array();

//         // dd($xlsx);

//         $prev_writer = '';
//         $prev_pub = '';
//         $prev_cat = '';
//         $prev_date = '';

//         foreach ( $xlsx->rows() as $r => $row ) {
//             if ($r == 0)
//                 continue;
//             if ($r >= 47)
//                 break;
//             // dd($row);
//             // dd($row[1]);
//             // echo '<br>';
//             $art_no = $row[1];
//             $stock = (integer)$row[2];
//             $title = $row[3];
//             $unit_price = (float)$row[4];

//             $p = new Product();
//             $p->art_no = $art_no;
//             $p->stock = $stock;
//             $p->title = $title;
//             $p->unit_price = $unit_price;
//             $p->image_path = 'public/uploads/default.png';
//             $p->save();
//         }
//     } else {
//         echo SimpleXLSX::parseError();
//     }
// });
