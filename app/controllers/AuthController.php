<?php

class AuthController extends BaseController
{

	public function login ()
	{
		try
		{
			$organization = Input::get ( 'organization' ) ;


			if ( \Sanmark\PhpHelpers\NullHelper::isNullEmptyOrWhitespace ( $organization ) )
			{
				return Response::json ( [
						API_MSG => "Please enter Organization code"
						] , 406 ) ;
			}

			SessionButler::setOrganization ( $organization ) ;
			ConfigButler::setTenantDb ( $organization ) ;
			$tenantDbName = ConfigButler::getTenantDb () ;

			if ( ! DatabaseHelper::hasDatabase ( $tenantDbName ) )
			{
				return Response::json ( [
						API_MSG => 'Invalid Organization Code'
						] , 406 ) ;
			}

			$credentials[ 'username' ]	 = Input::get ( 'username' ) ;
			$credentials[ 'password' ]	 = Input::get ( 'password' ) ;


			if ( Auth::attempt ( $credentials ) )
			{
				$user = Auth::user () ;

				$authSession							 = new AuthSession() ;
				$authSession -> auth_token_expiry_time	 = date ( 'Y-m-d H:i:s' , time () + 7200 ) ;
				$authSession -> auth_token				 = Hash::make ( $authSession -> auth_token_expiry_time . $user -> username ) ;

				$user -> authSessions () -> save ( $authSession ) ;

				return Response::json ( [
						API_MSG			 => 'Login success' ,
						API_AUTH_TOKEN	 => $authSession -> auth_token ,
						'userId'		 => Auth::user () ,
						] , 200 ) ;
			} else
			{
				return Response::json ( [
						API_MSG => 'Login failed'
						] , 401 ) ;
			}
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_MSG => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

	public function logout ()
	{
		return Response::json ( [
				API_MSG => 'Logout successfully.'
			] ) ;
	}

}
