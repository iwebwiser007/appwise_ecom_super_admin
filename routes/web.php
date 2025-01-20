<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Front\PayfastController;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

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


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword'); // GET request to view the update password <form>, and a POST request to submit the update password <form>
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
        //packages
        Route::get('packages', 'PackageController@packages');
        Route::match(['get', 'post'], 'add-edit-package/{id?}', 'PackageController@addeditpackage')->name('admin.addeditpackage');
        Route::post('change-package-status', 'PackageController@changePackageStatus')->name('packages.status');
        Route::get('active-packages', 'PackageController@activePackages')->name('packages.active');


        Route::match(['get', 'post'], 'package_buy', 'PackageController@packageBuy');
        Route::get('edit_package_buy/{id}', 'PackageController@editPackageBuy');
        Route::post('change-package_buy-status', 'packagecontroller@changePackageBuyStatus')->name('package_buy.status');

        Route::match(array('get', 'post'), 'delete/{type}/{id}', [AdminController::class, 'delete'])->name('admin.delete');
        Route::get('inquiries', 'InquiryController@index');
        Route::any('inquiry_details/{id}', 'InquiryController@inquirydetails')->name('admin.returnorderdetail');

        Route::get('shop-owners', 'ShopOwnerController@index');
        Route::match(['get', 'post'], 'shop-owners/{id?}', 'ShopOwnerController@createOrEdit');
        Route::post('change-owner-status', 'ShopOwnerController@changeOwnerStatus')->name('owners.status');

        Route::get('shop-owners', 'ShopOwnerController@index')->name('admin.shopOwners');
        Route::match(['get', 'post'], 'add-edit-shop-owner/{id?}', 'ShopOwnerController@addeditshopowner')->name('admin.addEditShopOwner');
        Route::delete('delete-shop-owner/{id}', 'ShopOwnerController@deleteshopowner')->name('admin.deleteShopOwner');

        Route::match(['get', 'post'], 'shop-owners-details/{id}', 'ShopOwnerController@showShopOwner');

        Route::get('sales-reports', 'ShopOwnerController@salesReport');
        Route::match(['get', 'post'], 'shop-sales-report/{id?}', 'ShopOwnerController@shopSaleReports')->name('admin.shopSaleReports');

        // Route::get('admin/sales-report/export', function () {
        //     return Excel::download(new SalesReportExport, 'sales_report.xlsx');
        // })->name('admin.sales.report.export');

        // Route::match(['get', 'post'], 'shop-sales-report', 'ShopOwnerController@shopSaleReports')->name('admin.sales_report');
        Route::post('orders', 'ShopOwnerController@orders')->name('admin.orders');

        Route::match(['get', 'post'], 'admin-details', 'AdminController@adminDetails');
        Route::match(['get', 'post'], 'update-admin-detail', 'AdminController@updateAdminDetails');
        Route::match(['get', 'post'], 'admin-profile', 'AdminController@adminprofile');

        Route::get('pages', 'CmsController@pages');
        Route::get('add-edit-page/{id?}', 'CmsController@addEditPage')->name('admin.addEditPage');
        Route::post('update-page/{id?}', 'CmsController@updatePage')->name('admin.updatePage');
        Route::post('upload-image', 'CmsController@uploadImage');
        Route::post('change-page-status', 'CmsController@changePageStatus')->name('page.status');


        Route::get('/permissions/index', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::any('/permissions/{id}/delete', [PermissionController::class, 'destroy'])->name('permissions.delete');

        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::any('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');

        Route::match(['get', 'post'], 'logo', 'AdminController@updateLogo')->name('logo');

        // Route::get('/shop/upgrade-package', 'PackageController@upgradePackage');
        Route::post('/test-package-upgrade', 'PackageController@upgradePackage')->name('testpackage');

        Route::post('/sales_report/export', 'AdminController@exportSalesReport')->name('admin.sales_report.export');
        Route::match(['get', 'post'], 'transaction', 'transactionController@index');
    });

    // Route::fallback(function () {
    //     return view('admin-error.404');
    // });
});

Route::middleware(['auth'])->group(function () {
    Route::post('/save-token', [NotificationController::class, 'saveToken'])->name('save.token');
});

Route::namespace('App\Http\Controllers\Front')->group(function () {
    // Route::get('/', 'IndexController@index')->name('home');
    Route::get('/home', 'IndexController@index')->name('home');
    Route::any('/package/buy/{id}', 'IndexController@PackageBuy')->name('package.buy');
    Route::any('/save_owner_details/{id}', 'IndexController@saveOwnerDetails')->name('package.saveOwnerDetails');
    Route::get('/package/{id}/{owner_id}', 'IndexController@paymentPage')->name('package.payment');
    Route::post('/package/{id}/process-payment', 'IndexController@processPayment')->name('package.processPayment');


    Route::match(['get', 'post'], 'inquiry-form', 'InquiryController@inquiryForm')->name('inquiry');
    Route::match(['get', 'post'], 'inquiry-submit', 'InquiryController@inquirySubmit');

    Route::get('payfast', [PayfastController::class, 'payFast'])->name('payfast');
    Route::get('payfastsuccess', [PayfastController::class, 'payFastSuccess'])->name('payfastsuccess');
    Route::get('payfastcancel', [PayfastController::class, 'payFastCancel'])->name('payfastcancel');
    Route::post('payfastnotify', [PayfastController::class, 'payFastNotify'])->name('payfastnotify');

    Route::get('/term_&_condition', 'IndexController@termAndCondition');
    Route::get('/privacy_policy', 'IndexController@privacyPolicy');

    // Route::fallback(function () {
    //     return view('front-error.404');
    // });
});