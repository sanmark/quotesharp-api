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

}
