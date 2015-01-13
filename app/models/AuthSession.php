<?php

class AuthSession extends Eloquent
{

	protected $connection = 'central_db' ;

	public function user ()
	{
		return $this -> belongsTo ( 'User' ) ;
	}

}
