<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

Route::auth();
Route::get('user/activation/{token}', 'ActiveUserController@activateUser')->name('activeUser');


Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index')->name('home');

Route::get('/wachtwoordvergeten', 'PasswordResetController@index')->name('forgotPass');
Route::post('/wachtwoordvergeten', 'PasswordResetController@sendingMail');

/*************************/
/****     PROFILES    ****/
/*************************/

Route::get('/profiel/{id}', 'UserController@showProfile')->name('showProfile');


/*************************/
/****     TAARTEN     ****/
/*************************/

Route::get('/taarten', 'TaartenController@index')->name('taartIndex');
Route::get('/taarten/taart/{id}', 'TaartenController@showTaart')->name('showTaart');

/**********************/
/****  DECORATIES  ****/
/**********************/

Route::get('/decoraties', 'DecoratiesController@index')->name('decoratieIndex');
Route::get('/decoraties/decoratie/{id}', 'DecoratiesController@showDecoratie')->name('showDecoratie');

/*************************/
/****  ANDER BAKSELS  ****/
/*************************/

Route::get('/anderecreaties', 'AnderbakselsController@index')->name('andersIndex');
Route::get('/anderecreaties/creatie/{id}', 'AnderbakselsController@showAnderBaksel')->name('showAnders');

/*****************/
/**** ERRORS ****/
/***************/

Route::get('/error/403', 'ErrorController@error403')->name('error403');
Route::get('/error/404', 'ErrorController@error404')->name('error404');

