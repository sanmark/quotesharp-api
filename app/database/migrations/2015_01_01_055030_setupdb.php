<?php

use Illuminate\Database\Schema\Blueprint ;
use Illuminate\Database\Migrations\Migration ;

class Setupdb extends Migration
{

	public function up ()
	{
		Schema::create ( 'users' , function($t)
		{
			$t -> increments ( 'id' ) ;
			$t -> string ( 'username' , 50 ) ;
			$t -> string ( 'email' , 100 ) ;
			$t -> string ( 'password' , 100 ) ;
			$t -> string ( 'first_name' , 50 ) ;
			$t -> string ( 'last_name' , 50 ) ;
			$t -> string ( 'remember_token' , 100 ) -> nullable () ;
			$t -> timestamps () ;
		} ) ;

		Schema::create ( 'auth_sessions' , function($t)
		{
			$t -> increments ( 'id' ) ;
			$t -> integer ( 'user_id' ) -> unsigned () ;
			$t -> string ( 'auth_token' , 200 ) ;
			$t -> timestamp ( 'auth_token_expiry_time' ) ;
			$t -> timestamps () ;

			$t -> foreign ( 'user_id' )
				-> references ( 'id' )
				-> on ( 'users' )
				-> onUpdate ( 'cascade' )
				-> onDelete ( 'cascade' ) ;
		} ) ;

		Schema::create ( 'categories' , function ($t)
		{
			$t -> increments ( 'id' ) ;
			$t -> string ( 'name' , 50 ) ;
			$t -> text ( 'details' ) -> nullable () ;
			$t -> integer ( 'parent_id' ) ;
			$t -> timestamps () ;
		} ) ;

		Schema::create ( 'products_and_services' , function ($t)
		{
			$t -> increments ( 'id' ) ;
			$t -> string ( 'code' , 50 ) ;
			$t -> string ( 'name' , 50 ) ;
			$t -> double ( 'price' ) ;
			$t -> text ( 'details' ) -> nullable () ;
			$t -> integer ( 'parent_id' ) -> unsigned () ;
			$t -> timestamps () ;

			$t -> foreign ( 'parent_id' )
				-> references ( 'id' )
				-> on ( 'categories' )
				-> onUpdate ( 'cascade' )
				-> onDelete ( 'cascade' ) ;
		} ) ;

		Schema::create ( 'quotes' , function ($t)
		{

			$t -> increments ( 'id' ) ;
			$t -> string ( 'printed_quote_id' , 50 ) ;
			$t -> string ( 'customer_name' , 50 ) ;
			$t -> string ( 'customer_telephone' , 20 ) ;
			$t -> text ( 'customer_address' ) ;
			$t -> date ( 'date' ) ;
			$t -> timestamps () ;
		} ) ;

		Schema::create ( 'quote_details' , function($t)
		{
			$t -> increments ( 'id' ) ;
			$t -> integer ( 'quote_id' ) -> unsigned () ;
			$t -> integer ( 'product_or_service_id' ) -> unsigned () ;
			$t -> double ( 'price' ) ;
			$t -> double ( 'quantity' ) ;
			$t -> timestamps () ;

			$t -> foreign ( 'quote_id' )
				-> references ( 'id' )
				-> on ( 'quotes' )
				-> onUpdate ( 'cascade' )
				-> onDelete ( 'cascade' ) ;

			$t -> foreign ( 'product_or_service_id' )
				-> references ( 'id' )
				-> on ( 'products_and_services' )
				-> onUpdate ( 'cascade' )
				-> onDelete ( 'cascade' ) ;
		} ) ;
	}

	public function down ()
	{
		Schema::dropIfExists ( 'quote_details' ) ;
		Schema::dropIfExists ( 'quotes' ) ;
		Schema::dropIfExists ( 'products_and_services' ) ;
		Schema::dropIfExists ( 'categories' ) ;
		Schema::dropIfExists ( 'auth_sessions' ) ;
		Schema::dropIfExists ( 'users' ) ;
	}

}
