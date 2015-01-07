<?php

Route::group ( ['prefix' => 'products-and-services' ] , function ()
{
	Route::post ( '/save' , [
		'as'	 => 'productsAndServices.save' ,
		'uses'	 => 'ProductsAndServicesController@save'
	] ) ;
	
	Route::post ( '/get' , [
		'as'	 => 'productsAndServices.get' ,
		'uses'	 => 'ProductsAndServicesController@get'
	] ) ;
	
	Route::post ( '/update' , [
		'as'	 => 'productsAndServices.update' ,
		'uses'	 => 'ProductsAndServicesController@update'
	] ) ;
	Route::post ( '/delete-product' , [
		'as'	 => 'productsAndServices.deleteProductOrService' ,
		'uses'	 => 'ProductsAndServicesController@deleteProductOrService'
	] ) ;
} ) ;

