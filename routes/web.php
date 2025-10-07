<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Backed\CityController;
use App\Http\Controllers\Backed\RoomController;
use App\Http\Controllers\SocialloginController;
use App\Http\Controllers\Backed\StateController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\Backed\AmenityController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\Backed\AdminLoginController;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\Backed\AdmindashboardController;
use App\Http\Controllers\Backed\PropertyamenityController;
use App\Http\Controllers\Backed\PropertycategoryController;
use App\Http\Controllers\frontend\dashboard\PropertyController;

/* Front page route */
Route::get('/',[HomeController::class,'index']);
Route::middleware('guest')->group(function() {
    Route::get('register',[UserController::class,'register'])->name('register');
    Route::post('storeuser',[UserController::class,'storeuser'])->name('storeuser');
    Route::get('googleredirect',[UserController::class,'googleLoginRedirect'])->name('googleredirect');
    Route::get('githubredirect',[SocialloginController::class,'github'])->name('githubredirect');
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('loginuser',[LoginController::class,'login'])->name('loginuser');
    Route::get('googleredirectcallback',[UserController::class,'googleredirectcallback'])->name('googleredirectcallback');
    Route::get('githubcallback',[SocialloginController::class,'githubcallback'])->name('githubcallback');
});
Route::get('logout',[UserController::class,'logout'])->name('logout');
/* Dashboard route */
Route::middleware(["authenticate"])->group(function() {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('property-add',[PropertyController::class,'index'])->name('property-add');
    Route::post('filepond',[PropertyController::class,'filepond'])->name('filepond');
    /* Step 1 route with validation middleware */
    Route::middleware('propertysteps:step1')->group(function() {
         Route::get('steponeview',[PropertyController::class,'steponeview'])->name('steponeview');
        Route::post('step1',[PropertyController::class,'step1'])->name('step1');
    });
    /* Step 2 route with validation middleware */
    Route::middleware('propertysteps:step2')->group(function() {
        Route::get('steptwoview',[PropertyController::class,'steptwoview'])->name('steptwoview');
        Route::post('step2',[PropertyController::class,'step2'])->name('step2');
    });
   /* Step 3 route with validation middleware */
    Route::middleware('propertysteps:step3')->group(function() {
        Route::get('stepthreeview',[PropertyController::class,'stepthreeview'])->name('stepthreeview');
        Route::post('step3',[PropertyController::class,'step3'])->name('step3');
    });
     /* Step 4 route with validation middleware */
    Route::middleware('propertysteps:step4')->group(function() {
        Route::get('stepfourview',[PropertyController::class,'stepfourview'])->name('stepfourview');
        Route::post('step4',[PropertyController::class,'step4'])->name('step4');
    });
    /* Step 5 route with validation middleware */
    Route::middleware('propertysteps:step5')->group(function() {
        Route::get('stepfiveview',[PropertyController::class,'stepfiveview'])->name('stepfiveview');
        Route::post('step5',[PropertyController::class,'step5'])->name('step5');
        Route::post('getAmenitiesAjax',[PropertyController::class,'getAmenitiesAjax'])->name('getAmenitiesAjax');
    });
    /* Step 5 route with validation middleware */
    Route::middleware('propertysteps:step6')->group(function() {
        Route::get('stepsixview',[PropertyController::class,'stepsixview'])->name('stepsixview');
        Route::post('step6',[PropertyController::class,'step6'])->name('step6');
    });
});

/* Admin guest routes */
Route::get('adminlogin',[AdminLoginController::class,'index'])->name('adminlogin');
Route::post('authenticateadmin',[AdminLoginController::class,'login'])->name('authenticateadmin');
Route::get('adminlogout',[AdminLoginController::class,'logout'])->name('adminlogout');

