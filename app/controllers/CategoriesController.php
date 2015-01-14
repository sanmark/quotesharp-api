<?php

class CategoriesController extends BaseController
{

	public function getCategories ()
	{
		$categoryies = Category::get () ;

		return Response::json ( [API_DATA => $categoryies ] , 200 ) ;
	}

	public function getCategoriesForHtmlSelect ()
	{

		$categoriesObj	 = new Category() ;
		$categories		 = $categoriesObj -> getCategoriesForHtmlSelect () ;

		return Response::json ( [API_DATA => $categories ] , 200 ) ;
	}

	public function getCategoriesForQuote ()
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
						API_MSG => 'New category "' . $categoryName . '" saved successfully'
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

	public function updateCategories ()
	{
		$categoriesUpdateData = Input::get ( 'updateData' ) ;


		$category				 = Category::find ( $categoriesUpdateData[ 'id' ] ) ;
		$category -> name		 = $categoriesUpdateData[ 'name' ] ;
		$category -> details	 = $categoriesUpdateData[ 'details' ] ;
		$category -> parent_id	 = $categoriesUpdateData[ 'parent_id' ] ;
		$category -> update () ;


		return Response::json ( [
				API_MSG => 'Category updated successfully'
				] , 200 ) ;
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
					API_MSG => 'Category "' . $category -> name . '" deleted successfully'
					] , 200 ) ;
		} catch ( Exception $exc )
		{
			return Response::json ( [
					API_MSG => $exc -> getMessage ()
					] , 406 ) ;
		}
	}

}
