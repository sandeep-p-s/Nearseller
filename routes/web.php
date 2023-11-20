<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopTypeController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserLoggedController;

use App\Http\Controllers\ServiceEmployeeController;

use App\Http\Controllers\CategoryProductListController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceNewController;
use App\Http\Controllers\Masters\BusinessTypeController as BusinessTypeController;
use App\Http\Controllers\Masters\ServiceCategoryController as ServiceCategoryController;
use App\Http\Controllers\Masters\ServiceTypeController as ServiceTypeController;
use App\Http\Controllers\Masters\ExecutiveController as ExecutiveController;
use App\Http\Controllers\Masters\BankController as BankController;
use App\Http\Controllers\Masters\StateController as StateController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Masters\CountryController as CountryController;
use App\Http\Controllers\Masters\DistrictController as DistrictController;
use App\Http\Controllers\Masters\ReligionController as ReligionController;

use App\Http\Controllers\Masters\AttributeController as AttributeController;
use App\Http\Controllers\Masters\ProfessionsController as ProfessionsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RolePermissionController;
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
    Route::get('/getDistricts/{state}', 'getDistricts')->name('getDistricts');
    Route::get('/getStates/{country}', 'getStates')->name('getStates');
    Route::post('BankBranches', 'getBankBranchesPage')->name('getBankBranches');
    Route::post('EmailLogin', 'EmailLoginPage')->name('EmailLogin');
    Route::post('sellerRegisteration', 'sellerRegisterationPage')->name('sellerRegisteration');
    Route::post('affiliatorRegisteration', 'affiliatorRegisterationPage')->name('affiliatorRegisteration');
    Route::post('shopnotregreferal', 'ShopNotRegRefaralId')->name('shopnotregreferal');
    Route::post('getIFSCode', 'getIFSCodePage')->name('getIFSCode');
    Route::get('/BusinessCategory/{catgry}', 'BusinessCategory')->name('BusinessCategory');
    Route::get('/executivename/{executive}', 'executivename')->name('executivename');
    Route::get('/shopservicetype/{shopservice}', 'shopservicetype')->name('shopservicetype');
    Route::get('/getsubshopservice/{subshopservice}', 'getsubshopservice')->name('getsubshopservice');
    Route::post('existshopname', 'ExistShopNameCheck')->name('existshopname');
    Route::post('existExecutivename', 'ExistExecutivenameCheck')->name('existExecutivename');
    Route::post('existcategoryname', 'ExistCategoryName')->name('existcategoryName');
    Route::post('existServicetypeName', 'ExistServiceTypeName')->name('existServicetypeName');
    Route::post('existnewusercreate', 'ExistnewusercreateCheck')->name('existnewusercreate');

    Route::post('regmailotp', 'MailSendOTPRegistration')->name('MailSendOTPRegistration');
    Route::post('verifyEmailOTP', 'verifyEmailOTPCheck')->name('verifyEmailOTP');

    Route::post('regmobnootp', 'MobnoSendOTPRegistration')->name('MobnoSendOTPRegistration');
    Route::post('verifyMobileOTP', 'verifyMobileNoOTPCheck')->name('verifyMobileNoOTP');

    Route::get('verifyMailTerms/{verificationToken}', 'verifyMailTermsCOnditions')->name('verifyMailTerms');
    Route::post('pubserviceprovider', 'PublicServiceProvider')->name('PubServiceprovidertype');




});

Route::controller(UserLoggedController::class)->group(function () {
    Route::post('LoggedPage/{sentoval}', 'LoggedUserPage')->name('LoggedPage');
    Route::get('/logout', 'logout')->name('logout');
});


