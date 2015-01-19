<?php

class Quote extends Eloquent
{

	public function validateQuoteBasicDetailsOnSave ()
	{
		$data	 = $this -> toArray () ;
		$rules	 = [
			'customer_name'		 => [
				'required' ,
			] ,
			'date'		 => [
				'required' ,
				'date' ,
			] 
			] ;

		$validator = Validator::make ( $data , $rules ) ;

		if ( $validator -> fails () )
		{
			$message	 = $validator -> messages () ;
			$response	 = $message -> all () ;
			return $response ;
		}
	}

}
