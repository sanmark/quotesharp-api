<?php

class ProductsAndServicesController extends BaseController
{

	public function get ()
	{

		$productsAndServices = ProductAndService::get () ;
		return Response::json ( [API_DATA => $productsAndServices ] , 200 ) ;
	}

	public function update ()
	{
		try
		{
			$productsAndServices = Input::get ( 'updateData' ) ;

			foreach ( $productsAndServices as $product )
			{
				$updateProduct				 = ProductAndService::find ( $product[ 'id' ] ) ;
				$updateProduct -> code		 = $product[ 'code' ] ;
				$updateProduct -> name		 = $product[ 'name' ] ;
				$updateProduct -> price		 = $product[ 'price' ] ;
				$updateProduct -> details	 = $product[ 'details' ] ;
				$updateProduct -> parent_id	 = $product[ 'parent_id' ] ;

				$updateProduct -> update () ;
			}

			return Response::json ( [
					API_MSG => 'Products and services updated successfully'
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
		try
		{
			$newProductOrService				 = new ProductAndService() ;
			$newProductOrService -> code		 = $code ;
			$newProductOrService -> name		 = $name ;
			$newProductOrService -> price		 = $price ;
			$newProductOrService -> details		 = $details ;
			$newProductOrService -> parent_id	 = $parent ;
			$newProductOrService -> save () ;

			return Response::json ( [API_MSG => 'Product "' . $name . '" saved Successfully' ] , 200 ) ;
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
