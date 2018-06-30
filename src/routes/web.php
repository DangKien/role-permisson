<?php
	Route::group(['prefix' => 'admin', 'middleware' => 'web'], function() {
	    Route::resource('roles', 'DangKien\RolePer\Controllers\RoleController');

	    Route::resource('permissions', 'DangKien\RolePer\Controllers\PermissionController');

	    Route::resource('permissions-group', 'DangKien\RolePer\Controllers\PermissionGroupController');

	    Route::get('user-permission/{id}', 'DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
	    Route::post('user-permission/{id}', 'DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');

	    Route::get('user-permission/{id}', 'DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
	    Route::post('user-permission/{id}', 'DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
	});