<?php

Route::group ( ['prefix' => 'products-and-services','before'=>'setOrganization' ] , function ()
{
	Route::post ( '/save' , [
		'as'	 => 'productsAndServices.save' ,
		'uses'	 => 'ProductsAndServicesController@save'
	] ) ;
	
	Route::post ( '/get' , [
		'as'	 => 'productsAndServices.get' ,
		'uses'	 => 'ProductsAndServicesController@get'
	] ) ;
	Route::post ( '/get-active-products-and-services' , [
		'as'	 => 'productsAndServices.getActiveProductsAndServices' ,
		'uses'	 => 'ProductsAndServicesController@getActiveProductsAndServices'
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

