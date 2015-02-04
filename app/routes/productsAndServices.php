<?php

Route::group ( ['prefix' => 'products-and-services','before'=>'setOrganization' ] , function ()
{
	Route::post ( '/save-new-product-or-service' , [
		'as'	 => 'productsAndServices.saveNewProductOrService' ,
		'uses'	 => 'ProductsAndServicesController@saveNewProductOrService'
	] ) ;
	
	Route::post ( '/get-all-products-and-services' , [
		'as'	 => 'productsAndServices.getAllProductsAndServices' ,
		'uses'	 => 'ProductsAndServicesController@getAllProductsAndServices'
	] ) ;
	Route::post ( '/get-active-products-and-services' , [
		'as'	 => 'productsAndServices.getActiveProductsAndServices' ,
		'uses'	 => 'ProductsAndServicesController@getActiveProductsAndServices'
	] ) ;
	
	Route::post ( '/update-product-or-service' , [
		'as'	 => 'productsAndServices.updateProductOrService' ,
		'uses'	 => 'ProductsAndServicesController@updateProductOrService'
	] ) ;
	Route::post ( '/delete-product-or-service' , [
		'as'	 => 'productsAndServices.deleteProductOrService' ,
		'uses'	 => 'ProductsAndServicesController@deleteProductOrService'
	] ) ;
	Route::post ( '/get-all-products-and-services-for-edit-mode' , [
		'as'	 => 'productsAndServices.getAllProductsAndServicesForEditMode' ,
		'uses'	 => 'ProductsAndServicesController@getAllProductsAndServicesForEditMode'
	] ) ;
} ) ;

