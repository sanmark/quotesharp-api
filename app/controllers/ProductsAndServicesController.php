<?php

class ProductsAndServicesController extends BaseController
{

	public function getAllProductsAndServicesForEditMode ()
	{
		$quoteId							 = Input::get ( 'quote_id' ) ;
		$quoteProductIds					 = QuoteDetail::where ( 'quote_id' , '=' , $quoteId ) -> lists ( 'product_or_service_id' ) ;
		$inactiveProductsAndServices		 = ProductAndService::where ( 'is_active' , '=' , TRUE ) -> lists ( 'id' ) ;
		$editModeProductIdsWithDuplicates	 = array_merge ( $quoteProductIds , $inactiveProductsAndServices ) ;
		$editModeProductIds					 = array_unique ( $editModeProductIdsWithDuplicates ) ;
		$productsForEditMode				 = [ ] ;
		foreach ( $editModeProductIds as $id )
		{
			$productsForEditMode[] = ProductAndService::find ( $id ) ;
		}
		
		return Response::json ( [API_DATA => $productsForEditMode ] , 200 ) ;
	}

	public function getAllProductsAndServices ()
	{
		$productsAndServices = ProductAndService::get () ;
		return Response::json ( [API_DATA => $productsAndServices ] , 200 ) ;
	}

	public function getActiveProductsAndServices ()
	{

		$activeProductsAndServices = ProductAndService::where ( 'is_active' , '=' , true ) -> get () ;
		return Response::json ( [API_DATA => $activeProductsAndServices ] , 200 ) ;
	}

	public function updateProductOrService ()
	{
		$id		 = Input::get ( 'productId' ) ;
		$code	 = Input::get ( 'productCode' ) ;
		$name	 = Input::get ( 'productName' ) ;
		$price	 = Input::get ( 'productPrice' ) ;
		$details = Input::get ( 'productDetails' ) ;
		$parent	 = Input::get ( 'productParent' ) ;
		$status	 = Input::get ( 'productStatus' ) ;

		try
		{
			$updateProduct				 = ProductAndService::find ( $id ) ;
			$oldProductName				 = $updateProduct -> name ;
			$updateProduct -> code		 = $code ;
			$updateProduct -> name		 = $name ;
			$updateProduct -> price		 = $price ;
			$updateProduct -> details	 = $details ;
			$updateProduct -> parent_id	 = $parent ;
			$updateProduct -> is_active	 = $status ;


			$result = $updateProduct -> validateOnProductOrServiceUpdate () ;

			if ( is_null ( $result ) )
			{
				$updateProduct -> update () ;

				return Response::json ( [
						API_MSG => ["Product '" . $oldProductName . "' updated successfully" ]
						] , 200 ) ;
			} else
			{
				return Response::json ( [API_MSG => $result ] , 406 ) ;
			}
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_DATA => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

	public function saveNewProductOrService ()
	{

		$code	 = Input::get ( 'productCode' ) ;
		$name	 = Input::get ( 'productName' ) ;
		$price	 = Input::get ( 'productPrice' ) ;
		$details = Input::get ( 'productDetails' ) ;
		$parent	 = Input::get ( 'productParent' ) ;
		$status	 = Input::get ( 'productStatus' ) ;
		try
		{
			$newProductOrService				 = new ProductAndService() ;
			$newProductOrService -> code		 = $code ;
			$newProductOrService -> name		 = $name ;
			$newProductOrService -> price		 = $price ;
			$newProductOrService -> details		 = $details ;
			$newProductOrService -> parent_id	 = $parent ;
			$newProductOrService -> is_active	 = $status ;

			$result = $newProductOrService -> validateOnProductOrServiceSave () ;

			if ( is_null ( $result ) )
			{
				$newProductOrService -> save () ;

				return Response::json ( [API_MSG => ['Product "' . $name . '" saved Successfully' ] ] , 200 ) ;
			} else
			{
				return Response::json ( [API_MSG => $result ] , 406 ) ;
			}
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_DATA => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

	public function deleteProductOrService ()
	{
		$productId = Input::get ( 'productId' ) ;

		try
		{
			$deleteProduct = ProductAndService::find ( $productId ) ;
			$deleteProduct -> delete () ;

			return Response::json ( [API_MSG =>
					['Product deleted successfully' ]
					] , 200 ) ;
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_DATA => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

}
