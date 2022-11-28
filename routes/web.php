<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::group(['middleware' => ['web', 'auth', 'roles']],function(){
//     Route::group(['roles'=>'Admin'],function(){
//      Route::get('admin', 'AdminController@index');
//     });
//     Route::group(['middleware' => ['web', 'auth', 'roles']],function(){
//         Route::group(['roles'=>'Employee'],function(){
//          Route::resource('employee', 'EmployeeController');
//         });
Route::get('home', 'HomeController@index')->name('home');
// Route::get('/employee_home','HomeController@employee')->name('employee')->middleware('employee');
// Route::get('/leader_home', 'HomeController@leader')->name('leader')->middleware('leader');

//PROFILE
Route::get('change_password', 'ProfileController@change_password')->name('cp');
// Route::get('employee_changepassword', 'ProfileController@passwordemployee')->name('emp_cp');
// Route::get('leader_changepassword', 'ProfileController@passwordleader')->name('lead_cp');
Route::post('change_password', 'ProfileController@updatePassword')->name('change.password');
Route::get('edit_profile','ProfileController@edit_profile')->name('ep');
// Route::get('/employee_editprofile','ProfileController@profilemployee')->name('emp_ep');
// Route::get('/leader_editprofile','ProfileController@profilleader')->name('lead_ep');
Route::post('edit_profile','ProfileController@editprofil')->name('edit.profil');
// Route::get('/home', 'HomeController@index')->name('home');


//Department
Route::view('department', 'departments')->name('dept');
//department crud
Route::resource('crud_department', 'DepartmentController');
Route::post('crud_department/update', 'DepartmentController@update')->name('crud_department.update');
Route::get('crud_department/destroy/{id}', 'DepartmentController@destroy');
//Position
Route::view('position', 'positions')->name('post');
//position crud
Route::resource('crud_position', 'PositionController');
Route::post('crud_position/update', 'PositionController@update')->name('crud_position.update');
Route::get('crud_position/destroy/{id}', 'PositionController@destroy');;
//Leader
Route::view('leader', 'leaders')->name('lead');
//leader crud
Route::resource('crud_leader', 'LeaderController');
Route::post('crud_leader/update', 'LeaderController@update')->name('crud_leader.update');
Route::get('crud_leader/destroy/{id}', 'LeaderController@destroy');
//ROLE
Route::view('role', 'roles')->name('role');
//role crud
Route::resource('crud_role', 'RoleController');
Route::post('crud_role/update', 'RoleController@update')->name('crud_role.update');
Route::get('crud_role/destroy/{id}', 'RoleController@destroy');
//CLASSIFICATION
Route::view('classification', 'classifications')->name('class');
//classification
Route::resource('crud_classification', 'ClassificationController');
Route::post('crud_classification/update', 'ClassificationController@update')->name('crud_classification.update');
Route::get('crud_classification/destroy/{id}', 'ClassificationController@destroy');
//EQUIPMENT
Route::view('equipment', 'equipment')->name('equip');
//equipment crud
Route::resource('crud_equipment', 'EquipmentController');
Route::post('crud_equipment/update', 'EquipmentController@update')->name('crud_equipment.update');
Route::get('crud_equipment/destroy/{id}', 'EquipmentController@destroy');
//EFFICIENCY
Route::view('efficiency', 'efficiencies')->name('effi');
//efficiency crud
Route::resource('crud_efficiency', 'EfficiencyController');
Route::post('crud_efficiency/update', 'EfficiencyController@update')->name('crud_efficiency.update');
Route::get('crud_efficiency/destroy/{id}', 'EfficiencyController@destroy');
//COMPETENCY
Route::view('competency', 'competencies')->name('comp');
//competency crud
Route::resource('crud_competency', 'CompetencyController');
Route::post('crud_competency/update', 'CompetencyController@update')->name('crud_competency.update');
Route::get('crud_competency/destroy/{id}', 'CompetencyController@destroy');

// USER ACCOUNT
Route::get('account', 'AccountController@index')->name('account');
//UA crud
Route::resource('crud_account', 'AccountController');
Route::post('crud_account/update', 'AccountController@update')->name('crud_account.update');
Route::get('crud_account/destroy/{id}', 'AccountController@destroy');

// ACTIVITY
Route::view('activity', 'activities')->name('act');
// Route::get('/employee_activity', 'ActivityController@employee_act')->name('e_act');
//activity crud
Route::resource('crud_activity', 'ActivityController');
Route::get('add_activity', 'ActivityController@create')->name('add_act');
Route::post('store_activity', 'ActivityController@store')->name('store_act');
Route::get('crud_activity/view/{id}', 'ActivityController@show')->name('view_act');
Route::get('crud_activity/edit/{id}', 'ActivityController@edit')->name('edit_act');
Route::post('crud_activity/update', 'ActivityController@update')->name('update_act');
Route::get('crud_activity/destroy/{id}', 'ActivityController@destroy');
//CKEDITOR
Route::post('description_image/upload', 'ActivityController@upload_desc')->name('desc_img');
Route::post('report_image/upload', 'ActivityController@upload_rprt')->name('rprt_img');

//ACTIVITY REPORT
Route::view('activity_report', 'activity_reports')->name('actr');
// Route::get('/leader_activity_report', 'ActivityReportController@leader_act_r')->name('l_actr');
//AR crud
Route::resource('crud_activity_report', 'ActivityReportController');
Route::get('crud_activity_report/view/{id}', 'ActivityReportController@show')->name('view_actr');
Route::get('crud_activity_report/edit/{id}', 'ActivityReportController@edit')->name('edit_actr');
Route::post('crud_activity_report/update', 'ActivityReportController@update')->name('update_actr');
Route::get('crud_activity_report/destroy/{id}', 'ActivityReportController@destroy');

//RESULT
Route::get('result', 'ResultController@index')->name('rslt');
Route::resource('crud_result', 'ResultController');
Route::get('crud_result/view/{id}', 'ResultController@show')->name('view_rslt');
// Route::get('/leader_result', 'ResultController@leader_rslt')->name('l_rslt');




