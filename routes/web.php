<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\QualityAnalystController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\JanitorController;
use App\Http\Controllers\CleaningCompanyController;
use App\Http\Controllers\TurnTypeController;
use App\Http\Controllers\PreOperationalSanitationController;

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
/*General routes*/
Route::get('/', function () { //accediendo a traves de vistas
    return view('loguin');
});
Route::get('/logout', function () { //accediendo a traves de vistas
    return view('loguin');
})->name('logout');
Route::get('/home', function () { //accediendo a traves de vistas
    return view('home');
})->name('home');
Route::post('/auth', [GeneralController::class,'authenticate'])->name('auth');
/****end****** */
/*Area routes*/
Route::resource('area', AreaController::class);
Route::post('/storeArea', [AreaController::class,'paginateAreaFilter'])->name('storeArea');
/****end****** */
/*Deparment routes*/
Route::resource('department', DepartmentController::class);
Route::post('/storeDepartment', [DepartmentController::class,'paginateDepartmentFilter'])->name('storeDepartment');
/****end****** */
/*Quality analist routes*/
Route::resource('qualityAnalyst', QualityAnalystController::class);
Route::post('/storeQualityAnalyst', [QualityAnalystController::class,'paginateQualityAnalystFilter'])->name('storeQualityAnalyst');
/****end****** */
/*Janitor routes*/
Route::resource('janitor', JanitorController::class);
Route::post('/storeJanitor', [JanitorController::class,'paginateJanitorFilter'])->name('storeJanitor');
/****end****** */
/*cleaningCompany routes*/
Route::resource('cleaningCompany', CleaningCompanyController::class);
Route::post('/storeCleaningCompany', [JanitorController::class,'paginateClieningCompanyFilter'])->name('storeCleaningCompany');
/****end****** */
/*TurnType routes*/
Route::resource('turnType', TurnTypeController::class);
Route::post('/storeTurnType', [JanitorController::class,'paginateTurnTypeFilter'])->name('storeTurnType');
/****end****** */
/* PreOperationalSanitation routes*/
Route::resource('preOperSani', PreOperationalSanitationController::class);
Route::post('/storePreOperSani', [PreOperationalSanitationController::class,'paginatePreOperSaniFilter'])->name('storePreOperSani');
/****end****** */


