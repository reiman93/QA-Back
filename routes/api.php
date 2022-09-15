<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AnalysisTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DeficiencyTypeController;
use App\Http\Controllers\JanitorController;
use App\Http\Controllers\CleaningCompanyController;
use App\Http\Controllers\TurnTypeController;
use App\Http\Controllers\RelapseActionController;
use App\Http\Controllers\PreventiveActionController;
use App\Http\Controllers\RestRoomController;
use App\Http\Controllers\PreOperationalSanitationController;

use App\Http\Controllers\RetendsCarcaseForReworkController;

use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\StateAnalisysController;
use App\Http\Controllers\SampleFormController;
use App\Http\Controllers\SampleRequestTypeController;
use App\Http\Controllers\SampleRequestFormsController;
use App\Http\Controllers\AnimalHandingAuditFormController;
use App\Http\Controllers\ChlorineNozzleInspectionController;

use App\Http\Controllers\DedicatedEquipmentAuditFormController;
use App\Http\Controllers\KillFloorPreOpSanitationSwabController;

use App\Http\Controllers\KillFloorSterilizeTempCheckController;

use App\Http\Controllers\NozzleInspectionFormController;

use App\Http\Controllers\QAHoldTagLogController;

use App\Http\Controllers\SopLogSheetSupplementalController;

use App\Http\Controllers\SlaogtherOperationalSanitationSOPLogController;

use App\Http\Controllers\QualityAssuranceKosherCheckListController;

/*RandomAuditSampleTimeController*/
use App\Http\Controllers\RandomAuditSampleTimeController;
/*
/*ReserveOutRailCarcassMonitoringLog*/
use App\Http\Controllers\ReserveOutRailCarcassMonitoringLogController;
/*SlugtherCCPPeroxyceticAcidMonitoringLogController*/
use App\Http\Controllers\SlugtherCcpProxyCeticAcidLogController;
use App\Http\Controllers\SlugtherCCPS3LacticAcidMonitoringLogController;
use App\Http\Controllers\VisualCheckSpinalCordAndSheathController;

use App\Http\Controllers\SlugtherCCPS1HACCPLogController;
/*SpinalCordAudit*/

use App\Http\Controllers\SpinalCordAuditController;
use App\Http\Controllers\SlugtherFloorGattleChangeMonitorSheetController;
use App\Http\Controllers\SlugtherFloorVisualCheckController;
use App\Http\Controllers\SlaugtherMovementLogController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*CleaningCompany routes*/

/*Route::group([
    'middleware' => ['api', 'cors'],
    'namespace' => 'api',
    'prefix' => 'api',
], function ($router) {
     //Add you routes here, for example:
     Route::post('/authenticate', [UserController::class,'authenticate'])->name('authenticate'); 
});*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 /*Route::middleware(['cors'])->group(function () {
  Route::post('/authenticate', [UserController::class,'authenticate'])->middleware('api')->name('authenticate'); 
}); */

Route::post('/authenticate', [UserController::class,'authenticate'])->middleware('api')->name('authenticate'); 

Route::post('/getUser', [UserController::class,'getUser'])->middleware('api')->name('getUser'); 

Route::post('/storeUser', [UserController::class,'paginateFilter'])->middleware('api')->name('storeUser');

Route::post('/deleteManyUser', [UserController::class,'deleteMulty'])->middleware('api')->name('deleteManyUser');

Route::post('/updateUser', [UserController::class,'updateUser'])->middleware('api')->name('updateUser'); 

Route::post('/registerUser', [UserController::class,'registerUser'])->middleware('api')->name('registerUser'); 

Route::post('/storeRol', [RolController::class,'paginateFilter'])->middleware('api')->name('storeNotification');
Route::apiResource('rol', RolController::class)->middleware('api'); 
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('notification', NotificationsController::class)->middleware('api'); 
Route::post('/storeNotification', [NotificationsController::class,'paginateFilter'])->middleware('api')->name('storeNotification');
Route::post('/getActiveNotifications', [NotificationsController::class,'getActiveNotifications'])->middleware('api')->name('getActiveNotifications');
Route::post('/deleteManyNotifications', [NotificationsController::class,'deleteMulty'])->middleware('api')->name('deleteManyNotifications');
Route::post('/checkManyNotifications', [NotificationsController::class,'markAsRead'])->middleware('api')->name('checkManyNotifications');
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('area', AreaController::class)->middleware('api'); 
Route::post('/storeArea', [AreaController::class,'paginateFilter'])->middleware('api')->name('storeArea');
Route::post('/deleteManyArea', [AreaController::class,'deleteMulty'])->middleware('api')->name('deleteManyArea');
Route::post('/updateState', [AreaController::class,'updateState'])->middleware('api')->name('updateState');
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('analysis_type', AnalysisTypeController::class)->middleware('api');
Route::post('/storeAnalysisType', [AnalysisTypeController::class,'paginateFilter'])->middleware('api')->name('storeAnalysisType');
Route::post('/deleteAnalysisType', [AnalysisTypeController::class,'deleteMulty'])->middleware('api')->name('deleteAnalysisType');
/****end****** */

