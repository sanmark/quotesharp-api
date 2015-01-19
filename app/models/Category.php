<?php

class Category extends Eloquent
{

	public function getCategoriesForHtmlSelect ()
	{
		$categories				 = $this -> orderBy ( 'name' , 'ASC' ) -> get ( ['id' , 'name' ] ) ;
		$maxIndex				 = count ( $categories ) ;
		$categories[ $maxIndex ] = ['id' => '0' , 'name' => 'Root Category' ] ;
		return $categories ;
	}

	public function validateOnCategorySave ()
	{
		$data = $this -> toArray () ;

		$rules = [
			'name' => [
				'required' ,
				'unique:categories'
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

	public function getCategoriesArray ()
	{

		$categories = $this -> orderBy ( 'name' , 'ASC' ) -> get () ;

		$category = [
			'categories'	 => [ ] ,
			'parent_cats'	 => [ ]
			] ;


		foreach ( $categories as $cat )
		{
			$category[ 'categories' ][ $cat[ 'id' ] ]			 = $cat ;
			$category[ 'parent_cats' ][ $cat[ 'parent_id' ] ][]	 = $cat[ 'id' ] ;
		}

		return $category ;
	}

	public function setParentCategoryForChildCategories ( $categoryId , $categoryParentId )
	{

		$productObject	 = new ProductAndService() ;
		$childCategories = $this -> where ( 'parent_id' , '=' , $categoryId ) -> get () ;

		if ( count ( $childCategories ) == 0 )
		{
			$productObject -> setParentCategoryForChildProducts ( $categoryId , $categoryParentId ) ;
		} else
		{
			foreach ( $childCategories as $childCategory )
			{
				$childCategory -> parent_id = $categoryParentId ;
				$childCategory -> update () ;
				$productObject -> setParentCategoryForChildProducts ( $categoryId , $childCategory -> id ) ;
			}
		}
	}

	public function validateOnCategoryUpdate ()
	{
		$data = $this -> toArray () ;

		$rules = [
			'name' => [
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
