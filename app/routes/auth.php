<?php

Route::group ( ['prefix' => 'auth','before'=>'setOrganization' ] , function ()
{
	Route::post ( '/login' , [
		'as'	 => 'auth.login' ,
		'uses'	 => 'AuthController@login'
	] ) ;

	Route::group ( ['before' => 'cors' ] , function()
	{
		Route::post ( '/logout' , [
			'as'	 => 'auth.logout' ,
			'uses'	 => 'AuthController@logout'
		] ) ;
	} ) ;
} ) ;
