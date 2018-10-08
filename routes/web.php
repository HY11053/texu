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
Auth::routes();
Route::get('/home', 'HomeController@index');
//前台界面
Route::group(['domain' => 'm.xiuxianshipin.net'], function () {
    Route::get('/','Mobile\IndexController@Index');
    Route::get('news/{id}','Mobile\ArticleController@NewsArticle')->where('id', '[0-9]+')->name('news');
    Route::get('brand/{id}','Mobile\ArticleController@BrandArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/company.html','Mobile\ArticleController@BrandCompanyArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/join.html','Mobile\ArticleController@BrandJoinArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/profit.html','Mobile\ArticleController@BrandProfitArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/news.html','Mobile\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
    Route::get('brand/{id}/news/page/{page}','Mobile\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
    Route::get('item/{id}','Mobile\ArticleController@ProductionArticle')->where('id', '[0-9]+');
    Route::get('bilist/{id}/{pid?}','Mobile\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('bilist/{id}/page/{page}','Mobile\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('bilist/{id}/{pid?}/page/{page}','Mobile\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('nlist/{id}','Mobile\ListNewsController@listNews')->where('id', '[0-9]+')->name('newslistindex');
    Route::get('nlist/{id}/page/{page}/','Mobile\ListNewsController@listNews')->name('pagelists');
    Route::get('paihangbang/{path?}','Mobile\PaihangbangController@Paihangbang')->where('path', '[a-zA-Z_\/0-9]+');
    Route::post('sprodlist/all/','Mobile\SeacrhController@SeacrhBrand');
    Route::get('sprodlist/all/','Mobile\SeacrhController@SeacrhBrand');
    Route::post('phone/complate/list/','Mobile\PhoneController@ComplateBrands');
    Route::get('{path}_{tid}_{cid}_{zid}','Mobile\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+'])->name('projectlists');
    Route::get('{path}_{tid}_{cid}_{zid}/page/{page}','Mobile\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+','page'=>'[0-9]+'])->name('projectlistspage');
    Route::get('{path}/page/{page}','Mobile\ListNewsController@listNews')->where('path', '[a-zA-Z0-9/_]+')->name('newspagelist');
    Route::get('{path}','Mobile\ListNewsController@listNews')->where('path','[a-zA-Z0-9/_]+')->name('newslist');
});

Route::group(['domain' => 'mip.xiuxianshipin.net'], function () {
    Route::get('/','Mip\IndexController@Index');
    Route::get('news/{id}','Mip\ArticleController@NewsArticle')->where('id', '[0-9]+')->name('news');
    Route::get('brand/{id}','Mip\ArticleController@BrandArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/company.html','Mip\ArticleController@BrandCompanyArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/join.html','Mip\ArticleController@BrandJoinArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/profit.html','Mip\ArticleController@BrandProfitArticle')->where('id', '[0-9]+');
    Route::get('brand/{id}/news.html','Mip\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
    Route::get('brand/{id}/news/page/{page}','Mip\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
    Route::get('item/{id}','Mip\ArticleController@ProductionArticle')->where('id', '[0-9]+');
    Route::get('bilist/{id}/{pid?}','Mip\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('bilist/{id}/page/{page}','Mip\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('bilist/{id}/{pid?}/page/{page}','Mip\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
    Route::get('nlist/{id}','Mip\ListNewsController@listNews')->where('id', '[0-9]+')->name('newslistindex');
    Route::get('nlist/{id}/page/{page}/','Mip\ListNewsController@listNews')->name('pagelists');
    Route::get('paihangbang/{path?}','Mip\PaihangbangController@Paihangbang')->where('path', '[a-zA-Z_\/0-9]+');
    Route::post('sprodlist/all/','Mip\SeacrhController@SeacrhBrand');
    Route::get('sprodlist/all/','Mip\SeacrhController@SeacrhBrand');
    Route::post('phone/complate/list/','Mip\PhoneController@ComplateBrands');
    Route::get('{path}_{tid}_{cid}_{zid}','Mip\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+'])->name('projectlists');
    Route::get('{path}_{tid}_{cid}_{zid}/page/{page}','Mip\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+','page'=>'[0-9]+'])->name('projectlistspage');
    Route::get('{path}/page/{page}','Mip\ListNewsController@listNews')->where('path', '[a-zA-Z0-9/_]+')->name('newspagelist');
    Route::get('{path}','Mip\ListNewsController@listNews')->where('path','[a-zA-Z0-9/_]+')->name('newslist');
});
Route::get('/','Frontend\IndexController@Index');
Route::get('news/{id}','Frontend\ArticleController@NewsArticle')->where('id', '[0-9]+')->name('news');
Route::get('brand/{id}','Frontend\ArticleController@BrandArticle')->where('id', '[0-9]+');
Route::get('brand/{id}/company.html','Frontend\ArticleController@BrandCompanyArticle')->where('id', '[0-9]+');
Route::get('brand/{id}/join.html','Frontend\ArticleController@BrandJoinArticle')->where('id', '[0-9]+');
Route::get('brand/{id}/profit.html','Frontend\ArticleController@BrandProfitArticle')->where('id', '[0-9]+');
Route::get('brand/{id}/news.html','Frontend\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
Route::get('brand/{id}/news/page/{page}','Frontend\ArticleController@BrandNewsArticle')->where('id', '[0-9]+')->name('newspagelist');
Route::get('item/{id}','Frontend\ArticleController@ProductionArticle')->where('id', '[0-9]+');
Route::get('bilist/{id}/{pid?}','Frontend\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
Route::get('bilist/{id}/page/{page}','Frontend\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
Route::get('bilist/{id}/{pid?}/page/{page}','Frontend\ArticleController@BrandProductionArticle')->where('id', '[0-9]+')->name('bilistpagelist');
Route::get('nlist/{id}','Frontend\ListNewsController@listNews')->where('id', '[0-9]+')->name('newslistindex');
Route::get('nlist/{id}/page/{page}/','Frontend\ListNewsController@listNews')->name('pagelists');
Route::get('paihangbang/{path?}','Frontend\PaihangbangController@Paihangbang')->where('path', '[a-zA-Z_\/0-9]+');
Route::post('sprodlist/all/','Frontend\SeacrhController@SeacrhBrand');
Route::get('sprodlist/all/','Frontend\SeacrhController@SeacrhBrand');
Route::post('phone/complate/list/','Frontend\PhoneController@ComplateBrands');
Route::get('{path}_{tid}_{cid}_{zid}','Frontend\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+'])->name('projectlists');
Route::get('{path}_{tid}_{cid}_{zid}/page/{page}','Frontend\ListNewsController@projectBrandLists')->where(['path'=>'[a-zA-Z0-9_\/]+','tid'=>'[0-9]+','cid'=>'[0-9]+','zid'=>'[0-9]+','page'=>'[0-9]+'])->name('projectlistspage');
Route::get('{path}/page/{page}','Frontend\ListNewsController@listNews')->where('path', '[a-zA-Z0-9/_]+')->name('newspagelist');
Route::get('{path}','Frontend\ListNewsController@listNews')->where('path','[a-zA-Z0-9/_]+')->name('newslist');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
