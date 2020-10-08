<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//PLANS
Route::get('/plans', 'PlansController@index'); 

Route::get('/plans/{pln_id}', 'PlansController@show');

Route::post('/plans', 'PlansController@store');

Route::put('/plans/{pln_id}', 'PlansController@update');

Route::delete('/plans/{pln_id}', 'PlansController@destroy');

//PLAN-CATEGORIES
Route::get('/plan-categories', 'PlanCategoriesController@index');

Route::get('/plan-categories/{id}', 'PlanCategoriesController@show');

Route::post('/plan-categories', 'PlanCategoriesController@store');

Route::put('/plan-categories/{id}', 'PlanCategoriesController@update');

Route::delete('/plan-categories/{id}', 'PlanCategoriesController@destroy');

//PLAN-DOCUMENTS
Route::get('/plan-documents', 'PlanDocumentsController@index');

Route::get('/plan-documents/{id}', 'PlanDocumentsController@show');

Route::post('/plan-documents', 'PlanDocumentsController@store');

Route::put('/plan-documents/{id}', 'PlanDocumentsController@update');

Route::delete('/plan-documents/{id}', 'PlanDocumentsController@destroy');

//PLAN-FILES
Route::get('/plan-files', 'PlanFilesController@index');

Route::get('/plan-files/{id}', 'PlanFilesController@show');

Route::post('/plan-files', 'PlanFilesController@store');

Route::put('/plan-files/{id}', 'PlanFilesController@update');

Route::delete('/plan-files/{id}', 'PlanFilesController@destroy');

//PLAN-GROUPS
Route::get('/plan-groups', 'PlanGroupsController@index');

Route::get('/plan-groups/{id}', 'PlanGroupsController@show');

Route::post('/plan-groups', 'PlanGroupsController@store');

Route::put('/plan-groups/{id}', 'PlanGroupsController@update');

Route::delete('/plan-groups/{id}', 'PlanGroupsController@destroy');

//PLAN-MILESTONES
Route::get('/plan-milestones', 'PlanMilestonesController@index');

Route::get('/plan-milestones/{id}', 'PlanMilestonesController@show');

Route::post('/plan-milestones', 'PlanMilestonesController@store');

Route::put('/plan-milestones/{id}', 'PlanMilestonesController@update');

Route::delete('/plan-milestones/{id}', 'PlanMilestonesController@destroy');

//PLAN-MILESTONE-DOCUMENTS
Route::get('/milestone-documents', 'PlanMilestoneDocumentsController@index');

Route::get('/milestone-documents/{id}', 'PlanMilestoneDocumentsController@show');

Route::post('/milestone-documents', 'PlanMilestoneDocumentsController@store');

Route::put('/milestone-documents/{id}', 'PlanMilestoneDocumentsController@update');

Route::delete('/milestone-documents/{id}', 'PlanMilestoneDocumentsController@destroy');

//PLAN-MILESTONES-FILES
Route::get('/milestone-files', 'PlanMilestonesFilesController@index');

Route::get('/milestone-files/{id}', 'PlanMilestonesFilesController@show');

Route::post('/milestone-files', 'PlanMilestonesFilesController@store');

Route::put('/milestone-files/{id}', 'PlanMilestonesFilesController@update');

Route::delete('/milestone-files/{id}', 'PlanMilestonesFilesController@destroy');

//PLAN-MILESTONES-TASKS
Route::get('/milestone-tasks', 'PlanMilestonesTasksController@index');

Route::get('/milestone-tasks/{id}', 'PlanMilestonesTasksController@show');

Route::post('/milestone-tasks', 'PlanMilestonesTasksController@store');

Route::put('/milestone-tasks/{id}', 'PlanMilestonesTasksController@update');

Route::delete('/milestone-tasks/{id}', 'PlanMilestonesTasksController@destroy');

//EBR-GROUPS
Route::get('/ebr-groups', 'EbrGroupsController@index');

Route::get('/ebr-groups/{id}', 'EbrGroupsController@show');

Route::post('/ebr-groups', 'EbrGroupsController@store');

Route::put('/ebr-groups/{id}', 'EbrGroupsController@update');

Route::delete('/ebr-groups/{id}', 'EbrGroupsController@destroy');