/**** AJAX TESTING ****/
///taarten/taart/1/getallcomments
Route::post('/baksel/getallcomments/{id}', 'CommentsController@getAllComments');


Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function()
{
	/*************************/
	/****     PROFILES    ****/
	/*************************/
	/***************/
	/**** EDIT ****/
	/*************/

	Route::get('/profiel/edit/{id}', 'UserController@editProfileMain');
	Route::patch('/profiel/edit/{id}', 'UserController@updateProfileMain');

	Route::get('/profiel/edit/info/{id}', 'UserController@editUserInfo');
	Route::patch('/profiel/edit/info/{id}', 'UserController@updateUserInfo');

	Route::get('/profiel/edit/pass/{id}', 'UserController@editUserPass');
	Route::patch('/profiel/edit/pass/{id}', 'UserController@updateUserPass');

	/********************/
	/****  COMMENTS  ****/
	/********************/

	Route::post('/taarten/taart/{id}', 'CommentsController@creatingComment');
	Route::post('/decoraties/decoratie/{id}', 'CommentsController@creatingComment');
	Route::post('/anderecreaties/creatie/{id}', 'CommentsController@creatingComment');

	/***************/
	/**** EDIT ****/
	/*************/

	Route::get('/taarten/taart/comments/bijwerken/{id}', 'CommentsController@editPost');
	Route::patch('/taarten/taart/comments/bijwerken/{id}', 'CommentsController@editingPost');
	Route::get('/decoraties/decoratie/comments/bijwerken/{id}', 'CommentsController@editPost');
	Route::patch('/decoraties/decoratie/comments/bijwerken/{id}', 'CommentsController@editingPost');
	Route::get('/anderecreaties/creatie/comments/bijwerken/{id}', 'CommentsController@editPost');
	Route::patch('/anderecreaties/creatie/comments/bijwerken/{id}', 'CommentsController@editingPost');

});




Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{

/****************************************************************************************/

	/*************************/
	/****     TAARTEN     ****/
	/*************************/

	Route::get('/taarten/maken', 'BakselsController@createPost');
	Route::post('/taarten/maken', 'BakselsController@creatingPost');

	/***************/
	/**** EDIT ****/
	/*************/

	Route::get('/taarten/taart/bijwerken/{id}', 'BakselsController@editPost');
	Route::patch('/taarten/taart/bijwerken/{id}', 'BakselsController@editingPost');
	Route::get('/taarten/taart/verplaats/{id}', 'BakselsController@movePost');
	Route::patch('/taarten/taart/verplaats/{id}', 'BakselsController@movingPost');

	/*****************/
	/**** DELETE ****/
	/***************/
	Route::get('/taarten/taart/fotos/verwijderen/{id}', 'BakselsController@deleteFoto')->name('taartFotoDel');
	Route::post('/taarten/taart/fotos/verwijderen/{id}', 'BakselsController@deletingFoto');

	Route::get('/taarten/taart/verwijderen/{id}', 'BakselsController@deletePost');
	Route::post('/taarten/taart/verwijderen/{id}', 'BakselsController@deletingPost');

/****************************************************************************************/

	/**********************/
	/****  DECORATIES  ****/
	/**********************/

	Route::get('/decoraties/maken', 'BakselsController@createPost');
	Route::post('/decoraties/maken', 'BakselsController@creatingPost');

	/***************/
	/**** EDIT ****/
	/*************/

	Route::get('/decoraties/decoratie/bijwerken/{id}', 'BakselsController@editPost');
	Route::patch('/decoraties/decoratie/bijwerken/{id}', 'BakselsController@editingPost');
	Route::get('/decoraties/decoratie/verplaats/{id}', 'BakselsController@movePost');
	Route::patch('/decoraties/decoratie/verplaats/{id}', 'BakselsController@movingPost');

	/*****************/
	/**** DELETE ****/
	/***************/

	Route::get('/decoraties/decoratie/fotos/verwijderen/{id}', 'BakselsController@deleteFoto')->name('decorFotoDel');
	Route::post('/decoraties/decoratie/fotos/verwijderen/{id}', 'BakselsController@deletingFoto');

	Route::get('/decoraties/decoratie/verwijderen/{id}', 'BakselsController@deletePost');
	Route::post('/decoraties/decoratie/verwijderen/{id}', 'BakselsController@deletingPost');

/****************************************************************************************/

	/*************************/
	/****  ANDER BAKSELS  ****/
	/*************************/

	Route::get('/anderecreaties/maken', 'BakselsController@createPost');
	Route::post('/anderecreaties/maken', 'BakselsController@creatingPost');

	/***************/
	/**** EDIT ****/
	/*************/

	Route::get('/anderecreaties/creatie/bijwerken/{id}', 'BakselsController@editPost');
	Route::patch('/anderecreaties/creatie/bijwerken/{id}', 'BakselsController@editingPost');
	Route::get('/anderecreaties/creatie/verplaats/{id}', 'BakselsController@movePost');
	Route::patch('/anderecreaties/creatie/verplaats/{id}', 'BakselsController@movingPost');

	/*****************/
	/**** DELETE ****/
	/***************/

	Route::get('/anderecreaties/creatie/fotos/verwijderen/{id}', 'BakselsController@deleteFoto')->name('anderFotoDel');
	Route::post('/anderecreaties/creatie/fotos/verwijderen/{id}', 'BakselsController@deletingFoto');

	Route::get('/anderecreaties/creatie/verwijderen/{id}', 'BakselsController@deletePost');
	Route::post('/anderecreaties/creatie/verwijderen/{id}', 'BakselsController@deletingPost');


/****************************************************************************************/

	/********************/
	/****  COMMENTS  ****/
	/********************/

	/*****************/
	/**** DELETE ****/
	/***************/

	Route::get('/taarten/taart/comments/verwijderen/{id}', 'CommentsController@deletePost');
	Route::post('/taarten/taart/comments/verwijderen/{id}', 'CommentsController@deletingPost');
	Route::get('/decoraties/decoratie/comments/verwijderen/{id}', 'CommentsController@deletePost');
	Route::post('/decoraties/decoratie/comments/verwijderen/{id}', 'CommentsController@deletingPost');
	Route::get('/anderecreaties/creatie/comments/verwijderen/{id}', 'CommentsController@deletePost');
	Route::post('/anderecreaties/creatie/comments/verwijderen/{id}', 'CommentsController@deletingPost');

/****************************************************************************************/

	/*****************/
	/**** BEHEER ****/
	/***************/

	Route::get('/beheer', 'AdminController@index');

	/*****************/
	/**** IMAGES ****/
	/***************/

	Route::get('/beheer/sliders', 'AdminController@listSliders')->name('sliderIndex');
	Route::get('/beheer/editslider/{id}', 'ImageController@editSlider');
	Route::patch('/beheer/editslider/{id}', 'ImageController@editingSlider');
	
	Route::get('/beheer/gallerij', 'AdminController@listIsotope')->name('isotopeIndex');
	Route::get('/beheer/editgallerij/{id}', 'ImageController@editIsotope');
	Route::patch('/beheer/editgallerij/{id}', 'ImageController@editingIsoTope');

	Route::get('/beheer/editfrontquote', 'AdminController@editFrontQuote');
	Route::patch('/beheer/editfrontquote', 'AdminController@editingFrontQuote');

/****************************************************************************************/

	/*********************/
	/**** GEBRUIKERS ****/
	/*******************/

	route::get('/beheer/gebruikers/', 'AdminController@userList');
	route::get('/beheer/gebruiker/{id}', 'AdminController@editUser');
	route::patch('/beheer/gebruiker/{id}', 'AdminController@editingUser');

});






//Route::post('/send', 'MailController@send');
//Route::get('/welcomemail', 'MailController@welcome');

// Route::get('/welcomemail', function () {
//     return view('emails.welcome');
// });
