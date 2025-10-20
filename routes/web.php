<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
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
    return view('frontend.index');
});

Route::get('auth/google', [SocialiteController::class, 'googleLogin'])->name('auth.google');
Route::get('auth/google-callback', [SocialiteController::class, 'googleAuthenticate'])->name('auth.google-callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');
});


Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatepassword'])->name('update.password');
});


//Vendor
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');

    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');

    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatepassword'])->name('update.password');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');
// become.vendor

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(BrandController::class)->group(function () {

        Route::match(['get', 'post'], '/all/brand', 'allBrand')->name('all.brand');
        Route::match(['get', 'post'], '/add/brand', 'addBrand')->name('add.brand');
        Route::match(['get', 'post'], '/store/brand', 'StoreBrand')->name('store.brand');
        Route::match(['get', 'post'], '/edit/brand/{id}', 'editBrand')->name('edit.brand');
        Route::match(['get', 'post'], '/update/brand/', 'updateBrand')->name('update.brand');
        Route::match(['get', 'post'], '/delete/brand/{id}', 'deleteBrand')->name('delete.brand');
    });
});

Route::controller(CategoryController::class)->group(function () {

    Route::match(['get', 'post'], '/all/category', 'allCategory')->name('all.category');
    Route::match(['get', 'post'], '/add/category', 'addCategory')->name('add.category');
    Route::match(['get', 'post'], '/store/category', 'storeCategory')->name('store.category');
    Route::match(['get', 'post'], '/edit/category/{id}', 'editCategory')->name('edit.category');
    Route::match(['get', 'post'], '/update/category/', 'updateCategory')->name('update.category');
    Route::match(['get', 'post'], '/delete/category/{id}', 'deleteCategory')->name('delete.category');
});


Route::controller(SubCategoryController::class)->group(function () {

    Route::match(['get', 'post'], '/all/subCategory', 'subCategory')->name('all.subcategory');
    Route::match(['get', 'post'], '/add/subcategory', 'addsubCategory')->name('add.subcategory');
    Route::match(['get', 'post'], '/store/subCategory', 'storeSubCategory')->name('store.subcategory');
    Route::match(['get', 'post'], '/edit/subcategory/{id}', 'editSubCategory')->name('edit.subcategory');
    Route::match(['get', 'post'], '/update/subcategory/', 'updateSubCategory')->name('update.subcategory');
    Route::match(['get', 'post'], '/delete/subcategory/{id}', 'deleteSubCategory')->name('delete.subcategory');

    Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
});

Route::controller(AdminController::class)->group(function () {

    Route::match(['get', 'post'], '/inactive/vendor', 'inactiveVendor')->name('inactive.vendor');
    Route::match(['get', 'post'], '/active/vendor', 'activeVendor')->name('active.vendor');
    Route::match(['get', 'post'], '/inactive/vendor/details/{id}', 'inactivevendorDetails')->name('inactive.vendor.details');
    Route::match(['get', 'post'], '/active/vendor/approve/', 'activeVendorApprove')->name('active.vendor.approve');
    Route::match(['get', 'post'], '/active/vendor/details/{id}', 'activevendorDetails')->name('active.vendor.details');
    Route::match(['get', 'post'], '/inactive/vendor/approve/', 'inactiveVendorApprove')->name('inactive.vendor.approve');

});


Route::controller(ProductController::class)->group(function () {

    Route::match(['get', 'post'], '/all/product', 'allProduct')->name('all.product');
    Route::match(['get', 'post'], '/add/product', 'addProduct')->name('add.product');
    Route::match(['get', 'post'], '/store/product', 'storeProduct')->name('store.product');
    Route::match(['get', 'post'], '/edit/product/{id}', 'editProduct')->name('edit.product');
    Route::put('/update/product/{id}', 'updateProduct')->name('update.product');
    Route::post('/update/product/thambnail/', 'updateProductThambnail')->name('update.product.thambnail');
    Route::post('/update/product/multiimage', 'updateProductMultiimage')->name('update.product.multiimage');
    Route::delete('/delete/product/multiimage/{id}', 'deleteProductMultiImage')->name('product.multiimg.delete');
    Route::get('/product/inactive/{id}', 'productInactive')->name('product.inactive');
    Route::get('/product/active/{id}', 'productActive')->name('product.active');
    Route::get('/product/delete/{id}', 'productDelete')->name('product.delete');

});