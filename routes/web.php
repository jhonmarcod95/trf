<?php
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

Route::post('logout', function(){
    return redirect('/');
  });
Route::get('/', function () {
    return view('welcome');
});
Route::get('/reports','RequestController@bookedHistoryOutside');
Auth::routes();
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/sign-up', 'AccountController@sign_up');
Route::post('/sign-up', 'AccountController@save_sign_up');
Route::get('/show-pdf/{id}', 'RequestController@pdf');
Route::group( ['middleware' => 'auth'], function()
{
//Account
Route::get('/inbox', 'AccountController@login');
Route::get('/show', 'AccountController@show');
Route::get('/change-password', 'AccountController@change_password');
Route::post('/inbox', 'AccountController@show');
Route::post('/change-password', 'AccountController@save_change_password');
Route::get('/approved', 'RequestController@approved');
Route::get('/cancelled-request', 'RequestController@cancelled_request');
Route::post('/new-request', 'RequestController@new_form');
Route::get('/new-request', 'RequestController@login');
Route::post('/save-new-request', 'RequestController@save_new_request');
Route::get('/pending-request', 'RequestController@pending_list');
// Route::get('/show-pdf/{id}', 'RequestController@pdf');
Route::get('/pending-request', 'RequestController@pending_list');
// Route::get('/edit-request/{id}', 'RequestController@edit_request');
// Route::post('/edit-request/{id}', 'RequestController@save_edit_request');
Route::post('/save-edit-profile', 'AccountController@save_edit_profile');
Route::get('/cancel-request/{id}', 'RequestController@cancel_request');
Route::get('/user-account', 'AccountController@view_account');
Route::post('/cancel-request/{id}', 'RequestController@save_cancel_request');
Route::post('approve-request/{requestID}','RequestController@approveRequest');
Route::group( ['middleware' => ['user']], function()
{

}
);
Route::group( ['middleware' => ['approver']], function()
{
Route::get('/for-approval', 'RequestController@for_approval');
Route::post('/for-approval', 'RequestController@save_for_approval');
Route::get('/approve-request/{id}', 'RequestController@approve_request');
Route::get('/disapprove-request/{id}', 'RequestController@disapprove_request');
Route::post('/disapprove-request/{id}', 'RequestController@save_disapprove_request');
Route::get('/approved-history', 'RequestController@approved_history');
Route::get('/disapproved-history', 'RequestController@disapproved_history');
}
);
Route::group( ['middleware' => 'admin'], function()
{
//Destination
Route::get('/destination-list', 'DestinationController@destination_list');
Route::get('/new-destination', 'DestinationController@new_destination');
Route::post('/new-destination', 'DestinationController@save_new_destination');
Route::get('/edit-destination/{id}', 'DestinationController@edit_destination');
Route::post('/edit-destination/{id}', 'DestinationController@save_edit_destination');

//Company
Route::get('/company-list', 'CompanyController@company_list');
Route::get('/new-company', 'CompanyController@new_company');
Route::post('/new-company', 'CompanyController@save_new_company');
Route::get('/edit-company/{id}', 'CompanyController@edit_company');
Route::post('/edit-company/{id}', 'CompanyController@save_edit_company');

//Accounts
Route::get('/deactivate-account/{id}', 'AccountController@deactivate_account');
Route::get('/activate-account/{id}', 'AccountController@activate_account');
Route::get('/reset-account/{id}', 'AccountController@reset_account');
Route::get('/edit-account/{id}', 'AccountController@edit_account');
Route::post('/edit-account/{id}', 'AccountController@save_edit_account');
Route::get('/new-account', 'AccountController@new_account');
Route::post('/new-account', 'AccountController@save_new_account');
Route::get('/employee-list', 'AccountController@employee_list');
Route::get('/request', 'RequestController@request');
});
Route::post('/reference/{requestID}', 'RequestController@reference');
Route::get('/booked-request', 'RequestController@bookedRequest');
Route::get('/booked-history', 'RequestController@bookedHistory');

});