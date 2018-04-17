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

// 后台首页
Route::any('/', 'IndexController@home');

// 终端信息
Route::group(['prefix' => 'userList'], function () {
	Route::any('/', 'IndexController@userList');
	// 终端删除
	Route::any('/getLogout', 'IndexController@getLogout');
	Route::any('/getUserListLogout', 'IndexController@getUserListLogout');
	// 终端信息刷新
	Route::any('/userListRefresh', 'IndexController@userListRefresh');
});


// 系统配置
Route::group(['prefix' => 'system'], function () {
	Route::any('/', 'IndexController@system');
	// 修改数据镜像接口
	Route::any('/mirror', 'IndexController@mirror');
	// 修改数据发送接口
	Route::any('/mirrorPost', 'IndexController@mirrorPost');
	// 添加radius
	Route::any('/radius', 'IndexController@radius');
	// 修改radius
	Route::any('/radiusEdit', 'IndexController@radiusEdit');
	// 删除radius
	Route::any('/radiusDelete/{id}', 'IndexController@radiusDelete');
	// 添加Portal
	Route::any('/portal', 'IndexController@portal');
	// 修改Portal
	Route::any('/portalEdit', 'IndexController@portalEdit');
	// 删除Portal
	Route::any('/portalDelete/{id}', 'IndexController@portalDelete');
	// 修改hotspot-profile
	Route::any('/hotspotProfile', 'IndexController@hotspotProfile');
	// 添加服务器白名单
	Route::any('/servers', 'IndexController@servers');
	// 修改服务器白名单
	Route::any('/serversEdit', 'IndexController@serversEdit');
	// 删除服务器白名单
	Route::any('/serversDelete/{id}', 'IndexController@serversDelete');
	// 添加终端白名单
	Route::any('/clients', 'IndexController@clients');
	// 修改终端白名单
	Route::any('/clientsEdit', 'IndexController@clientsEdit');
	// 删除终端白名单
	Route::any('/clientsDelete/{id}', 'IndexController@clientsDelete');
	// 添加网络黑名单
	Route::any('/blackList', 'IndexController@blackList');
	// 修改网络黑名单
	Route::any('/blackListEdit', 'IndexController@blackListEdit');
	// 删除网络黑名单
	Route::any('/blackListDelete/{id}', 'IndexController@blackListDelete');
	// 提交
	Route::any('/systemSubmit', 'IndexController@systemSubmit');
	Route::any('/systemConfigSubmit', 'IndexController@systemConfigSubmit');
	// 系统配置刷新
	Route::any('/systemConfigRefresh', 'IndexController@systemConfigRefresh');
});
