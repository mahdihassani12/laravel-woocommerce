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

Route::get('/', 'fronted\HomeController@index');
Route::get('store', 'fronted\ProductController@index');
Route::get('product', 'fronted\ProductController@singleProduct');



  Route::get('about-us','fronted\PageController@about')->name('about-us');
  Route::get('contact-us','fronted\PageController@contact')->name('contact-us');
  Route::post('contact/send_email','fronted\PageController@sendEmail');
  Route::get('our-services','fronted\PageController@services')->name('our-services');
  Route::get('product-request','fronted\PageController@product_request')->name('product-request');
  Route::get('download-file','fronted\PageController@download')->name('download-file');
  Route::get('view-download','fronted\PageController@view_download');

  Route::get('learning','fronted\PageController@learning')->name('learning');
  Route::get('learning/single','fronted\PageController@learning_single');

  Route::resource('requests','backend\product_requestController');
  Route::get('requests/delete/{delete}','backend\product_requestController@destroy')->name('requests.delete');
  Route::get('request/change_status','backend\product_requestController@changeStatus');
  Route::get('request_text','backend\product_requestController@requestText');
  Route::post('request_text/update','backend\product_requestController@updateRequestText');

  Route::resource('blog','fronted\BlogController');
  Route::get('blog/post','fronted\BlogController@show');
  Route::resource('comments','backend\CommentsController');
  Route::get('comments/delete/{delete}','backend\CommentsController@delete')->name('comments.delete');

  Route::resource('reply','fronted\repliesController');

  // routes for cart

  Route::get('cart/add_to_cart','fronted\CartController@addToCart');
  Route::get('get_cart_modal','fronted\CartController@cartModelItem');
  Route::get('cart', 'fronted\CartController@Cart');
  Route::get('cart/remove_from_cart', 'fronted\CartController@removeFromCart');
  Route::post('cart/update', 'fronted\CartController@updateCart');
  Route::get('checkout', 'fronted\CartController@checkout');
  Route::post('checkout/update', 'fronted\CartController@updateCheckout');
  Route::get('order/success', 'fronted\CartController@orderSent');

//Auth::routes();
Route::get('mdadmin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@createNewUser')->name('fronted_registeration');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');





Route::group(['middleware' => ['auth', 'active','lang']], function() {	
   Route::get('/language/{lang}', 'backend\HomeController@changeLanguage');
   Route::get('/home', 'backend\HomeController@index')->name('home');
   Route::get('orders/views', 'backend\OrderController@index')->name('home');
   Route::get('order/delete/{id}', 'backend\OrderController@delete')->name('order.delete');
   Route::get('orders/change_status', 'backend\OrderController@changeStatus');
  
  Route::get('my_account', 'fronted\UserController@index');
  Route::post('my_account/save', 'fronted\UserController@save');
  Route::get('my_account/orders', 'fronted\UserController@Orders');
   
   Route::get('settings', 'backend\SettingController@index');
   Route::post('setting/update', 'backend\SettingController@updateSetting');
   //Route::get('profile', 'UserController@profile');


   Route::get('users', 'backend\UserController@index');
   Route::get('user/add','backend\UserController@add');
   Route::post('user/create','backend\UserController@create');
   Route::get('user/edit','backend\UserController@edit');
   Route::post('user/update','backend\UserController@updateUser');
   Route::get('user/delete','backend\UserController@delete');
   
   Route::resource('tags','backend\tagsController');
   Route::get('tag/delete/{delete}','backend\tagsController@deleteTag')->name('tag.delete');
   Route::resource('categories','backend\PostsCategories');
   Route::get('categories/delete/{delete}','backend\PostsCategories@deleteCat')->name('category.delete');
   Route::resource('posts','backend\postsController');
    Route::get('posts/delete/{delete}','backend\postsController@destroy')->name('post.delete');
    Route::post('post/upload_image', 'backend\postsController@uploadDescriptionImage');

   Route::resource('sliders','backend\slidersController');
   Route::get('sliders/delete/{delete}','backend\slidersController@destroy')->name('slider.delete');

  Route::resource('downloads','backend\downloadsController');
   Route::get('downloads/delete/{delete}','backend\downloadsController@destroy')->name('downloads.delete');

   Route::resource('learnings','backend\LearningController');
   Route::get('learnings/delete/{delete}','backend\LearningController@destroy')->name('learnings.delete');

   Route::resource('about','backend\aboutController');
   Route::resource('services','backend\servicesController');
   Route::get('services/delete/{delete}','backend\servicesController@destroy')->name('services.delete');

   Route::resource('contact','backend\contactController');


  Route::resource('units','backend\productUnitController');
  Route::get('units/delete/{delete}','backend\productUnitController@deleteUnit')->name('units.delete');

  Route::resource('product_categories','backend\productCategoryController');
  Route::get('product_categories/delete/{delete}','backend\productCategoryController@deleteProductCategory')->name('product_categories.delete');

  Route::resource('products','backend\productController');
  Route::get('products/delete/{delete}','backend\productController@deleteProduct')->name('products.delete');
  Route::get('product/delete_gallery_photo','backend\productController@deleteGalleryPhoto');
  Route::get('ads','backend\SettingController@ads');
  Route::post('ads/update','backend\SettingController@adsUpdate');
});
