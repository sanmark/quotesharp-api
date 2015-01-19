<?php

class ProductAndService extends Eloquent
{

	protected $table = 'products_and_services' ;

	public function setParentCategoryForChildProducts ( $categoryId , $categoryParentId )
	{
		$childProducts = $this -> where ( 'parent_id' , '=' , $categoryId ) -> get () ;

		foreach ( $childProducts as $childProduct )
		{
			$childProduct -> parent_id = $categoryParentId ;
			$childProduct -> update () ;
		}
	}

	public function validateOnProductOrServiceSave ()
	{
		$data = $this -> toArray () ;

		$rules = [
			'code'		 => [
				'required' ,
				'unique:products_and_services'
			] ,
			'name'		 => [
				'required' ,
				'unique:products_and_services'
			] ,
			'price'		 => [
				'required' ,
				'numeric'
			] ,
			'parent_id'	 => [
				'required' ,
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

	public function validateOnProductOrServiceUpdate ()
	{
		$data = $this -> toArray () ;

		$rules = [
			'code'		 => [
				'required' ,
			] ,
			'name'		 => [
				'required' ,
			] ,
			'price'		 => [
				'required' ,
				'numeric'
			] ,
			'parent_id'	 => [
				'required' ,
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
