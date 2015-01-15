<?php

use Illuminate\Database\Schema\Blueprint ;
use Illuminate\Database\Migrations\Migration ;

class AddIsActiveColumn extends Migration
{

	public function up ()
	{

		Schema::table ( 'products_and_services' , function($t)
		{
			$t -> boolean ( 'is_active' ) ;
		} ) ;
	}

	public function down ()
	{
		Schema::table ( 'products_and_services' , function($t)
		{
			$t -> dropColumn ('is_active') ;
		} ) ;
	}

}
