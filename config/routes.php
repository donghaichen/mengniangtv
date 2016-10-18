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
Route::get('test/sql','Test\SqlController@testSql');
Route::get('curl', 'HomeController@testCurlPage');
Route::post('curl', 'HomeController@testCurlPage');
Route::any('test/code/{id?}', 'CodeController@send');
Route::get('view', 'HomeController@view');
Route::get('api/sms', 'ApiController@sendSms');
