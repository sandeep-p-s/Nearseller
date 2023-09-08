<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopTypeController;
use App\Http\Controllers\UserLoggedController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\RoleController;

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
    return view('user.main', ['title' => 'Home']);
})->name('home');
Route::controller(HomeController::class)->group(function () {
    Route::get('index', 'index')->name('Home');
    Route::get('login', 'Login')->name('login');
    Route::post('register', 'RegisterPage')->name('Register');
    Route::get('verifyMail/{verificationToken}', 'VerifyMailPage')->name('verifyMail');
    Route::post('existemail', 'ExistEmailCheck')->name('existemail');
    Route::post('existmobno', 'ExistMobnoCheck')->name('existmobno');
    Route::post('ResetPaswd', 'otpGenrateReset')->name('ResetPaswd');
    Route::post('notregister', 'NotRegMobnoEmail')->name('notregister');
    Route::post('regenerateotp', 'otpRegenGenrate')->name('regenerateotp');
    Route::post('verifyOTP', 'verifyOTPCheck')->name('verifyOTP');
    Route::post('newpaswrd', 'ResetNewPaswd')->name('newpaswrd');
    Route::post('mobotpgenrte', 'MobLoginOTPgenrte')->name('mobotpgenrte');
    Route::get('/getDistricts/{state}', 'getDistricts')->name('getDistricts');;
    Route::get('/getStates/{country}', 'getStates')->name('getStates');
    Route::post('BankBranches', 'getBankBranchesPage')->name('getBankBranches');
    Route::post('EmailLogin', 'EmailLoginPage')->name('EmailLogin');

    Route::post('sellerRegisteration', 'sellerRegisterationPage')->name('sellerRegisteration');
    Route::post('affiliatorRegisteration', 'affiliatorRegisterationPage')->name('affiliatorRegisteration');
    Route::post('shopnotregreferal', 'ShopNotRegRefaralId')->name('shopnotregreferal');
    Route::post('getIFSCode', 'getIFSCodePage')->name('getIFSCode');
});

