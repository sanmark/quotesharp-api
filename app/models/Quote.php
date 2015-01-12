<?php

class Quote extends Eloquent
{

	public function validateQuoteOnSave ()
	{
		$data = $this -> toArray () ;
		
	}

}
