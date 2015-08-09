<?php

class Baz {}

class Bar {

	public $baz;

	public function __construct(Baz $baz) {

		$this->baz = $baz;

	}

}

// App::bind('Bar', function() {

// 	return new Bar(new Baz);

// });


/*USES 'RELECTION' TO BIND THINGS FOR YOU*/
Route::get('bar', function(Bar $bar) {

	dd($bar);

});

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

Route::get('/', function() {

	return 'Home Page';

});

Route::get('about', 'PagesController@about');

Route::get('contact', 'PagesController@contact');


Route::resource('articles', 'ArticlesController');


Route::controllers([

	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',

]);

Route::get('foo', ['middleware' => 'manager', function() {


	return 'this page may only be viewed by managers';

}]);
