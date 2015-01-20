<?php

Route::group ( ['prefix' => 'quote','before'=>'setOrganization' ] , function ()
{
	Route::post ( '/save-quote' , [
		'as'	 => 'quote.saveQuote' ,
		'uses'	 => 'QuoteController@saveQuote'
	] ) ;
	Route::post ( '/update-quote' , [
		'as'	 => 'quote.updateQuote' ,
		'uses'	 => 'QuoteController@updateQuote'
	] ) ;
	Route::post ( '/get-quotes' , [
		'as'	 => 'quote.getQuotes' ,
		'uses'	 => 'QuoteController@getQuotes'
	] ) ;
	Route::post ( '/get-quotes-total' , [
		'as'	 => 'quote.getQuotesTotal' ,
		'uses'	 => 'QuoteController@getQuotesTotal'
	] ) ;
	Route::post ( '/get-basic-quote-data' , [
		'as'	 => 'quote.getBasicQuoteData' ,
		'uses'	 => 'QuoteController@getBasicQuoteData'
	] ) ;
	Route::post ( '/get-quote-products-and-services-data' , [
		'as'	 => 'quote.getQuoteProductsAndServicesData' ,
		'uses'	 => 'QuoteController@getQuoteProductsAndServicesData'
	] ) ;
	Route::post ( '/get-categories-for-quote' , [
		'as'	 => 'quote.getDataOnCode' ,
		'uses'	 => 'QuoteController@getDataOnCode'
	] ) ;
	Route::post ( '/delete-quote' , [
		'as'	 => 'quote.deleteQuote' ,
		'uses'	 => 'QuoteController@deleteQuote'
	] ) ;
	Route::post ( '/get-customers' , [
		'as'	 => 'quoteDetails.getCustomers' ,
		'uses'	 => 'QuoteController@getCustomers'
	] ) ;
} ) ;

