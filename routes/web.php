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
/** FILE NOT FOUND **/
Route::get('*',function(){
	return "ok";
});
/** ROUTE CLIENT **/
Route::get('/',['as'=>'trangchu','uses'=>'ClientController@getTrangchu']);
Route::get("chi-tiet-san-pham/{id}",['as'=>'chitiet','uses'=>'ClientController@getChitiet']);
Route::get('danhmuc/{slug}',['as'=>'danhmuc','uses'=>'ClientController@getDanhmuc']);
Route::post("addCart",['as'=>'addCart','uses'=>'ClientController@addCart']);
Route::get("cart",['as'=>'cart','uses'=>'ClientController@getCart']);
Route::get('xoacart/{id}',['as'=>'xoacart','uses'=>'ClientController@getXoaCart']);
Route::get("updatecart/{id}/{slug}",['as'=>'updatecart','uses'=>'ClientController@updateCart']);
Route::post("addCartChiTiet",['as'=>'addCartChiTiet','uses'=>'ClientController@addCartChiTiet']);
Route::get("tim",['as'=>'tim','uses'=>'ClientController@getTim']);
Route::get("gioithieu",['as'=>'gioithieu','uses'=>'ClientController@getGioithieu']);
Route::get("dangky",['as'=>'dangky','uses'=>'ClientController@getDangky']);
Route::post("dangky",['as'=>'postdangky','uses'=>'ClientController@postDangky']);
Route::get("dangnhap",['as'=>'dangnhap','uses'=>'ClientController@getDangnhap']);
Route::post("dangnhap",['as'=>'postdangnhap','uses'=>'ClientController@postDangnhap']);
Route::get("dangxuat",['as'=>'dangxuat','uses'=>'ClientController@dangxuat']);
Route::get("thanhtoan",['as'=>'thanhtoan','uses'=>'ClientController@getThanhtoan']);
/**END ROUTE CLIENT **/

/** ROUTE ADMIN OR DRASHBOARD **/
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::group(['prefix'=>'category'],function(){
		//admin/category/danhsach
		Route::get('danhsach',['as'=>'danhsachcategory','uses'=>'CategoryController@getDanhsach']);

		//admin/category/them
		Route::get('them',['as'=>'themcategory','uses'=>'CategoryController@getThem']);
		// them post category
		Route::post('them',['as'=>'themcategory','uses'=>'CategoryController@postThem']);
		//admin/category/sua
		Route::get('sua/{id}',['as'=>'suacategory','uses'=>'CategoryController@getSua']);
		Route::post('sua/{id}',['as'=>'suacategory','uses'=>'CategoryController@postSua']);
		//delete category
		Route::get('xoa/{id}',['as' => 'xoacategory','uses' => 'CategoryController@getXoa']);
	});
	Route::group(['prefix'=>'slide'],function(){
		//admin/slide/danhsach
		Route::get('danhsach',['as'=>'danhsachslide','uses'=>'SlideController@getDanhsach']);
		//admin/category/them
		Route::get('them',['as'=>'themslide','uses'=>'SlideController@getThem']);
		// them post category
		Route::post('them',['as'=>'themslide','uses'=>'SlideController@postThem']);
		//admin/category/sua
		Route::get('sua/{id}',['as'=>'suaslide','uses'=>'SlideController@getSua']);
		Route::post('sua/{id}',['as'=>'suaslide','uses'=>'SlideController@postSua']);
		//delete category
		Route::get('xoa/{id}',['as' => 'xoaslide','uses' => 'SlideController@getXoa']);
	});
	Route::group(['prefix'=>'products'],function(){
		//admin/slide/danhsach
		Route::get('danhsach',['as'=>'danhsachproducts','uses'=>'ProductsController@getDanhsach']);
		//admin/category/them
		Route::get('them',['as'=>'themproducts','uses'=>'ProductsController@getThem']);
		// them post category
		Route::post('them',['as'=>'themproducts','uses'=>'ProductsController@postThem']);
		//admin/category/sua
		Route::get('sua/{id}',['as'=>'suaproducts','uses'=>'ProductsController@getSua']);
		Route::post('sua/{id}',['as'=>'suaproducts','uses'=>'ProductsController@postSua']);
		// sua hinh anh 
		Route::get('suahinh/{id}',['as'=>'suaproducthinh','uses'=>'ProductsController@getSuahinh']);
		Route::post('suahinh/{id}',['as'=>'suaproducthinh','uses'=>'ProductsController@postSuahinh']);
		//delete category
		Route::get('xoa/{id}',['as' => 'xoaproducts','uses' => 'ProductsController@getXoa']);
	});
	Route::group(['prefix'=>'users'],function(){
		//admin/user/danhsach
		Route::get('danhsach',['as'=>'danhsachuser','uses'=>'UsersController@getDanhsach']);
		//admin/user/xoa
		Route::get('xoa/{id}',['as'=>'xoauser','uses'=>'UsersController@getXoa']);
	});
});
/**END ROUTE ADMIN OR DRASHBOARD **/