/*Deparment routes*/
Route::apiResource('department', DepartmentController::class)->middleware('api');
Route::post('/storeDepartment', [DepartmentController::class,'paginateFilter'])->name('storeDepartment');
Route::post('/deleteManyDepartment', [DepartmentController::class,'deleteMulty'])->middleware('api')->name('deleteManyDepartment');
/****end****** */

/*DeficiencyType routes*/
Route::apiResource('deficiency_type',DeficiencyTypeController::class)->middleware('api');
Route::post('/storeDeficiency', [DeficiencyTypeController::class,'paginateFilter'])->name('storeDeficiency');
Route::post('/deleteManyDeficiency', [DeficiencyTypeController::class,'deleteMulty'])->middleware('api')->name('deleteManyDeficiency');
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('pre_operational', PreOperationalSanitationController::class)->middleware('api');
Route::post('/storePreOperational', [PreOperationalSanitationController::class,'paginateFilter'])->name('storePreOperational');
Route::post('/deleteManyPreOperational', [PreOperationalSanitationController::class,'deleteMulty'])->middleware('api')->name('deleteManyDepartment');
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('janitor', JanitorController::class)->middleware('api');
Route::post('/storeJanitor', [JanitorController::class,'paginateFilter'])->name('storeDepartment');
Route::post('/deleteManyJanitor', [JanitorController::class,'deleteMulty'])->middleware('api')->name('deleteManyDepartment');
/****end****** */

/*CleaningCompany routes*/
Route::apiResource('company', CleaningCompanyController::class)->middleware('api');
Route::post('/storeCompany', [CleaningCompanyController::class,'paginateFilter'])->middleware('api')->name('storeCompany');
Route::post('/deleteManyCompany', [CleaningCompanyController::class,'deleteMulty'])->middleware('api')->name('deleteManyCompany');
/****end****** */

/*RelapseAction routes*/
Route::apiResource('relapse_action', RelapseActionController::class)->middleware('api');
Route::post('/storeRelapseAction', [RelapseActionController::class,'paginateFilter'])->name('storeRelapseAction');
Route::post('/deleteManyRelapseAction', [RelapseActionController::class,'deleteMulty'])->middleware('api')->name('deleteManyRelapseAction');
/****end****** */

/*Preventive Action routes*/
Route::apiResource('preventive_action', PreventiveActionController::class)->middleware('api');
Route::post('/storePreventiveAction', [PreventiveActionController::class,'paginateFilter'])->name('storePreventiveAction');
Route::post('/deleteManyPreventiveAction', [PreventiveActionController::class,'deleteMulty'])->middleware('api')->name('deleteManyPreventiveAction');
/****end****** */

/*Type turn routes*/
Route::apiResource('turn_type', TurnTypeController::class)->middleware('api');
Route::post('/storeTurn', [TurnTypeController::class,'paginateFilter'])->name('storeTurn');
Route::post('/deleteManyTurn', [TurnTypeController::class,'deleteMulty'])->middleware('api')->name('deleteManyTurn');
/****end***/

/*LaboratoryController*/
Route::apiResource('laboratory', LaboratoryController::class)->middleware('api');
Route::post('/storeLaboratory', [LaboratoryController::class,'paginateFilter'])->name('storeLaboratory');
Route::post('/deleteManyLaboratory', [LaboratoryController::class,'deleteMulty'])->middleware('api')->name('deleteManyLaboratory');
/***end***/



/*StateAnalisysController*/
Route::apiResource('analisys_state', StateAnalisysController::class)->middleware('api');
Route::post('/storeAnalysisState', [StateAnalisysController::class,'paginateFilter'])->name('storeStateAnalisys');
Route::post('/deleteManyAnalysisState', [StateAnalisysController::class,'deleteMulty'])->middleware('api')->name('deleteManyStateAnalisys');
/***end***/


/*SampleFormController*/
Route::apiResource('sample-froms', SampleFormController::class)->middleware('api');
Route::post('/storeSampleForm', [SampleFormController::class,'paginateFilter'])->name('storeSampleForm');
Route::post('/deleteManySampleForm', [SampleFormController::class,'deleteMulty'])->middleware('api')->name('deleteManySampleForm');
/***end***/

