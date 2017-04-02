<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

require app_path() . '/routes-func.php';
$req_path = Request::path();

if (preg_match('/\/$/', $req_path)) {
    Route::get('/', 'HomeController@index');
}

$route_conf = Config::get('route');

$prefix = 'api/';

if (routeLoad($prefix . 'shopsettings', $req_path, $route_conf)) {
    Route::resource($prefix . 'shopsettings', 'ShopSettingsController');
}

if (routeLoad($prefix . 'banners', $req_path, $route_conf)) {
    Route::resource($prefix . 'banners', 'BannersController');
}

if (routeLoad($prefix . 'blockwords', $req_path, $route_conf)) {
    Route::resource($prefix . 'blockwords', 'BlockwordsController');
}

if (routeLoad($prefix . 'categories', $req_path, $route_conf)) {
    Route::resource($prefix . 'categories', 'CategoriesController');
}

if (routeLoad($prefix . 'images', $req_path, $route_conf)) {
    Route::get($prefix . 'images/clear', 'ImagesController@clear');
    Route::resource($prefix . 'images', 'ImagesController');
}

if (routeLoad($prefix . 'members', $req_path, $route_conf)) {
    Route::resource($prefix . 'members', 'MembersController');
}

if (routeLoad($prefix . 'navigations', $req_path, $route_conf)) {
    Route::resource($prefix . 'navigations', 'NavigationsController');
}

if (routeLoad($prefix . 'layouts', $req_path, $route_conf)) {
    Route::resource($prefix . 'layouts', 'LayoutsController');
}

if (routeLoad($prefix . 'products', $req_path, $route_conf)) {
    Route::resource($prefix . 'products', 'ProductsController');
    Route::get($prefix . 'products/update/stat', 'ProductsController@updateStat');
}

if (routeLoad($prefix . 'news', $req_path, $route_conf)) {
    Route::resource($prefix . 'news', 'NewsController');
    Route::get($prefix . 'news/update/stat', 'NewsController@updateStat');
}

if (routeLoad($prefix . 'pages', $req_path, $route_conf)) {
    Route::resource($prefix . 'pages', 'PagesController');
    Route::get($prefix . 'pages/update/stat', 'PagesController@updateStat');
}

if (routeLoad($prefix . 'tags', $req_path, $route_conf)) {
    Route::get($prefix . 'tags/search', 'TagsController@search');
    Route::resource($prefix . 'tags', 'TagsController');
}

if (routeLoad($prefix . 'contacts', $req_path, $route_conf)) {
    Route::resource($prefix . 'contacts', 'ContactsController');
}

if (routeLoad($prefix . 'comments', $req_path, $route_conf)) {
    Route::get($prefix . 'comments/blockwords', 'CommentsController@blockwords');
    Route::get($prefix . 'comments/genblockwords', 'CommentsController@genblockwords');
    Route::resource($prefix . 'comments', 'CommentsController');
}

if (routeLoad($prefix . 'users', $req_path, $route_conf)) {
    Route::resource($prefix . 'users', 'UsersController');
}

if (routeLoad($prefix . 'clear', $req_path, $route_conf)) {
    Route::get($prefix . 'clear/cache', 'CacheController@clearCache');
}

if (routeLoad($prefix . 'quotes', $req_path, $route_conf)) {
    Route::resource($prefix . 'quotes', 'QuotesController');
}

if (preg_match('/^api$/', $req_path)) {
    Route::resource($prefix . '/', 'HomeController');
}