Route::middleware(['role'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('dashboard', 'admindashboard')->name('admin.dashboard');
        Route::get('shopapprovals/{id}', 'ShopApproval')->name('admin.shopapprovals');
        Route::get('shopapprovalsadd/{id}', 'ShopApproval')->name('admin.shopapprovalsadd');
        Route::get('allshopsview', 'AllShopsList')->name('admin.allshopsview');
        Route::post('AdmsellerRegisteration', 'AdmsellerRegisterationPage')->name('AdmsellerRegisteration');
        Route::post('shopViewEdit', 'AdmshopViewEdits')->name('shopViewEdit');

        Route::post('shopGalryDelete', 'AdmshopGalryDelte')->name('shopGalryDelte');
        Route::post('AdmsellerUpdate', 'AdmsellerUpdatePage')->name('AdmsellerUpdate');
        Route::post('shopApproved', 'AdmshopApproved')->name('shopApproved');
        Route::post('AdmsellerApproved', 'AdmsellerApprovedPage')->name('AdmsellerApproved');
        Route::post('shopDelete', 'AdmshopDeletePage')->name('shopDelete');

        Route::get('affiliateapprovals', 'AffiliateApproval')->name('admin.affiliateapprovals');
        Route::post('allaffiliatesview', 'AllAffiliatesList')->name('admin.allaffiliatesview');
        Route::post('AdmAffiliateRegisteration', 'AdmAffiliateRegisterationPage')->name('AdmAffiliateRegisteration');
        Route::post('affiliateViewEdit', 'AdmAffiliateViewEdits')->name('affiliateViewEdit');
        Route::post('affiliateadhaarDelte', 'AdmAfiliateAdharDelte')->name('affiliateadhaarDelte');
        Route::post('affiliatePassDelte', 'AdmAfiliatePassDelte')->name('affiliatePassDelte');
        Route::post('affiliatePhotoDelte', 'AdmAfiliatePhotoDelte')->name('affiliatePhotoDelte');
        Route::post('AdmAffiliateUpdate', 'AdmaffiliateUpdatePage')->name('AdmAffiliateUpdate');
        Route::post('affiliateApproved', 'AdmaffiliateApproved')->name('affiliateApproved');
        Route::post('AdmsAffiliateApproved', 'AdmsAffiliateApprovedPage')->name('AdmsAffiliateApproved');
        Route::post('AffiliateDelete', 'AdmaffiliateDeletePage')->name('AffiliateDelete');
        Route::get('shopsinactive/{id}', 'ShopInactives')->name('admin.shopapprovalsinactive');
        Route::get('allshopsinactive', 'AllShopsInactiveList')->name('admin.allshopsinactiveview');
        Route::post('shopserviceapproved', 'AdmShopServiceApprovedAll')->name('ShopServiceApprovedAll');


        Route::get('shopapprovalsm/{id}', 'ShopApprovalm')->name('admin.shopapprovalsm');
        Route::get('allshopsviewm', 'AllShopsListm')->name('admin.allshopsviewm');


    });





    Route::controller(RoleController::class)->group(function () {

        Route::get('listroles', 'list_roles')->name('list.roles');
        Route::get('addroles', 'add_roles')->name('add.roles');
        Route::post('saveroles', 'store_roles')->name('store.roles');
        Route::get('editroles/{id}', 'edit_roles')->name('edit.roles');
        Route::post('updateroles/{id}', 'update_roles')->name('update.roles');
        Route::get('viewrole/{id}', 'view_roles')->name('view.roles');
        Route::get('deleteroles/{id}', 'delete_roles')->name('delete.roles');


        Route::get('listrole', 'get_roles')->name('get.roles');
        Route::get('addrole', 'add_role')->name('add.role');
        Route::post('storerole', 'store_role')->name('store.role');
        Route::get('editrole/{id}', 'edit_role')->name('edit.role');
        Route::post('updaterole/{id}', 'update_role')->name('update.role');
        Route::post('/update/activation/{id}', 'updateActivation')->name('update.activation');

        Route::get('newuser', 'CreateNewUser')->name('user.usercreate');
        Route::get('allroleusers', 'AllUsersList')->name('user.allusersview');
        Route::post('saveuser', 'AdmUserRegistration')->name('AdmUserCreate');
        Route::post('edituser', 'AdmUserViewEdit')->name('UserViewEdit');
        Route::post('userupdate', 'AdmUpdateUserDetails')->name('AdmEditUserDetails');
        Route::post('userdelete', 'AdmuserDeletePage')->name('userDelete');

        Route::get('usermenu', 'AdmUserMenuPage')->name('user.usermenucreate');
        Route::get('usermenuview', 'AdmUserMenuViewPage')->name('user.allusermenuview');
        Route::post('userpagemenu', 'AdmAddUserPageMenu')->name('user.userpagemenu');
        Route::post('getusermenu', 'AdmgetUserMenu')->name('user.getUserMenu');
        Route::post('getprivilageMenu', 'AdmgetPrivilageMenu')->name('user.getPrivilageMenu');

        Route::get('rolemenu', 'AdmRoleMenuPage')->name('user.rolemenucreate');
        Route::get('rolemenuview', 'AdmRoleMenuViewPage')->name('user.allrolemenuview');
        Route::post('rolepagemenu', 'AdmAddRolePageMenu')->name('user.rolepagemenu');
        Route::post('getrolemenu', 'AdmgetRoleMenu')->name('user.getRoleMenu');
        Route::post('getrolePrivilage', 'AdmgetrolePrivilage')->name('user.getrolePrivilage');

        Route::get('userrole', 'AdmuUserRoleMenuPage')->name('user.userrolecreate');
        Route::post('userrolemenu', 'AdmgetUserRoleMenu')->name('user.getUserRoleMenu');
        Route::post('userrolepage', 'AdmAddUserRolePageMenu')->name('user.userrolepagemenu');

        Route::get('changepassword', 'ChangePasswordPagerd')->name('user.changepassword');
        Route::post('newpassword', 'ChangeNewPasswordPage')->name('ChangeNewPassword');
    });


    Route::controller(RolePermissionController::class)->group(function () {
        Route::post('newrolename', 'NewRoleNameSearch')->name('NewRoleNameSearch');
        Route::get('rolepermenu', 'AdmRoleperMenuPage')->name('user.rolepermenucreate');
        Route::get('rolepermenuview', 'AdmRoleperMenuViewPage')->name('user.allrolepermenuview');
        Route::post('roleperpagemenu', 'AdmAddRoleperPageMenu')->name('user.roleperpagemenu');
        Route::post('getrolepermenu', 'AdmgetRoleperMenu')->name('user.getRoleperMenu');
        Route::post('getroleperPrivilage', 'AdmgetroleperPrivilage')->name('user.getroleperPrivilage');
    });



    Route::controller(ProductController::class)->group(function () {
        Route::get('listshopproduct', 'ProductListView')->name('user.shopproduct');
        Route::get('listshopproductadd', 'ProductListView')->name('user.shopproductadd');
        Route::post('allproductview', 'AllProductList')->name('product.allproductview');
        Route::post('addnewproduct', 'AdmNewPrdoductAdd')->name('AdmNewPrdoductAdd');
        Route::post('productviewedit', 'AdmProductViewEdit')->name('productViewEdit');
        Route::post('productimagedelete', 'AdmproductValDelte')->name('productValDelte');
        Route::post('productedit', 'AdmNewPrdoductEdit')->name('AdmPrdoductEdit');
        Route::post('shopsearch', 'AdmShopNameSearch')->name('ShopNameSearch');
        Route::post('approvedall', 'AdmProductApprovedAll')->name('ProductApprovedAll');
        Route::post('productapproved', 'AdmproductApproved')->name('productApproved');
        Route::post('approvedproduct', 'AdmapprovedPrdoduct')->name('AdmApprovedprdoduct');
        Route::post('ProductsDelete', 'AdmProductsDelete')->name('ProductsDelete');
        Route::post('productCategory', 'productCategorySearch')->name('productCategorySearch');
        Route::post('productname', 'ProductNameSearch')->name('ProductNameSearch');
        Route::post('existproducts', 'ExistproductviewPage')->name('product.existproductview');
        Route::post('existproductsview', 'AdmproductExistEdit')->name('productExistEdit');
        Route::post('Prdoductexist', 'AdmPrdoductExist')->name('AdmPrdoductExist');
    });
    Route::controller(CategoryProductListController::class)->group(function () {
        Route::get('listshopcategoryproduct', 'CategoryProductListView')->name('user.shopcategoryproduct');
        Route::post('allcategoryproduct', 'AllCategoryProductList')->name('productlist.allcategoryproduct');
        Route::post('categoryproductlist', 'categoryproductlist')->name('productlist.categoryproductlist');



        Route::get('parentcategorys', 'ParentProductListView');
        Route::post('listparentcategory', 'ListParentCategory')->name('productlist.parentcategories');
        Route::post('productview', 'AdmProductView')->name('productlist.productView');
    });

    Route::controller(AppointmentController::class)->group(function () {
        Route::get('appointmentview', 'Apponintmentview')->name('appointment.appointmentview');
        Route::post('listappointmentadd', 'AppointmentListView')->name('appointment.listappointmentadd');
        Route::post('addappointment', 'AdmNewAppointmentAdd')->name('AdmNewAppointmentAdd');
        Route::post('appointmentviewedit', 'AdmAppointmentViewEdit')->name('AppointmentViewEdit');
        Route::post('appointmentupdate', 'AdmNewAppointmentEdit')->name('AdmNewAppointmentEdit');
        Route::post('appointmentdelete', 'AppointmentDelete')->name('AppointmentDelete');
    });




    Route::controller(BusinessTypeController::class)->group(function () {
        Route::get('listbusinesstype', 'list_business_type')->name('list.businesstype');
        Route::get('addbusinesstype', 'add_business_type')->name('add.businesstype');
        Route::post('savebusinesstype', 'store_business_type')->name('store.business_type');
        Route::get('businessedit/{id}', 'edit_business_type')->name('edit.businesstype');
        Route::post('businessupdate/{id}', 'update_business_type')->name('update.businesstype');
        Route::get('businessdelete/{id}', 'delete_business_type')->name('delete.businesstype');
    });

    Route::controller(ServiceCategoryController::class)->group(function () {
        Route::get('listservicecategory', 'list_service_category')->name('list.servicecategory');
        Route::get('addservicecategory', 'add_service_category')->name('add.servicecategory');
        Route::post('saveservicecategory', 'store_service_category')->name('store.servicecategory');
        Route::get('servicecategoryedit/{id}', 'edit_service_category')->name('edit.servicecategory');
        Route::post('servicecategoryupdate/{id}', 'update_service_category')->name('update.servicecategory');
        Route::get('servicecategorydelete/{id}', 'delete_service_category')->name('delete.servicecategory');
        Route::get('listservicesubcategory', 'list_service_subcategory')->name('list.servicesubcategory');
        Route::get('addservicesubcategory', 'add_service_subcategory')->name('add.servicesubcategory');
        Route::post('saveservicesubcategory', 'store_service_subcategory')->name('store.servicesubcategory');
        Route::get('servicesubcategoryedit/{id}', 'edit_service_subcategory')->name('edit.servicesubcategory');
        Route::post('servicesubcategoryupdate/{id}', 'update_service_subcategory')->name('update.servicesubcategory');
        Route::get('servicesubcategorydelete/{id}', 'delete_service_subcategory')->name('delete.servicesubcategory');
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

        Route::get('sellerprovidertype/{id}', 'ServiceProviderApproval')->name('admin.sellerprovidertype');
        Route::get('allsellerproviderview', 'AllSellerProviderList')->name('admin.allsellerproviderview');
        Route::post('sellerserviceprovider', 'SellerServiceProviderApprovedAll')->name('SellerServiceApprovedAll');
        Route::post('ProviderTypeApproved', 'AdmsellerserviceApproved')->name('serviceSeller_Approved');
        Route::post('ProvidersellerApproved', 'AdmsellerProviderApprovedPage')->name('ServiceproviderApprovaltype');
    });
    //master
    Route::controller(AttributeController::class)->group(function () {
        Route::get('listattribute', 'list_attribute')->name('list.attribute');
        Route::get('addattribute', 'add_attribute')->name('add.attribute');
        Route::post('saveattribute', 'store_attribute')->name('store.attribute');
        Route::get('editattribute/{id}', 'edit_attribute')->name('edit.attribute');
        Route::post('updateattribute/{id}', 'update_attribute')->name('update.attribute');
        Route::get('deleteattribute/{id}', 'delete_attribute')->name('delete.attribute');

        Route::get('listattribute_value', 'list_attribute_value')->name('list.attribute_value');
        Route::get('addattribute_value', 'add_attribute_value')->name('add.attribute_value');
        Route::post('saveattribute_value', 'store_attribute_value')->name('store.attribute_value');
        Route::get('editattribute_value/{id}', 'edit_attribute_value')->name('edit.attribute_value');
        Route::post('updateattribute_value/{id}', 'update_attribute_value')->name('update.attribute_value');
        Route::get('deleteattribute_value/{id}', 'delete_attribute_value')->name('delete.attribute_value');
    });

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
        Route::get('addlistcategory', 'list_category')->name('list.addcategory');
        Route::get('addcategory', 'add_category')->name('add.category');
        Route::get('parentcategory/{value}', 'parent_category')->name('parent.category');
        Route::get('parentcategoryedit/{value}', 'parent_category_edit')->name('parent.categoryedit');
        Route::post('savecategory', 'store_category')->name('store.category');
        Route::get('editcategory/{id}', 'edit_category')->name('edit.category');
        Route::post('updatecategory/{id}', 'update_category')->name('update.category');
        Route::get('deletecategory/{id}', 'delete_category')->name('delete.category');
        Route::get('approvedcategory/{id}', 'approved_category')->name('approved.category');
        Route::post('approvedstatuscategory/{id}', 'approvedstatus_category')->name('approvedstatus.category');
        Route::post('categoryapprovedall', 'AdmCategoryApprovedAll')->name('CategoryApprovedAll');
    });
    // Route::controller(CategoryController::class)->group(function () {
    //     Route::get('listcategory', 'list_category')->name('list.category');
    //     Route::get('addlistcategory', 'list_category')->name('list.category');
    //     Route::get('addcategory', 'add_category')->name('add.category');
    //     Route::get('parentcategory/{value}', 'parent_category')->name('parent.category');
    //     Route::post('savecategory', 'store_category')->name('store.category');
    //     Route::get('editcategory/{id}', 'edit_category')->name('edit.category');
    //     Route::post('updatecategory/{id}', 'update_category')->name('update.category');
    //     Route::get('deletecategory/{id}', 'delete_category')->name('delete.category');
    //     Route::get('approvedcategory/{id}', 'approved_category')->name('approved.category');
    //     Route::post('approvedstatuscategory/{id}', 'approvedstatus_category')->name('approvedstatus.category');
    // });

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
        Route::post('uploadshops', 'UploadsellerRegisteration')->name('UploadsellerRegister');
    });

    Route::controller(OfferController::class)->group(function () {
        Route::get('listshopoffer', 'list_shop_offer')->name('list.shop_offer');
        Route::get('addlistoffer', 'list_offer')->name('list.shop_offer');
        Route::get('addshopoffer', 'add_shop_offer')->name('add.shop_offer');
        Route::post('storeshopoffer', 'store_shop_offer')->name('store.shop_offer');
        Route::get('editshopoffer/{id}', 'edit_shop_offer')->name('edit.shop_offer');
        Route::post('updateshopoffer/{id}', 'update_shop_offer')->name('update.shop_offer');
        Route::get('deleteshopoffer/{id}', 'delete_shop_offer')->name('delete.shop_offer');
        Route::get('approvedshopoffer/{id}', 'approved_shopoffer')->name('approved.shopoffer');
        Route::post('approvedstatusshopoffer/{id}', 'approvedstatus_shopoffer')->name('approvedstatus.shopoffer');
        Route::post('shopofferapprovedall', 'AdmShopOfferApprovedAll')->name('ShopOfferApprovedAll');

        Route::get('listserviceoffer', 'list_service_offer')->name('list.service_offer');
        Route::get('addlistserviceoffer', 'list_service_offer')->name('list.service_offer');
        Route::get('addserviceoffer', 'add_service_offer')->name('add.service_offer');
        Route::post('storeserviceoffer', 'store_service_offer')->name('store.service_offer');
        Route::get('editserviceoffer/{id}', 'edit_service_offer')->name('edit.service_offer');
        Route::post('updateserviceoffer/{id}', 'update_service_offer')->name('update.service_offer');
        Route::get('deleteserviceoffer/{id}', 'delete_service_offer')->name('delete.service_offer');
        Route::get('approvedserviceoffer/{id}', 'approved_serviceoffer')->name('approved.serviceoffer');
        Route::post('approvedstatusservice/{id}', 'approvedstatus_service')->name('approvedstatus.service');
        Route::post('serviceofferapprovedall', 'AdmServiceOfferApprovedAll')->name('ServiceOfferApprovedAll');

    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('listservice', 'list_service')->name('list.service');
        Route::get('addservice', 'add_service')->name('add.service');
        Route::post('storeservice', 'store_service')->name('store.service');
        Route::get('editservice/{id}', 'edit_service')->name('edit.service');
        Route::post('updateservice/{id}', 'update_service')->name('update.service');
        Route::get('deleteservice/{id}', 'delete_service')->name('delete.service');
        Route::post('serviceapprovedall', 'AdmServiceApprovedAll')->name('ServiceApprovedAll');
        Route::get('approveservice/{id}', 'approved_service')->name('approve.service');
        Route::post('updateserviceapproval/{id}', 'UpdateServiceApproval')->name('update.serviceapproval');
    });

    Route::controller(ServiceNewController::class)->group(function () {
        Route::get('listallservice/{id}', 'ServiceProductListView')->name('user.listallservice');
        Route::get('listallserviceapp', 'ServiceProductListViewApp')->name('user.listallserviceapp');
        Route::post('allserviceview', 'AllServiceProductList')->name('serviceproduct.allserviceproductview');
        Route::post('addnewservice', 'AdmNewServiceAdd')->name('AdmNewServiceAdd');
        Route::post('serviceviewedit', 'AdmServiceViewEdit')->name('serviceNewViewEdit');
        Route::post('newserviceedit', 'AdmNewServiceEdit')->name('AdmNewServiceEdit');
        Route::post('approvedallservice', 'AdmServiceApprovedAll')->name('ServiceApprovedAll');
        Route::post('serviceapproved', 'AdmserviceApproved')->name('serviceApproved');
        Route::post('approvedservice', 'AdmapprovedService')->name('AdmApprovedservice');
        Route::post('Servicedelete', 'AdmServiceDelete')->name('ServiceDelete');
    });


    Route::controller(ServiceEmployeeController::class)->group(function () {
        Route::get('listserviceemp/{id}', 'list_service_employee')->name('list.service_employee');
        Route::get('addserviceemp/{id}', 'add_service_employee')->name('add.service_employee');
        Route::post('storeserviceemp', 'store_service_employee')->name('store.service_employee');
        Route::get('editserviceemp/{id}', 'edit_service_employee')->name('edit.service_employee');
        Route::post('updateserviceemp/{id}', 'update_service_employee')->name('update.service_employee');
        Route::get('deleteserviceemp/{id}', 'delete_service_employee')->name('delete.service_employee');
        // Route::get('/getDistricts/{state}', 'getDistricts')->name('getDistricts');;
        // Route::get('/getStates/{country}', 'getStates')->name('getStates');
    });


    Route::controller(AffiliateController::class)->group(function () {
        Route::get('affdashboard', 'affiliatedashboard')->name('affiliate.dashboard');
        Route::get('newaffiliate', 'AffiliateAddNew')->name('newaffiliate');
        Route::get('affiliatelist', 'AffiliatesList')->name('affiliate.affiliateslist');
        Route::post('affiliatesviews', 'ViewAffiliatesList')->name('affiliate.allaffiliatesview');
        Route::get('affliateshops/{id}', 'ViewAffiliatesShopList')->name('affiliate.affliateshops');
        Route::get('allaffilateshopsview', 'AllAffiliatesShopList')->name('affiliate.allaffilateshopsview');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customerapproval/{id}', 'CustomerApproval')->name('cust.custaproval');
        Route::get('allcustomer', 'AllCustomerList')->name('cust.allcustomersview');
        Route::post('editcustomer', 'AdmCustomerViewEdit')->name('CustomerViewEdit');
        Route::post('customerupdate', 'AdmUpdateCustomerDetails')->name('AdmCustomerEditDetails');
        Route::post('customerdelete', 'AdmCustomerDeletePage')->name('customerDelete');
        Route::post('customerapproveall', 'AdmCustomersApprovedAll')->name('CustomersApprovedAll');
    });

});

Route::controller(UserController::class)->group(function () {
    Route::get('/products', 'productPage')->name('user.products');
    Route::get('/services', 'servicePage')->name('user.services');
    // Route::get('/services/show/{id}', 'serviceMenus')->name('services.show');
});
