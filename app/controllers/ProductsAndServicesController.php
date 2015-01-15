<?php

class ProductsAndServicesController extends BaseController
{

	public function get ()
	{

		$productsAndServices = ProductAndService::get () ;
		return Response::json ( [API_DATA => $productsAndServices ] , 200 ) ;
	}

	public function getActiveProductsAndServices()
	{

		$productsAndServices = ProductAndService::where ( 'is_active' , '=' , 1 ) -> get () ;
		return Response::json ( [API_DATA => $productsAndServices ] , 200 ) ;
	}

	public function update ()
	{
		try
		{
			$productsAndServices = Input::get ( 'updateData' ) ;

			$updateProduct				 = ProductAndService::find ( $productsAndServices[ 'id' ] ) ;
			$updateProduct -> code		 = $productsAndServices[ 'code' ] ;
			$updateProduct -> name		 = $productsAndServices[ 'name' ] ;
			$updateProduct -> price		 = $productsAndServices[ 'price' ] ;
			$updateProduct -> details	 = $productsAndServices[ 'details' ] ;
			$updateProduct -> parent_id	 = $productsAndServices[ 'parent_id' ] ;
			$updateProduct -> is_active	 = $productsAndServices[ 'is_active' ] ;

			$updateProduct -> update () ;

			return Response::json ( [
					API_MSG => 'Product updated successfully'
					] , 200 ) ;
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_DATA => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

	public function save ()
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

			$result = $newProductOrService -> validateOnProductSave () ;

			if ( is_null ( $result ) )
			{
				$newProductOrService -> save () ;

				return Response::json ( [API_MSG => 'Product "' . $name . '" saved Successfully' ] , 200 ) ;
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
					'Product deleted successfully'
					] , 200 ) ;
		} catch ( Exception $ex )
		{
			return Response::json ( [
					API_DATA => $ex -> getMessage ()
					] , 406 ) ;
		}
	}

}
