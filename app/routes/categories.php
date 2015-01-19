<?php

Route::group ( ['prefix' => 'categories','before'=>'setOrganization' ] , function ()
{
	Route::post ( '/save-new-category' , [
		'as'	 => 'categories.saveNewCategory' ,
		'uses'	 => 'CategoriesController@saveNewCategory'
	] ) ;
	Route::post ( '/update-category' , [
		'as'	 => 'categories.updateCategory' ,
		'uses'	 => 'CategoriesController@updateCategory'
	] ) ;
	Route::post ( '/get-categories' , [
		'as'	 => 'categories.getCategories' ,
		'uses'	 => 'CategoriesController@getCategories'
	] ) ;
	Route::post ( '/get-categories-for-tree-view' , [
		'as'	 => 'categories.getCategoriesForTreeView' ,
		'uses'	 => 'CategoriesController@getCategoriesForTreeView'
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
