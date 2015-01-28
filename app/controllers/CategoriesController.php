<?php

class CategoriesController extends BaseController
{

	public function getCategories ()
	{
		$categories = Category::get () ;

		return Response::json ( [API_DATA => $categories ] , 200 ) ;
	}

	public function getCategoriesForHtmlSelect ()
	{

		$categoriesObj	 = new Category() ;
		$categories		 = $categoriesObj -> getCategoriesForHtmlSelect () ;

		return Response::json ( [API_DATA => $categories ] , 200 ) ;
	}

	public function getCategoriesForTreeView ()
	{
		$categoriesObj	 = new Category() ;
		$category		 = $categoriesObj -> getCategoriesArray () ;
		return Response::json ( [API_DATA => $category ] , 200 ) ;
	}

	public function saveNewCategory ()
	{
		$categoryName	 = Input::get ( 'categoryName' ) ;
		$categoryDetails = Input::get ( 'categoryDetails' ) ;
		$parentCategory	 = Input::get ( 'parentCategory' ) ;

		try
		{
			$newCategory				 = new Category() ;
			$newCategory -> name		 = $categoryName ;
			$newCategory -> details		 = $categoryDetails ;
			$newCategory -> parent_id	 = $parentCategory ;

			$result = $newCategory -> validateOnCategorySave () ;
			if ( is_null ( $result ) )
			{
				$newCategory -> save () ;

				return Response::json ( [
						API_MSG => ['New category "' . $categoryName . '" saved successfully' ]
						] , 200 ) ;
			} else
			{
				return Response::json ( [
						API_MSG => $result
						] , 406 ) ;
			}
		} catch ( Exception $exc )
		{
			return Response::json ( [
					API_MSG => $exc -> getMessage ()
					] , 406 ) ;
		}
	}

	public function updateCategory ()
	{
		$categoryData = Input::get ( 'updateData' ) ;

		if ( ! isset ( $categoryData[ 'name' ] ) )
		{
			$categoryData[ 'name' ] = "" ;
		}

		$category				 = Category::find ( $categoryData[ 'id' ] ) ;
		$oldCategoryName		 = $category -> name ;
		$category -> name		 = $categoryData[ 'name' ] ;
		$category -> details	 = $categoryData[ 'details' ] ;
		$category -> parent_id	 = $categoryData[ 'parent_id' ] ;

		$result = $category -> validateOnCategoryUpdate () ;


		if ( is_null ( $result ) )
		{
			$category -> update () ;

			return Response::json ( [
					API_MSG => ["'" . $oldCategoryName . "' category updated successfully" ]
					] , 200 ) ;
		} else
		{
			return Response::json ( [
					API_MSG => $result
					] , 406 ) ;
		}
	}

	public function deleteCategory ()
	{
		$categoryObject = new Category() ;

		$categoryId = Input::get ( 'categoryId' ) ;
		try
		{
			$category = Category::find ( $categoryId ) ;

			$categoryObject -> setParentCategoryForChildCategories ( $categoryId , $category -> parent_id ) ;

			$category -> delete () ;

			return Response::json ( [
					API_MSG => ['Category "' . $category -> name . '" deleted successfully' ]
					] , 200 ) ;
		} catch ( Exception $exc )
		{
			return Response::json ( [
					API_MSG => [$exc -> getMessage () ]
					] , 406 ) ;
		}
	}

}
