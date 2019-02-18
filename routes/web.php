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

Route::get('/', function () {

	
	return view('welcome');
});



	
Route::prefix('admin')->group(function(){

	Route::get('login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'AuthAdmin\LoginController@login');
	Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
	Route::get('register', 'AuthAdmin\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'AuthAdmin\RegisterController@register');

	Route::middleware('admin.auth')->group(function(){
		Route::get('/dashbroad', 'DashbroadController@dashbroad')->name('admin.dashbroad');
		//user manager
		Route::get('/formusersactive','UsersController@formUserActive')->name('admin.formUserActive');
		Route::post('/usersactive','UsersController@getUserActive')->name('admin.userActive');

		Route::get('/formusersinactive','UsersController@formUserInactive')->name('admin.formUserInactive');
		Route::post('/usersinactive','UsersController@getUserInactive')->name('admin.userInactive');

		Route::post('/users/store','UsersController@store')->name('admin.userStore');
		Route::get('/users/find/{id}','UsersController@find')->name('admin.userFind');
		Route::post('/users/update/{id}','UsersController@update')->name('admin.userUpdate');
		Route::post('/users/updatePassword/{id}','UsersController@passwordChange')->name('admin.userPassword');
		Route::post('/users/deactivate/{id}','UsersController@active')->name('admin.userDeactivate');
		Route::post('/users/active/{id}','UsersController@active')->name('admin.userActivated');
		Route::delete('/users/{id}','UsersController@delete')->name('admin.userDelete');
		//

		//admin manager
		Route::get('/adminsformactive','AdminsController@formAdminActive')->name('admin.formAdminActive');
		Route::post('/adminsactive','AdminsController@getAdminActive')->name('admin.adminActive');

		Route::get('/adminsforminactive','AdminsController@formAdminInactive')->name('admin.formAdminInactive');
		Route::post('/adminsinactive','AdminsController@getAdminInactive')->name('admin.adminInactive');
		Route::post('/admins/store','AdminsController@store')->name('admin.adminStore');
		Route::get('/admins/find/{id}','AdminsController@find')->name('admin.adminFind');
		Route::post('/admins/update/{id}','AdminsController@update')->name('admin.adminUpdate');
		Route::post('/admins/updatePassword/{id}','AdminsController@passwordChange')->name('admin.adminPassword');
		Route::post('/admins/deactivate/{id}','AdminsController@active')->name('admin.adminDeactivate');
		Route::post('/admins/active/{id}','AdminsController@active')->name('admin.adminActivated');
		Route::delete('/admins/{id}','AdminsController@delete')->name('admin.adminDelete');
		//

		//product manager
		Route::get('/productsstock','ProductsController@formProductStock')->name('admin.formProductStock');
		Route::post('/productsstock','ProductsController@getProductStock')->name('admin.productStock');
		Route::get('/productsoutstock','ProductsController@formProductOutStock')->name('admin.formProductOutStock');
		Route::post('/productsoutstock','ProductsController@getProductOutStock')->name('admin.productOutStock');
		Route::post('/products/store','ProductsController@store')->name('admin.productStore');
		Route::get('/products/brandsall','ProductsController@getAllBrands')->name('admin.productGetAllBrands');
		Route::get('/products/sizesall','ProductsController@getAllSizes')->name('admin.productGetAllSizes');
		Route::get('/products/find/{id}','ProductsController@find')->name('admin.productFind');
		Route::get('/products/findsize/{id}','ProductsController@findSize')->name('admin.productFindSize');
		Route::get('/products/findimage/{id}','ProductsController@findImage')->name('admin.productFindImage');
		Route::get('/products/findproduct/{id}','ProductsController@findProduct')->name('admin.productFindProduct');
		Route::post('/products/edit/{id}','ProductsController@update')->name('admin.productUpdate');
		Route::post('/products/images/{id}','ProductsController@updateImages')->name('admin.productUpdateImage');
		Route::post('/products/sizes/{id}','ProductsController@updateSizes')->name('admin.productUpdateSize');
		Route::delete('/products/{id}','ProductsController@delete')->name('admin.productDelete');
		//

		//brands manager
		Route::get('/brands','BrandsController@formBrand')->name('admin.formBrand');
		Route::post('/brands','BrandsController@getBrand')->name('admin.getBrand');
		Route::post('/brands/store','BrandsController@store')->name('admin.brandStore');
		Route::get('/brands/find/{id}','BrandsController@find')->name('admin.brandFind');
		Route::post('/brands/edit/{id}','BrandsController@update')->name('admin.brandUpdate');
		Route::delete('/brands/{id}','BrandsController@delete')->name('admin.brandDelete');
		//

		//tags manager
		Route::get('/tags','TagsController@formTag')->name('admin.formTag');
		Route::post('/tags','TagsController@getTag')->name('admin.getTag');
		Route::post('/tags/store','TagsController@store')->name('admin.tagStore');
		Route::get('/tags/find/{id}','TagsController@find')->name('admin.tagFind');
		Route::post('/tags/edit/{id}','TagsController@update')->name('admin.tagUpdate');
		Route::delete('/tags/{id}','TagsController@delete')->name('admin.tagDelete');
		//

		//sizes manager
		Route::get('/sizes','SizesController@formSize')->name('admin.formSize');
		Route::post('/sizes','SizesController@getSize')->name('admin.getSize');
		Route::post('/sizes/store','SizesController@store')->name('admin.sizeStore');
		Route::get('/sizes/find/{id}','SizesController@find')->name('admin.sizeFind');
		Route::post('/sizes/edit/{id}','SizesController@update')->name('admin.sizeUpdate');
		Route::delete('/sizes/{id}','SizesController@delete')->name('admin.sizeDelete');
		//
	});

	

});

Route::prefix('user')->group(function(){
	Route::get('/shops', 'ShopController@shop')->name('shop');
	Route::get('/shops/all', 'ShopController@all')->name('all');
	//cart
	Route::post('/cart/{id}', 'CartController@add2cart')->name('cart');
	Route::get('/cart', 'CartController@showCart')->name('getCart');
	Route::get('/cart/delete', 'CartController@delete')->name('deleteCart');
	Route::get('/cart/detail/{slug}', 'CartController@find')->name('findCart');
	Route::get('/cart/findsize/{id}', 'CartController@findSize')->name('findSize');
	Route::get('/cart/plusone/{id}', 'CartController@plusOne')->name('plusOne');
	Route::get('/cart/minusone/{id}', 'CartController@minusOne')->name('minusOne');
	Route::get('/cart/deleteproduct/{id}', 'CartController@deleteProduct')->name('deleteProduct');
	Route::get('/cart/checkcart', 'CartController@checkCart')->name('checkCart');
	Route::get('/cart/checkout', 'CartController@checkOut')->name('checkOut');
	Route::get('/cart/checklogin', 'CartController@checkLogin')->name('checkLogin');
	Route::get('/cart/payment', 'CartController@payment')->name('payment');
	Route::get('/cart/billdetail', 'CartController@showBill')->name('showBill');
	//
	Auth::routes();
	
	Route::middleware('auth')->group(function(){
		
	});
});


