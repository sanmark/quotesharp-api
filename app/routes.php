<?php

date_default_timezone_set ( 'Asia/Colombo' ) ;

Route::post ( '/test' , function ()
{
	$password		 = Input::get ( 'password' ) ;
	$hashedPassword	 = Hash::make ( $password ) ;
	return $hashedPassword ;
} ) ;


App::missing ( function ()
{
	return Response::json ( [ API_MSG => 'Not Found' ] , 404 ) ;
} ) ;

foreach ( glob ( app_path () . '/routes/*.php' ) as $routeFile )
{
	include_once $routeFile ;
}

foreach ( glob ( app_path () . '/dictionaries/*.php' ) as $dictionaryFile )
{
	include_once $dictionaryFile ;
}

foreach ( glob ( app_path () . '/butlers/*.php' ) as $butlerFile )
{
	include_once $butlerFile ;
}

foreach ( glob ( app_path () . '/helpers/*.php' ) as $helperFile )
{
	include_once $helperFile ;
}
