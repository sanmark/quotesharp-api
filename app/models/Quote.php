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
			] ,
			'printed_quote_id'		 => [
				'required'
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
	public function validateQuoteBasicDetailsOnUpdate ()
	{
		$data	 = $this -> toArray () ;
		$rules	 = [
			'customer_name'		 => [
				'required' ,
			] ,
			'date'		 => [
				'required' ,
				'date' ,
			] ,
			'printed_quote_id'		 => [
				'required'
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
