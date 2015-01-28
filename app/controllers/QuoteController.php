<?php

class QuoteController extends BaseController
{

	public function saveQuote ()
	{
		$customerName		 = Input::get ( 'customer_name' ) ;
		$customerTelephone	 = Input::get ( 'customer_telephone' ) ;
		$customerAddress	 = Input::get ( 'customer_address' ) ;
		$date				 = Input::get ( 'date_time' ) ;
		$printedId			 = Input::get ( 'printed_id' ) ;
		$quoteData			 = Input::get ( 'quoteData' ) ;

		$newQuoteBasicDetails						 = new Quote() ;
		$newQuoteBasicDetails -> customer_name		 = $customerName ;
		$newQuoteBasicDetails -> customer_telephone	 = $customerTelephone ;
		$newQuoteBasicDetails -> customer_address	 = $customerAddress ;
		$newQuoteBasicDetails -> date				 = $date ;
		$newQuoteBasicDetails -> printed_quote_id	 = $printedId ;

		$result = $newQuoteBasicDetails -> validateQuoteBasicDetailsOnSave () ;

		if ( is_null ( $result ) )
		{
			$newQuoteBasicDetails -> save () ;

			$savedQuoteId = $newQuoteBasicDetails -> id ;
		} else
		{
			return Response::json ( [API_MSG => $result ] , 406 ) ;
		}

		foreach ( $quoteData as $product )
		{
			$newQuoteDetails							 = new QuoteDetail() ;
			$newQuoteDetails -> quote_id				 = $savedQuoteId ;
			$newQuoteDetails -> product_or_service_id	 = $product[ 'id' ] ;
			$newQuoteDetails -> price					 = $product[ 'price' ] ;
			$newQuoteDetails -> quantity				 = $product[ 'quantity' ] ;
			$newQuoteDetails -> save () ;
		}

		return Response::json ( [API_MSG => ["Quote saved successfully" ] ] , 200 ) ;
	}

	public function updateQuote ()
	{
		$quoteId			 = Input::get ( 'edit_quote_id' ) ;
		$customerName		 = Input::get ( 'customer_name' ) ;
		$customerTelephone	 = Input::get ( 'customer_telephone' ) ;
		$customerAddress	 = Input::get ( 'customer_address' ) ;
		$date				 = Input::get ( 'date_time' ) ;
		$printedId			 = Input::get ( 'printed_id' ) ;
		$quoteData			 = Input::get ( 'quoteData' ) ;

		$editQuoteBasicDetails						 = Quote::find ( $quoteId ) ;
		$editQuoteBasicDetails -> printed_quote_id	 = $printedId ;
		$editQuoteBasicDetails -> customer_name		 = $customerName ;
		$editQuoteBasicDetails -> customer_telephone = $customerTelephone ;
		$editQuoteBasicDetails -> customer_address	 = $customerAddress ;
		$editQuoteBasicDetails -> date				 = $date ;

		$result = $editQuoteBasicDetails -> validateQuoteBasicDetailsOnUpdate () ;

		if ( is_null ( $result ) )
		{
			$editQuoteBasicDetails -> update () ;
		} else
		{
			return Response::json ( [API_MSG => $result ] , 406 ) ;
		}


		$productsExists	 = QuoteDetail::where ( 'quote_id' , '=' , $quoteId ) -> lists ( 'product_or_service_id' ) ;
		$newQuoteData	 = new QuoteDetail() ;

		foreach ( $quoteData as $product )
		{
			$editQuoteData = QuoteDetail::where ( 'quote_id' , '=' , $quoteId ) -> where ( 'product_or_service_id' , '=' , $product[ 'id' ] ) -> first () ;
			if ( in_array ( $product[ 'id' ] , $productsExists ) )
			{
				if ( $product[ 'quantity' ] == "" || $product[ 'quantity' ] == NULL )
				{
					QuoteDetail::where ( 'quote_id' , '=' , $quoteId ) -> where ( 'product_or_service_id' , '=' , $product[ 'id' ] ) -> delete () ;
				} else
				{
					$editQuoteData -> product_or_service_id	 = $product[ 'id' ] ;
					$editQuoteData -> price					 = $product[ 'price' ] ;
					$editQuoteData -> quantity				 = $product[ 'quantity' ] ;
					$editQuoteData -> update () ;
				}
			} elseif ( ! in_array ( $product[ 'id' ] , $productsExists ) )
			{
				if ( $product[ 'quantity' ] != 0 )
				{
					$newQuoteData -> quote_id				 = $quoteId ;
					$newQuoteData -> product_or_service_id	 = $product[ 'id' ] ;
					$newQuoteData -> price					 = $product[ 'price' ] ;
					$newQuoteData -> quantity				 = $product[ 'quantity' ] ;
					$newQuoteData -> save () ;
				}
			}
		}

		return Response::json ( [API_MSG => ['Quote updated successfully' ] ] , 200 ) ;
	}

	public function getCustomers ()
	{
		try
		{
			$customersList = Quote::distinct ( ['customer_name' ] ) -> get ( ['customer_name' ] ) ;

			return Response::json ( [
					API_DATA => $customersList
					] , 200 ) ;
		} catch ( Exception $exc )
		{
			return Response::json ( [
					API_MSG => $exc -> getMessage ()
					] , 406 ) ;
		}
	}

	public function getQuotes ()
	{
		$quoteData = Quote::get () ;

		return Response::json ( [API_DATA => $quoteData ] , 200 ) ;
	}

	public function getQuotesTotal ()
	{
		$quotes			 = Quote::get () ;
		$quoteTotalArray = [ ] ;
		foreach ( $quotes as $quote )
		{
			$quoteDetails	 = QuoteDetail::where ( 'quote_id' , '=' , $quote -> id ) -> get () ;
			$rowTotal		 = 0 ;
			foreach ( $quoteDetails as $quoteDetail )
			{
				$price		 = $quoteDetail -> price ;
				$quantity	 = $quoteDetail -> quantity ;
				$rowTotal += $price * $quantity ;
			}
			$quoteTotalArray[ $quote -> id ] = $rowTotal ;
		}
		return Response::json ( [API_DATA => $quoteTotalArray ] , 200 ) ;
	}

	public function deleteQuote ()
	{
		$quoteId = Input::get ( 'quote_id' ) ;

		$quote = Quote::find ( $quoteId ) ;
		$quote -> delete () ;

		return Response::json ( [
				API_MSG => ['Quote id ' . $quoteId . ' deleted successfully' ]
				] , 200 ) ;
	}

	public function getBasicQuoteData ()
	{
		$quoteId = Input::get ( 'quote_id' ) ;

		$basicQuoteData = Quote::find ( $quoteId ) ;
		return Response::json ( [API_DATA => $basicQuoteData ] , 200 ) ;
	}

	public function getQuoteProductsAndServicesData ()
	{
		$quoteId = Input::get ( 'quote_id' ) ;

		$quoteDetails = QuoteDetail::where ( 'quote_id' , '=' , $quoteId ) -> get () ;
		return Response::json ( [API_DATA => $quoteDetails ] , 200 ) ;
	}

}
