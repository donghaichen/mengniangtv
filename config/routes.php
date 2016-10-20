<?php
/**
 * 路由配置
 * User: donghai
 * Date: 16/2/17
 * Time: 下午9:57
 */
use Clovers\Route\Route;
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');
Route::get('user/{id}/comment/{comment_id}', function($id){
    var_dump($id);
});
Route::get('user/{id}/', 'UserController@show');
Route::get('category/{id}/', 'CategoryController@show');
Route::get('curl', 'HomeController@testCurlPage');
Route::post('curl', 'HomeController@testCurlPage');
Route::get('test', 'TestController@index');
Route::get('test/view', 'TestController@view');
Route::get('test/view_whitout', 'TestController@viewWithout');
Route::get('test/sql','TestController@testSql');
Route::get('test/request/{id}/{name}','TestController@request');
Route::get('view', 'HomeController@view');
Route::get('api/sms', 'ApiController@sendSms');
