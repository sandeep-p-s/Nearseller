<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ShopTypeController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\ShopOfferController;
use App\Http\Controllers\UserLoggedController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\BusinessTypeController;

use App\Http\Controllers\ServiceOfferController;
use App\Http\Controllers\ServiceEmployeeController;
use App\Http\Controllers\Masters\BankController as BankController;
use App\Http\Controllers\Masters\StateController as StateController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Masters\CountryController as CountryController;
use App\Http\Controllers\Masters\DistrictController as DistrictController;

use App\Http\Controllers\Masters\ReligionController as ReligionController;
use App\Http\Controllers\Masters\ProfessionsController as ProfessionsController;

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
    return view('welcome');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('Home');
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


// Route::middleware(['auth', 'role'])->group(function () {
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
//master
    Route::controller(CountryController::class)->group(function () {
        Route::get('listcountry', 'list_country')->name('list.country');
        Route::get('addcountry', 'add_country')->name('add.country');
        Route::post('savecountry', 'store_country')->name('store.country');
        Route::get('editcountry/{id}', 'edit_country')->name('edit.country');
        Route::post('updatecountry/{id}', 'update_country')->name('update.country');
        Route::get('deletecountry/{id}', 'delete_country')->name('delete.country');
    });

    Route::controller(StateController::class)->group(function () {
        Route::get('liststate', 'list_state')->name('list.state');
        Route::get('addstate', 'add_state')->name('add.state');
        Route::post('savestate', 'store_state')->name('store.state');
        Route::get('editstate/{id}', 'edit_state')->name('edit.state');
        Route::post('updatestate/{id}', 'update_state')->name('update.state');
        Route::get('deletestate/{id}', 'delete_state')->name('delete.state');
    });

    Route::controller(DistrictController::class)->group(function () {
        Route::get('listdistrict', 'list_district')->name('list.district');
        Route::get('adddistrict', 'add_district')->name('add.district');
        Route::post('savedistrict', 'store_district')->name('store.district');
        Route::get('editdistrict/{id}', 'edit_district')->name('edit.district');
        Route::post('updatedistrict/{id}', 'update_district')->name('update.district');
        Route::get('deletedistrict/{id}', 'delete_district')->name('delete.district');
    });

    Route::controller(ProfessionsController::class)->group(function () {
        Route::get('listprofession', 'list_profession')->name('list.profession');
        Route::get('addprofession', 'add_profession')->name('add.profession');
        Route::post('saveprofession', 'store_profession')->name('store.profession');
        Route::get('editprofession/{id}', 'edit_profession')->name('edit.profession');
        Route::post('updateprofession/{id}', 'update_profession')->name('update.profession');
        Route::get('deleteprofession/{id}', 'delete_profession')->name('delete.profession');
    });

    Route::controller(ReligionController::class)->group(function () {
        Route::get('listreligion', 'list_religion')->name('list.religion');
        Route::get('addreligion', 'add_religion')->name('add.religion');
        Route::post('savereligion', 'store_religion')->name('store.religion');
        Route::get('editreligion/{id}', 'edit_religion')->name('edit.religion');
        Route::post('updatereligion/{id}', 'update_religion')->name('update.religion');
        Route::get('deletereligion/{id}', 'delete_religion')->name('delete.religion');
    });

    Route::controller(BankController::class)->group(function () {
        Route::get('listbank', 'list_bank')->name('list.bank');
        Route::get('addbank', 'add_bank')->name('add.bank');
        Route::post('savebank', 'store_bank')->name('store.bank');
        Route::get('editbank/{id}', 'edit_bank')->name('edit.bank');
        Route::post('updatebank/{id}', 'update_bank')->name('update.bank');
        Route::get('deletebank/{id}', 'delete_bank')->name('delete.bank');

        Route::get('listbankbranch', 'list_bank_branch')->name('list.bank_branch');
        Route::get('addbankbranch', 'add_bank_branch')->name('add.bank_branch');
        Route::post('savebankbranch', 'store_bank_branch')->name('store.bank_branch');
        Route::get('editbankbranch/{id}', 'edit_bank_branch')->name('edit.bank_branch');
        Route::post('updatebankbranch/{id}', 'update_bank_branch')->name('update.bank_branch');
        Route::get('deletebankbranch/{id}', 'delete_bank_branch')->name('delete.bank_branch');

    });