/* Admin routes */
Route::middleware('admin')->group(function() {
    /* Admin dashboard */
    Route::get('admindashboard',[AdmindashboardController::class,'index'])->name('admindashboard');
    /* Amenities */
    Route::get('amenities',[AmenityController::class,'index'])->name('amenities');
    Route::post('astore',[AmenityController::class,'store'])->name('astore');
    Route::get('ajaxamenitylist',[AmenityController::class,'index'])->name('ajaxamenitylist');
    Route::post('editAmenitylist',[AmenityController::class,'edit'])->name('editAmenitylist');
    Route::post('updateAmenitylist',[AmenityController::class,'update'])->name('updateAmenitylist');
    Route::post('statusChange',[AmenityController::class,'statusChange'])->name('statusChange');
    Route::post('multipleAmenityDelete',[AmenityController::class,'multipleAmenityDelete'])->name('multipleAmenityDelete');
     /* Property Amenities */
    Route::get('pamenities',[PropertyamenityController::class,'index'])->name('pamenities');
    Route::post('pastore',[PropertyamenityController::class,'store'])->name('pastore');
    Route::get('pajaxamenitylist',[PropertyamenityController::class,'index'])->name('pajaxamenitylist');
    Route::post('peditAmenitylist',[PropertyamenityController::class,'edit'])->name('peditAmenitylist');
    Route::post('pupdateAmenitylist',[PropertyamenityController::class,'update'])->name('pupdateAmenitylist');
    Route::post('pstatusChange',[PropertyamenityController::class,'statusChange'])->name('pstatusChange');
    Route::post('pmultipleAmenityDelete',[PropertyamenityController::class,'multipleAmenityDelete'])->name('pmultipleAmenityDelete');
     /* Property Categories */
    Route::get('pcamenities',[PropertycategoryController::class,'index'])->name('pcamenities');
    Route::post('pcastore',[PropertycategoryController::class,'store'])->name('pcastore');
    Route::get('pcajaxamenitylist',[PropertycategoryController::class,'index'])->name('pcajaxamenitylist');
    Route::post('pceditAmenitylist',[PropertycategoryController::class,'edit'])->name('pceditAmenitylist');
    Route::post('pcupdateAmenitylist',[PropertycategoryController::class,'update'])->name('pcupdateAmenitylist');
    Route::post('pcstatusChange',[PropertycategoryController::class,'statusChange'])->name('pcstatusChange');
    Route::post('pcmultipleAmenityDelete',[PropertycategoryController::class,'multipleAmenityDelete'])->name('pcmultipleAmenityDelete');
    /* Rooms */
    Route::get('rooms',[RoomController::class,'index'])->name('rooms');
    Route::post('rstore',[RoomController::class,'store'])->name('rstore');
    Route::get('rajaxroomlist',[RoomController::class,'index'])->name('rajaxroomlist');
    Route::post('reditRoomlist',[RoomController::class,'edit'])->name('reditRoomlist');
    Route::post('rupdateRoomlist',[RoomController::class,'update'])->name('rupdateRoomlist');
    Route::post('rstatusChange',[RoomController::class,'statusChange'])->name('rstatusChange');
    Route::post('rmultipleRoomDelete',[RoomController::class,'multipleRoomDelete'])->name('rmultipleRoomDelete');
    /* States */
    Route::get('states',[StateController::class,'index'])->name('states');
    Route::post('sstore',[StateController::class,'store'])->name('sstore');
    Route::get('sajaxstatelist',[StateController::class,'index'])->name('sajaxstatelist');
    Route::post('seditStatelist',[StateController::class,'edit'])->name('seditStatelist');
    Route::post('supdateStatelist',[StateController::class,'update'])->name('supdateStatelist');
    Route::post('sstatusChange',[StateController::class,'statusChange'])->name('sstatusChange');
    Route::post('smultipleStateDelete',[StateController::class,'multipleStateDelete'])->name('smultipleStateDelete');
     /* Cities */
    Route::get('cities',[CityController::class,'index'])->name('cities');
    Route::post('cistore',[CityController::class,'store'])->name('cistore');
    Route::get('ciajaxcitylist',[CityController::class,'index'])->name('ciajaxcitylist');
    Route::post('seditCitylist',[CityController::class,'edit'])->name('seditCitylist');
    Route::post('supdateCitylist',[CityController::class,'update'])->name('supdateCitylist');
    Route::post('cistatusChange',[CityController::class,'statusChange'])->name('cistatusChange');
    Route::post('smultipleCityDelete',[CityController::class,'multipleCityDelete'])->name('smultipleCityDelete');
});



