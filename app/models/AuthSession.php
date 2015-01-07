<?php

class AuthSession extends Eloquent
{

	public function user ()
	{
		return $this -> belongsTo ( 'User' ) ;
	}

}
