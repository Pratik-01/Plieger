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

Auth::routes();

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('home');

// end of front end routing.

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/detail', 'Admin\AdminController@detail')->name('admin.detail');
    Route::get('/update', 'Admin\AdminController@update')->name('admin.update');
    Route::get('/changepassrq', 'Admin\AdminController@changepassrq')->name('admin.changepassrq');
    Route::get('/changepass', 'Admin\AdminController@changepass')->name('admin.changepass');
    
    
    //Team
Route::get('team','Admin\TeamController@index')->name('admin.team');
Route::post('/team/store','Admin\TeamController@store')->name('team.store');
Route::get('/team/{team}/edit','Admin\TeamController@edit')->name('team.edit');
Route::post('/team/update','Admin\TeamController@update')->name('team.update');
Route::get('/team/delete/{team}','Admin\TeamController@delete')->name('team.delete');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
Route::get('/team/view/{team}','Admin\TeamController@view')->name('team.view');
//end of Team

//Member
Route::get('member','Admin\MemberController@index')->name('admin.member');
Route::get('/member/getallteams','Admin\MemberController@getallteams')->name('member.getallteams');
Route::post('/member/store','Admin\MemberController@store')->name('member.store');
Route::get('/member/{member}/edit','Admin\MemberController@edit')->name('member.edit');
Route::post('/member/update','Admin\MemberController@update')->name('member.update');
Route::get('/member/delete/{member}','Admin\MemberController@delete')->name('member.delete');
Route::get('/member/{member}','Admin\MemberController@view')->name('member.view');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
//End of Member

//task
Route::get('task','Admin\TaskController@index')->name('admin.task');
Route::get('/task/getallmembers','Admin\TaskController@getallmembers')->name('task.getallmembers');
Route::post('/task/store','Admin\TaskController@store')->name('task.store');
Route::get('/task/{task}/edit','Admin\TaskController@edit')->name('task.edit');
Route::post('/task/update','Admin\TaskController@update')->name('task.update');
Route::get('/task/delete/{task}','Admin\TaskController@delete')->name('task.delete');
Route::get('/task/{task}','Admin\TaskController@view')->name('task.view');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
Route::post('/task/search','Admin\TaskController@search')->name('task.search');
//end of Task

//ReviewPending
Route::get('reviewpending','Admin\ReviewPendingController@index')->name('admin.reviewpending');
Route::get('/pending/{pending}/edit','Admin\ReviewPendingController@edit')->name('pending.edit');
Route::post('/pending/update','Admin\ReviewPendingController@update')->name('pending.update');
Route::get('/pending/finish/{pending}','Admin\ReviewPendingController@finish')->name('pending.finish');
Route::get('/pending/{view}','Admin\ReviewPendingController@view')->name('pending.view');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');

//end of reviewpending

//Review
Route::get('review','Admin\ReviewController@index')->name('admin.review');
Route::get('finish','Admin\ReviewController@finish')->name('admin.finish');
Route::get('/finish/{finish}/edit','Admin\ReviewController@edit')->name('finish.edit');
Route::post('/finish/update','Admin\ReviewController@update')->name('finish.update');
Route::get('/finish/upload/{finish}','Admin\ReviewController@upload')->name('finish.upload');
Route::get('upload','Admin\ReviewController@uploadtask')->name('admin.upload');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
//End of Review

//Issue
Route::get('issue','Admin\IssueController@index')->name('admin.issue');
Route::get('/issue/reassign/{issue}','Admin\IssueController@issue')->name('issue.reassign');
Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
//End of Issue
});

//Member
Route::get('/dashboard', 'Member\UserController@index')->name('member.dashboard');
Route::get('/task','Member\TaskController@index')->name('member.task');
Route::get('/task/{task}/edit','Member\TaskController@edit')->name('member.edit');
Route::post('/task/update','Member\TaskController@update')->name('member.update');
Route::get('/task/done/{task}','Member\TaskController@done')->name('member.done');
Route::get('/review','Member\TaskController@review')->name('member.review');
Route::get('/task/reviewed/{task}','Member\TaskController@reviewed')->name('member.reviewed');
Route::get('/review/{review}/edit','Member\TaskController@issueedit')->name('member.issueedit');
Route::post('/review/update','Member\TaskController@issueupdate')->name('member.issueupdate');
Route::get('member/detail', 'Member\UserController@detail')->name('member.detail');
Route::get('member/update', 'Member\UserController@update')->name('member.update');
Route::post('/task/search','Member\TaskController@search')->name('member.task.search');

Route::get('member/changepassrq', 'Member\UserController@changepassrq')->name('member.changepassrq');
Route::get('member/changepass', 'Member\UserController@changepass')->name('member.changepass');


Route::get('RedirectDemoController', 'RedirectDemoController@index')->name('RedirectDemoController');

Route::get('/team/view/{team}','Admin\TeamController@view')->name('team.view');
//Member

//TEAM LEADER
Route::prefix('teamleader')->group(function () {

Route::get('/dashboard','TeamLeader\UserController@index')->name('teamleader.dashboard');
Route::get('/detail', 'TeamLeader\UserController@detail')->name('teamleader.detail');
Route::get('/update', 'TeamLeader\UserController@update')->name('teamleader.update');
Route::get('/changepassrq', 'TeamLeader\UserController@changepassrq')->name('teamleader.changepassrq');
Route::get('/changepass', 'TeamLeader\UserController@changepass')->name('teamleader.changepass');

//ReviewPending
Route::get('reviewpending','TeamLeader\ReviewPendingController@index')->name('teamleader.reviewpending');
Route::get('/pending/{pending}/edit','TeamLeader\ReviewPendingController@edit')->name('teamleader.edit');
Route::post('/pending/update','TeamLeader\ReviewPendingController@update')->name('teamleader.update');
Route::get('/pending/finish/{pending}','TeamLeader\ReviewPendingController@finish')->name('teamleader.finish');
Route::get('/pending/{view}','TeamLeader\ReviewPendingController@view')->name('teamleader.view');
Route::get('/abort','TeamLeader\TeamController@abort')->name('teamleader.abort');

//end of reviewpending
});

//END OF TEAM LEADER



