/*SampleFormController*/
Route::apiResource('sample-request-type', SampleRequestTypeController::class)->middleware('api');
Route::post('/storeSampleRequestType', [SampleRequestTypeController::class,'paginateFilter'])->name('storeSampleRequestType');
Route::post('/deleteManySampleRequestType', [SampleRequestTypeController::class,'deleteMulty'])->middleware('api')->name('deleteManySampleRequestType');
/***end***/

/*SampleRequestFormsController*/
Route::apiResource('sample-request-forms', SampleRequestFormsController::class)->middleware('api');
Route::post('/storeSampleRequestForms', [SampleRequestFormsController::class,'paginateFilter'])->name('storeSampleSampleRequestForms');
Route::post('/deleteManySampleRequestForms', [SampleRequestFormsController::class,'deleteMulty'])->middleware('api')->name('deleteManySampleRequestForms');
/***end***/

/******************/
/******************/  /******************/
/******************/  /******************/ /******************/
                                           /******************/
/******************/  /******************/
/******************/

/*AnimalHandleAuditForm*/
Route::apiResource('animal-handing', AnimalHandingAuditFormController::class)->middleware('api');
Route::post('/storeAnimalHanding', [AnimalHandingAuditFormController::class,'paginateFilter'])->name('storeAnimalHanding');

/*ChlorineNozzleInspectionController*/
Route::apiResource('chlorine-nozzle', ChlorineNozzleInspectionController::class)->middleware('api');
Route::post('/storeChlorineNozzle', [ChlorineNozzleInspectionController::class,'paginateFilter'])->name('storeChlorineNozzle');


/*PreventiveActions routes*/
Route::apiResource('preventive_action', PreventiveActionController::class)->middleware('api');
Route::post('/storePreventiveAction', [PreventiveActionController::class,'paginateFilter'])->name('storePreventiveAction');
Route::post('/deleteManyPreventiveAction', [PreventiveActionController::class,'deleteMulty'])->middleware('api')->name('deleteManyPreventive');
/****end****** */


/****end****** */

/*NozzleInspectionFormController*/
Route::apiResource('nozzle-inspection', NozzleInspectionFormController::class)->middleware('api');
Route::post('/storeNozzleInspection', [NozzleInspectionFormController::class,'paginateFilter'])->name('storeNozzleInspection');
/****end****** */

/*QAHoldTagLogController*/
Route::apiResource('hold-tag', QAHoldTagLogController::class)->middleware('api');
Route::post('/storeHoldTag', [QAHoldTagLogController::class,'paginateFilter'])->name('storeHoldTag');
/****end****** */

/*/*QualityAssuranceKosherCheckListController*/
Route::apiResource('quality-kosher', QualityAssuranceKosherCheckListController::class)->middleware('api');
Route::post('/storeQualityKosher', [QAHoldTagLogController::class,'paginateFilter'])->name('storeQualityKosher');

/*RandomAuditSampleTime*/
Route::apiResource('random-audit', RandomAuditSampleTimeController::class)->middleware('api');
Route::post('/storeRandomAudit', [RandomAuditSampleTimeController::class,'paginateFilter'])->name('storeRandomAudit');

/*ReserveOutRailCarcassMonitoringLog*/
Route::apiResource('reserve-out', ReserveOutRailCarcassMonitoringLogController::class)->middleware('api');
Route::post('/storeReserveOut', [ReserveOutRailCarcassMonitoringLogController::class,'paginateFilter'])->name('storeReserveOut');


/*ReserveOutRailCarcassMonitoringLog*/
Route::apiResource('rest-room', RestRoomController::class)->middleware('api');
Route::post('/storeRestRoom', [RestRoomController::class,'paginateFilter'])->name('storeRestRoom');


/*SlaogtherOperationalSanitationSOPLogController*/
Route::apiResource('sop-log', SlaogtherOperationalSanitationSOPLogController::class)->middleware('api');
Route::post('/storeSopLog', [SlaogtherOperationalSanitationSOPLogController::class,'paginateFilter'])->name('storeSopLog');
Route::post('/deleteManySopLog');



/*SlugtherCCPS3LacticAcidMonitoringLogController*/
Route::apiResource('ccp-lactic', SlugtherCCPS3LacticAcidMonitoringLogController::class)->middleware('api');
Route::post('/storeCcpLactic', [SlugtherCCPS3LacticAcidMonitoringLogController::class,'paginateFilter'])->name('storeCcpLactic');


/*SlugtherFloorGattleChangeMonitorSheetController*/
Route::apiResource('slaugther-floor-gattle', SlugtherFloorGattleChangeMonitorSheetController::class)->middleware('api');
Route::post('/storeSlaugtherFloorGattle', [SlugtherFloorGattleChangeMonitorSheetController::class,'paginateFilter'])->name('storeSlaugtherFloorGattle');