Route::controller(UserLoggedController::class)->group(function () {
    Route::post('LoggedPage/{sentoval}', 'LoggedUserPage')->name('LoggedPage');
    Route::get('/logout', 'logout')->name('logout');
});
Route::controller(AdminController::class)->group(function (){
    Route::get('dashboard', 'admindashboard')->name('admin.dashboard');
    Route::get('shopapprovals', 'ShopApproval')->name('admin.shopapprovals');
    Route::get('allshopsview', 'AllShopsList')->name('admin.allshopsview');
    Route::post('AdmsellerRegisteration','AdmsellerRegisterationPage')->name('AdmsellerRegisteration');
    Route::post('shopViewEdit', 'AdmshopViewEdits')->name('shopViewEdit');

    Route::post('shopGalryDelete', 'AdmshopGalryDelte')->name('shopGalryDelte');
    Route::post('AdmsellerUpdate','AdmsellerUpdatePage')->name('AdmsellerUpdate');
    Route::post('shopApproved', 'AdmshopApproved')->name('shopApproved');
    Route::post('AdmsellerApproved', 'AdmsellerApprovedPage')->name('AdmsellerApproved');
    Route::post('shopDelete', 'AdmshopDeletePage')->name('shopDelete');

    Route::get('affiliateapprovals', 'AffiliateApproval')->name('admin.affiliateapprovals');
    Route::post('allaffiliatesview', 'AllAffiliatesList')->name('admin.allaffiliatesview');
    Route::post('AdmAffiliateRegisteration','AdmAffiliateRegisterationPage')->name('AdmAffiliateRegisteration');
    Route::post('affiliateViewEdit', 'AdmAffiliateViewEdits')->name('affiliateViewEdit');
    Route::post('affiliateadhaarDelte', 'AdmAfiliateAdharDelte')->name('affiliateadhaarDelte');
    Route::post('affiliatePassDelte', 'AdmAfiliatePassDelte')->name('affiliatePassDelte');
    Route::post('affiliatePhotoDelte', 'AdmAfiliatePhotoDelte')->name('affiliatePhotoDelte');
    Route::post('AdmAffiliateUpdate','AdmaffiliateUpdatePage')->name('AdmAffiliateUpdate');
    Route::post('affiliateApproved', 'AdmaffiliateApproved')->name('affiliateApproved');
    Route::post('AdmsAffiliateApproved', 'AdmsAffiliateApprovedPage')->name('AdmsAffiliateApproved');
    Route::post('AffiliateDelete', 'AdmaffiliateDeletePage')->name('AffiliateDelete');


    });





    Route::controller(RoleController::class)->group(function () {
        Route::get('listrole', 'get_roles')->name('get.roles');
        Route::get('addrole', 'add_roles')->name('add.role');
        Route::post('storerole', 'store_role')->name('store.role');
        Route::get('editrole/{id}', 'edit_roles')->name('edit.role');
        Route::post('updaterole/{id}', 'update_roles')->name('update.role');
        Route::post('/update/activation/{id}', 'updateActivation')->name('update.activation');
    });

    Route::controller(BusinessTypeController::class)->group(function () {
        Route::get('listbusinesstype', 'list_business_type')->name('list.businesstype');
        Route::get('addbusinesstype', 'add_business_type')->name('add.businesstype');
        Route::post('savebusinesstype', 'store_business_type')->name('store.business_type');
        Route::get('businessedit/{id}', 'edit_business_type')->name('edit.businesstype');
        Route::post('businessupdate/{id}', 'update_business_type')->name('update.businesstype');
        Route::get('businessdelete/{id}', 'delete_business_type')->name('delete.businesstype');
    });

    Route::controller(ShopTypeController::class)->group(function () {
        Route::get('listshoptype', 'list_shop_type')->name('list.shoptype');
        Route::get('addshoptype', 'add_shop_type')->name('add.shoptype');
        Route::post('saveshoptype', 'store_shop_type')->name('store.shop_type');
        Route::get('shopedit/{id}', 'edit_shop_type')->name('edit.shoptype');
        Route::post('shopupdate/{id}', 'update_shop_type')->name('update.shoptype');
        Route::get('shopdelete/{id}', 'delete_shop_type')->name('delete.shoptype');
    });

    Route::controller(ServiceTypeController::class)->group(function () {
        Route::get('listservicetype', 'list_service_type')->name('list.servicetype');
        Route::get('addservicetype', 'add_service_type')->name('add.servicetype');
        Route::post('saveservicetype', 'store_service_type')->name('store.service_type');
        Route::get('serviceedit/{id}', 'edit_service_type')->name('edit.servicetype');
        Route::post('serviceupdate/{id}', 'update_service_type')->name('update.servicetype');
        Route::get('servicedelete/{id}', 'delete_service_type')->name('delete.servicetype');
    });

    Route::controller(ExecutiveController::class)->group(function () {
        Route::get('listexecutive', 'list_executive')->name('list.executive');
        Route::get('addexecutive', 'add_executive')->name('add.executive');
        Route::post('saveexecutive', 'store_executive')->name('store.executive');
        Route::get('editexecutive/{id}', 'edit_executive')->name('edit.executive');
        Route::post('updateexecutive/{id}', 'update_executive_type')->name('update.executive');
        Route::get('deleteexecutive/{id}', 'delete_executive')->name('delete.executive');
    });

Route::controller(SellerController::class)->group(function () {
    //Route::get('dashboard', 'sellerdashboard')->name('seller.dashboard');
});
Route::controller(AffiliateController::class)->group(function () {
    Route::get('affdashboard', 'affiliatedashboard')->name('affiliate.dashboard');
    Route::get('newaffiliate', 'AffiliateAddNew')->name('newaffiliate');
});

Route::get('/products', [UserController::class, 'homepage'])->name('user.products');
