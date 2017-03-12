<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 * Welcome Page Route.
 */
Route::get('/', [
    'uses' => 'HomeController@getWelcomePage',
    'as'   => 'page.welcome'
]);

/*
 * Privacy  policies page
 */
Route::get('privacy-policies', 'PoliciesController@index')->name('policies');

/*
 * Authentication Route.
 */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Verify User Account Route.
 */
Route::get('verify-user-account/{verificationToken}', [
    'uses' => 'AccountVerificationController@getVerifiedToken',
    'as'   => 'actions.verify-user-account'
]);

/*
 * Project's routes
 */
Route::resource('projects', 'ProjectController');

/*
 * work items' route
 */
Route::resource('projects/{project_id}/work-items', 'WorkItemController');

Route::get('search-user-of-project/{project}', 'ProjectController@searchUser')->name('searchUserForProject');
/*
 * route to search for parent work item
 * controller work ite
 */
Route::get('search-parent-work-item/{project}', 'WorkItemController@autoCompleteWorkItemsSearch')->name('searchParentWorkItem');