<?php

Route::group ( ['prefix' => 'categories' ] , function ()
{
	Route::post ( '/save-new-category' , [
		'as'	 => 'categories.saveNewCategory' ,
		'uses'	 => 'CategoriesController@saveNewCategory'
	] ) ;
	Route::post ( '/update-categories' , [
		'as'	 => 'categories.updateCategories' ,
		'uses'	 => 'CategoriesController@updateCategories'
	] ) ;
	Route::post ( '/get-categories' , [
		'as'	 => 'categories.getCategories' ,
		'uses'	 => 'CategoriesController@getCategories'
	] ) ;
	Route::post ( '/get-categories-for-quote' , [
		'as'	 => 'categories.getCategoriesForQuote' ,
		'uses'	 => 'CategoriesController@getCategoriesForQuote'
	] ) ;
	Route::post ( '/get-categories-for-html-select' , [
		'as'	 => 'categories.getCategoriesForHtmlSelect' ,
		'uses'	 => 'CategoriesController@getCategoriesForHtmlSelect'
	] ) ;
	Route::post ( '/delete-category' , [
		'as'	 => 'categories.deleteCategory' ,
		'uses'	 => 'CategoriesController@deleteCategory'
	] ) ;
} ) ;
