<?php

use App\Http\Controllers\andishkade\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MultiMorphPostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TypeCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/dashboard', dashboardController::class)->middleware('auth');


Auth::routes();


Route::prefix('manage')->middleware('auth')->group(function () {
    Route::get('permissions/index', [PermissionController::class, 'index'])->name('admin.manage.permissions.index');
    Route::get('roles/get_roles', [PermissionController::class, 'getRoles'])->name('admin.manage.roles.getRole');
    Route::put('roles/update/{role}', [PermissionController::class, 'updateRole'])->name('admin.manage.roles.update');
    Route::delete('roles/delete/{role}', [PermissionController::class, 'deleteRole'])->name('admin.manage.roles.delete');
    Route::post('roles/store', [PermissionController::class, 'storeRole'])->name('admin.manage.roles.store');


    Route::resource('customer', \App\Http\Controllers\CustomerController::class);

    /////menu manager

    Route::resource('menu', MenuController::class);
    Route::resource('module', ModuleController::class);
    Route::put('module/changeStatus/{id}', [ModuleController::class, 'changeStatus'])->name('module.changeStatus');

    Route::resource('slider', SliderController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('user', UserController::class);
    Route::resource('post', PostController::class);
    Route::put('post/changeStatus/{id}', [PostController::class, 'changeStatusPost'])->name('post.changeStatusPost');
    Route::put('post/changePrivacyPost/{id}', [PostController::class, 'changePrivacyPost'])->name('post.changePrivacyPost');


    Route::resource('file', FileController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('typeCategory', TypeCategoryController::class);
    Route::resource('contactUs', ContactUsController::class);
    Route::put('contactUs/changeStatus/{id}', [ContactUsController::class, 'changeStatus'])->name('contactUs.changeStatus');

    Route::resource('multiMorphPost', MultiMorphPostController::class);

    Route::get('menuItem/indexItem', [MenuController::class, 'indexItem'])->name('menu.indexItem');
    Route::post('menuItem/addItem/{id}', [MenuController::class, 'addItem'])->name('menu.addItem');
    Route::delete('menuItem/deleteItem/{id}', [MenuController::class, 'deleteItem'])->name('menu.deleteItem');
    Route::put('menuItem/updateItem/{id}', [MenuController::class, 'updateItem'])->name('menu.updateItem');
    Route::put('menu/changeStatus/{id}', [MenuController::class, 'changeStatus'])->name('menu.changeStatus');

    Route::resource('location', LocationController::class);
    Route::resource('order', OrderController::class);
    Route::put('order/changeStatus/{id}', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
    Route::get('getOrders', [OrderController::class, 'getOrders'])->name('getOrders');


    Route::put('location/changeStatus/{id}', [LocationController::class, 'changeStatus'])->name('location.changeStatus');

});

//Route::get('/', [\App\Http\Controllers\site\SiteController::class, 'index'])->name('site.index');
//Route::get('/single/{id}', [\App\Http\Controllers\site\SiteController::class, 'single'])->name('site.single');
//Route::get('/archive/{category?}', [\App\Http\Controllers\site\SiteController::class, 'archive'])->name('site.archive');
//Route::get('/posts', [\App\Http\Controllers\site\SiteController::class, 'archivePosts'])->name('site.archive.posts');
Route::get('/posts/{category?}', [SiteController::class, 'getPostByCat'])->name('site.getPostByCat');
Route::get('/aboutUs', [SiteController::class, 'aboutUs'])->name('site.aboutUs');
Route::post('/contactUS', [SiteController::class, 'contactUS'])->name('site.contactUS');


Route::get('/search', [SiteController::class, 'search'])->name('site.search');
Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
Route::post('/storeSetting', [SettingController::class, 'storeSetting'])->name('admin.storeSetting');
Route::post('/storeInfo', [SettingController::class, 'storeInfo'])->name('admin.storeInfo');
Route::put('/updateSocial', [SettingController::class, 'updateSocial'])->name('admin.updateSocial');
Route::delete('/deleteSocial/{id}', [SettingController::class, 'deleteSocial'])->name('admin.deleteSocial');
Route::get('/tags', [PostController::class, 'tags'])->name('admin.tags');
Route::put('/storeTags', [PostController::class, 'storeTags'])->name('admin.storeTags');
Route::put('/changeStatusKeyword', [PostController::class, 'changeStatusKeyword'])->name('admin.changeStatusKeyword');

//andishkade




//Route::get('/single/{id}', [HomeController::class, 'single'])->name('andishkade.single');
//Route::get('/singleSession/{id}', [HomeController::class, 'single_session'])->name('andishkade.single.session');
//Route::get('/archiveByTags', [HomeController::class, 'archiveTagsPost'])->name('andishkade.archive.tags');

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/archive/place/{category?}', [SiteController::class, 'archive'])->name('archive.place');
Route::get('/single/place/{id}', [SiteController::class, 'single'])->name('single.place');
Route::get('/contactToUs', [SiteController::class, 'contactUS'])->name('contactUS');
Route::get('/tagsArchive/{category?}', [SiteController::class, 'archivePosts'])->name('site.archive.tag');

Route::middleware('auth:customer')->resource('panel', \App\Http\Controllers\site\PanelController::class);
Route::name('panel.')->group(function (){
    Route::get('orders', [\App\Http\Controllers\site\PanelController::class, 'orders'])->name('orders');
    Route::get('getData', [\App\Http\Controllers\site\PanelController::class, 'getData'])->name('getData');


    Route::post('panelLogout', [\App\Http\Controllers\Auth\LoginController::class,'logoutPanel'])->name('customer.logout');
})->middleware('auth:customer');
Route::group([],function (){
    Route::get('panelLogin',[\App\Http\Controllers\Auth\LoginController::class,'showCustomerLoginForm'])->name('customer.login-view');
    Route::post('adminAuth',[\App\Http\Controllers\Auth\LoginController::class,'adminLogin'])->name('customer.login');

})->middleware('guest');

Route::group([ 'middleware' => ['auth:customer']],function (){
    Route::get('/reserve',[SiteController::class,'setOrder'])->name('panel.setOrder');
    Route::post('/storeOrder/{hall}',[SiteController::class,'storeOrder'])->name('panel.storeOrder');
    Route::get('getTimeOrder', [SiteController::class, 'getTimeOrder'])->name('getTimeOrder');
});


//Route::get('/admin/register',[RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
//Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [SiteController::class, 'search'])->name('site.search');

