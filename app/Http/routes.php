<?php

use Illuminate\Http\Request;
use App\Http\Controllers;

/**
 * 主页
 */
Route::get('/', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

/**
 * 后台管理
 */
Route::group(['prefix' => 'manage', 'middleware' => ['manage']], function () {


    /**
     * 系统设置
     */
    Route::group(['prefix' => 'system'], function () {
        /**
         * 权限管理
         */
        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', 'Manage\PermissionController@index', ['as'=>'system.permission','model' => 'system', 'menu' => 'permission']);
            Route::get('/create', 'Manage\PermissionController@getCreate', ['model' => 'system', 'menu' => 'permission']);
            Route::post('/create', 'Manage\PermissionController@postCreate', ['model' => 'system', 'menu' => 'permission']);
            Route::get('/edit/{id}', 'Manage\PermissionController@getEdit', ['model' => 'system', 'menu' => 'permission']);
            Route::post('/edit', 'Manage\PermissionController@postEdit', ['model' => 'system', 'menu' => 'permission']);
            Route::get('/delete/{id}', 'Manage\PermissionController@getDelete', ['model' => 'system', 'menu' => 'permission']);
        });


        /**
         * 角色管理
         */
        Route::resource('role', 'Manage\RoleController', ['model' => 'system', 'menu' => 'role']);

        /**
         * 用户管理
         */
        Route::resource('user', 'Manage\UserController', ['model' => 'system', 'menu' => 'user']);

        /**
         * 企业信息
         */
        Route::resource('enterprise', 'Manage\EnterpriseController', ['model' => 'system', 'menu' => 'enterprise']);

    });


    /**
     * 主页
     */
    Route::get('/', function () {
        return view('manage.home');
    });

    /**
     * 业务中心
     */
    Route::group(['prefix' => 'business'], function () {

        /**
         * 主页
         */
        Route::get('/', function () {
            return view('supplier/business/index', ['model' => 'business', 'menu' => 'config']);

        });

    });
});

/**
 * 供应商管理
 */
Route::group(['prefix' => 'supplier', 'middleware' => ['supplier']], function () {


    /**
     * 主页
     */
    Route::get('/', 'Supplier\HomeController@index');

    /**
     * 业务中心
     */
    Route::group(['prefix' => 'business'], function () {

        /**
         * 主页
         */
        Route::get('/', function () {
            return view('supplier/business/index', ['model' => 'business', 'menu' => 'config']);

        });

    });

    /**
     * 客户关系
     */
    Route::group(['prefix' => 'customer'], function () {
        /**
         * 主页
         */
        Route::get('/', function () {
            return view('supplier/customer/index', ['model' => 'customer', 'menu' => 'config']);

        });


    });

    /**
     * 微信营销
     */
    Route::group(['prefix' => 'weixin'], function () {

        Route::resource('config', 'Supplier\WeixinConfigController');

        Route::get('/', function () {
            return Redirect::to('supplier/weixin/config');
        });

    });
    /**
     * 财务结算
     */
    Route::group(['prefix' => 'finance'], function () {

        /**
         * 主页
         */
        Route::get('/', function () {
            return view('supplier/finance/index', ['model' => 'finance', 'menu' => 'config']);

        });


    });

    /**
     * 资源中心
     */
    Route::group(['prefix' => 'resources'], function () {

        /**
         * 主页
         */
        Route::get('/', function () {
            return view('supplier/resources/index', ['model' => 'resources', 'menu' => 'config']);

        });


    });

    /**
     * 统计报表
     */
    Route::group(['prefix' => 'report'], function () {


        /**
         * 统计报表主页
         */
        Route::get('/', function () {
            return view('supplier/report/index', ['model' => 'report', 'menu' => 'config']);

        });


    });

    /**
     * 系统设置
     */
    Route::group(['prefix' => 'system'], function () {

        /**
         * 参数设置
         */
        Route::get('/', function () {
            return view('supplier/system/config/index', ['model' => 'system', 'menu' => 'config']);

        });


    });


    /**
     * 三方对接
     */
    Route::group(['prefix' => 'docking'], function () {

        /**
         * 参数设置
         */
        Route::get('/', function () {
            return view('supplier/docking/index', ['model' => 'docking', 'menu' => 'config']);

        });

    });

});