/*SpinalCordAuditController*/
Route::apiResource('spinal-cord-audit', SpinalCordAuditController::class)->middleware('api');
Route::post('/storeSpinalCordAudit', [SpinalCordAuditController::class,'paginateFilter'])->name('storeSpinalCordAudit');
Route::post('/deleteManySpinalCordAudit');

/*listo*/
/*VisualCheckSpinalCordAndSheathController*/
Route::apiResource('visual-spinal-cord', VisualCheckSpinalCordAndSheathController::class)->middleware('api');
Route::post('/storeVisualSpinalCord', [VisualCheckSpinalCordAndSheathController::class,'paginateFilter'])->name('storeVisualSpinalCord');


Route::apiResource('ccp-peroaxycetic', SlugtherCcpProxyCeticAcidLogController::class)->middleware('api');
Route::post('/storeSCCPeroxicetic', [SlugtherCcpProxyCeticAcidLogController::class,'paginateFilter'])->name('SCCPeroxicetic');
Route::post('/deleteSCCPeroxicetic');

/*SlugtherCCPS1HACCPLogController*/
Route::apiResource('ccp-s1haccp', SlugtherCCPS1HACCPLogController::class)->middleware('api');
Route::post('/storeSlugtherCCPS1HACCPLog', [SlugtherCCPS1HACCPLogController::class,'paginateFilter'])->name('SlugtherCCPS1HACCPLog');

Route::apiResource('sop-suplements', SopLogSheetSupplementalController::class)->middleware('api');
Route::post('/storeSOPLogSSP', [SopLogSheetSupplementalController::class,'paginateFilter'])->name('SOPLogSSP');

/******************/  /******************/
/******************/  /******************/ /******************/
/**********************POR HACER*****************************/
/******************/  /******************/
/*DedicatedEquipmentAuditFormController routes*/
Route::apiResource('equipment-audit', DedicatedEquipmentAuditFormController::class)->middleware('api');
Route::post('/storeEquipmentAudit', [DedicatedEquipmentAuditFormController::class,'paginateFilter'])->name('storeEquipmentAudit');/****end****** */
/*SlaogtherOperationalSanitationSOPLogSheetSupplementalController*/




/*RetendsCarcaseForReworkController*/
Route::apiResource('carcase-for-rework', RetendsCarcaseForReworkController::class)->middleware('api');
Route::post('/storeCarcaseForRework', [RetendsCarcaseForReworkController::class,'paginateFilter'])->name('storeCarcaseForRework');
Route::post('/deleteManyCarcaseForRework', [RetendsCarcaseForReworkController::class,'deleteMulty'])->middleware('api')->name('/deleteManyCarcaseForRework');



/*KillFloorPreOpSanitationSwabController*/
Route::apiResource('kill-floor-swab', KillFloorPreOpSanitationSwabController::class)->middleware('api');
Route::post('/storeKillFloorSwab', [KillFloorPreOpSanitationSwabController::class,'paginateFilter'])->name('/storeKillFloorSwab');
Route::post('/deleteManyKillFloorSwab', [KillFloorPreOpSanitationSwabController::class,'deleteMulty'])->middleware('api')->name('/deleteManyKillFloorSwab');
/****end****** */

/*KillFloorSterilizeTempChecksController*/
Route::apiResource('kill-floor-temp', KillFloorSterilizeTempCheckController::class)->middleware('api');
Route::post('/storeKillFlooTemp', [KillFloorSterilizeTempCheckController::class,'paginateFilter'])->name('storeKillFlooTemp');
Route::post('/deleteManyKillFlooTemp', [KillFloorSterilizeTempCheckController::class,'deleteMulty'])->middleware('api')->name('deleteManyKillFlooTemp');

/*SlugtherFloorVisualCheckController*/
Route::apiResource('slaugther-visual-floor', SlugtherFloorVisualCheckController::class)->middleware('api');
Route::post('/storeSlagutherVisual', [SlugtherFloorVisualCheckController::class,'paginateFilter'])->name('storeSlagutherVisual');
Route::post('/deleteManySlagutherVisual', [SlugtherFloorVisualCheckController::class,'deleteMulty'])->middleware('api')->name('deleteManySlagutherVisual');


Route::apiResource('slaugther-movement-log', SlaugtherMovementLogController::class)->middleware('api');
Route::post('/storeSlagutherMovement', [SlaugtherMovementLogController::class,'paginateFilter'])->name('storeSlagutherMovement');
Route::post('/deleteManySlagutherMovement', [SlaugtherMovementLogController::class,'deleteMulty'])->middleware('api')->name('deleteManySlagutherMovement');

/*Falta cleaning papper towel*/
