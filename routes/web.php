<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
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
################ Front_End Routes ##################
Route::get('/', function () {
    return view('front.home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dash', [App\Http\Controllers\DashBoardController::class, 'dash'])->name('dash');
##################End front_End Routes##########################

#######################    Admin Routes     ##################
define('PAGINATION_COUNT',10);

//Route::get('dash2', [App\Http\Controllers\DashBoardController::class, 'dash'])->middleware('auth:admin')->name('dash2');
Route::group(['prefix'=>'admin'],function() {
    Route::get('dashboard', [App\Http\Controllers\DashBoardController::class, 'dash'])->name('dashboard');




    ############################### Begain Languages Routes##############
        Route::group(['prefix'=>'languages'],function(){

        Route::get('/',[App\Http\Controllers\Admin\LanguagesController::class, 'index'])->name('admin.language');
        Route::get('create', [App\Http\Controllers\Admin\LanguagesController::class, 'create'])->name('create.language');
        Route::post('save', [App\Http\Controllers\Admin\LanguagesController::class, 'save'])->name('save.language');
        Route::get('edit/{id}', [App\Http\Controllers\Admin\LanguagesController::class, 'edit'])->name('edit.language');
        Route::post('update/{id}', [App\Http\Controllers\Admin\LanguagesController::class, 'update'])->name('update.language');
        Route::get('delete/{id}', [App\Http\Controllers\Admin\LanguagesController::class, 'destroy'])->name('delete.language');
    });
    ##############################End Languages Routes####################

    ############################### Begain Categories Routes##############

    Route::group(['prefix'=>'categories'],function(){

        Route::get('/',[App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.MainCat');
        Route::get('create', [App\Http\Controllers\Admin\MainController::class, 'create'])->name('create.MainCat');
        Route::post('save', [App\Http\Controllers\Admin\MainController::class, 'save'])->name('save.MainCat');
        Route::get('edit/{id}', [App\Http\Controllers\Admin\MainController::class, 'edit'])->name('edit.MainCat');
        Route::post('update/{id}', [App\Http\Controllers\Admin\MainController::class, 'update'])->name('update.MainCat');
        Route::get('delete/{id}', [App\Http\Controllers\Admin\MainController::class, 'destroy'])->name('delete.MainCat');
        Route::get('changeStatus/{id}', [App\Http\Controllers\Admin\MainController::class, 'changeStatus'])->name('Status.MainCat');

    });
    ##############################  End Categories Routes####################
	
	   ############################### Begain SubCategories Routes##############

    Route::group(['prefix'=>'subcategories'],function(){

        Route::get('/',[App\Http\Controllers\Admin\SubMainController::class, 'index'])->name('admin.SubMainCat');
        Route::get('create', [App\Http\Controllers\Admin\SubMainController::class, 'create'])->name('create.SubMainCat');
        Route::post('save', [App\Http\Controllers\Admin\SubMainController::class, 'save'])->name('save.SubMainCat');
        Route::get('edit/{id}', [App\Http\Controllers\Admin\SubMainController::class, 'edit'])->name('edit.SubMainCat');
        Route::post('update/{id}', [App\Http\Controllers\Admin\SubMainController::class, 'update'])->name('update.SubMainCat');
        Route::get('delete/{id}', [App\Http\Controllers\Admin\SubMainController::class, 'destroy'])->name('delete.SubMainCat');
        Route::get('changeStatus/{id}', [App\Http\Controllers\SubAdmin\MainController::class, 'changeStatus'])->name('Status.SubMainCat');

    });
    ##############################  End SubCategories Routes####################
	

    ############################### Begain Vendors Routes##############

    Route::group(['prefix'=>'Vendors'],function(){

        Route::get('/',[App\Http\Controllers\Admin\VendorsController::class, 'index'])->name('admin.vendors');
        Route::get('create', [App\Http\Controllers\Admin\VendorsController::class, 'create'])->name('create.Vendor');
        Route::post('save', [App\Http\Controllers\Admin\VendorsController::class, 'save'])->name('save.Vendor');
        Route::get('edit/{id}', [App\Http\Controllers\Admin\VendorsController::class, 'edit'])->name('edit.Vendor');
        Route::post('update/{id}', [App\Http\Controllers\Admin\VendorsController::class, 'update'])->name('update.Vendor');
        Route::get('delete/{id}', [App\Http\Controllers\Admin\VendorsController::class, 'delete'])->name('delete.Vendor');
        Route::get('changeStatus/{id}', [App\Http\Controllers\Admin\VendorsController::class, 'changeStatus'])->name('changeStatus.Vendor');
    });
    ##############################  End Vendors Routes####################
});


Route::get('admin-login', [App\Http\Controllers\DashBoardController::class, 'getLogin'])->name('adminLogin');
Route::post('admin-loginPost', [App\Http\Controllers\DashBoardController::class, 'postLogin'])->name('adminLoginPost');
Route::get('admin-logout', [App\Http\Controllers\DashBoardController::class, 'logout'])->name('adminLogout');



####################### End Admin Routes   ###############################
Auth::routes();

########################## Test Relations ############
Route::get('subcategory',function(){
	
	$mainCat = \App\Models\MainCategory::find(6);
	return $mainCat -> subCategory;
});
Route::get('maincategory',function(){
	
	$subCat = \App\Models\SubCAtegory::find(1);
	return $subCat -> maninCategory;
});