//admin
    Route::controller(CategoryController::class)->group(function () {
        Route::get('listcategory', 'list_category')->name('list.category');
        Route::get('addcategory', 'add_category')->name('add.category');
        Route::post('savecategory', 'store_category')->name('store.category');
        Route::get('editcategory/{id}', 'edit_category')->name('edit.category');
        Route::post('updatecategory/{id}', 'update_category')->name('update.category');
        Route::get('deletecategory/{id}', 'delete_category')->name('delete.category');
    });

    Route::controller(ExecutiveController::class)->group(function () {
        Route::get('listexecutive', 'list_executive')->name('list.executive');
        Route::get('addexecutive', 'add_executive')->name('add.executive');
        Route::post('saveexecutive', 'store_executive')->name('store.executive');
        Route::get('editexecutive/{id}', 'edit_executive')->name('edit.executive');
        Route::post('updateexecutive/{id}', 'update_executive_type')->name('update.executive');
        Route::get('deleteexecutive/{id}', 'delete_executive')->name('delete.executive');
    });
// });
    Route::controller(SellerController::class)->group(function () {
        Route::get('sellerdashboard', 'sellerdashboard')->name('seller.dashboard');
        Route::get('attributes', 'AttributePage')->name('new.attributes');
        Route::get('allattributes', 'AttributeList')->name('new.allattributes');
        Route::post('addattribute', 'AddAttributePage')->name('AddAttributeForm');
        Route::post('editattribute', 'EditAttributePage')->name('AttributeViewEdit');

    });

    Route::controller(ShopOfferController::class)->group(function () {
        Route::get('listshopoffer', 'list_shop_offer')->name('list.shop_offer');
        Route::get('addshopoffer', 'add_shop_offer')->name('add.shop_offer');
        Route::post('storeshopoffer', 'store_shop_offer')->name('store.shop_offer');
        Route::get('editshopoffer/{id}', 'edit_shop_offer')->name('edit.shop_offer');
        Route::post('updateshopoffer/{id}', 'update_shop_offer')->name('update.shop_offer');
        Route::get('deleteshopoffer/{id}', 'delete_shop_offer')->name('delete.shop_offer');
    });

    Route::controller(ServiceEmployeeController::class)->group(function () {
        Route::get('listserviceemp', 'list_service_employee')->name('list.service_employee');
        Route::get('addserviceemp', 'add_service_employee')->name('add.service_employee');
        Route::post('storeserviceemp', 'store_service_employee')->name('store.service_employee');
        Route::get('editserviceemp/{id}', 'edit_service_employee')->name('edit.service_employee');
        Route::post('updateserviceemp/{id}', 'update_service_employee')->name('update.service_employee');
        Route::get('deleteserviceemp/{id}', 'delete_service_employee')->name('delete.service_employee');
        Route::get('/getDistricts/{state}', 'getDistricts')->name('getDistricts');;
        Route::get('/getStates/{country}', 'getStates')->name('getStates');
    });

    Route::controller(ServiceOfferController::class)->group(function () {
        Route::get('listserviceoffer', 'list_service_offer')->name('list.service_offer');
        Route::get('addserviceoffer', 'add_service_offer')->name('add.service_offer');
        Route::post('storeserviceoffer', 'store_service_offer')->name('store.service_offer');
        Route::get('editserviceoffer/{id}', 'edit_service_offer')->name('edit.service_offer');
        Route::post('updateserviceoffer/{id}', 'update_service_offer')->name('update.service_offer');
        Route::get('deleteserviceoffer/{id}', 'delete_service_offer')->name('delete.service_offer');
    });

    Route::controller(AffiliateController::class)->group(function () {
        Route::get('affdashboard', 'affiliatedashboard')->name('affiliate.dashboard');
        Route::get('newaffiliate', 'AffiliateAddNew')->name('newaffiliate');
        Route::get('affiliatelist', 'AffiliatesList')->name('affiliate.affiliateslist');
        Route::post('affiliatesviews', 'ViewAffiliatesList')->name('affiliate.allaffiliatesview');
        Route::get('affliateshops', 'ViewAffiliatesShopList')->name('affiliate.affliateshops');
        Route::get('allaffilateshopsview', 'AllAffiliatesShopList')->name('affiliate.allaffilateshopsview');
    });


    Route::get('/products', [UserController::class, 'homepage'])->name('user.products');



