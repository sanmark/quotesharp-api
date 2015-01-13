<?php

use Illuminate\Database\Schema\Blueprint ;
use Illuminate\Database\Migrations\Migration ;

class AddOrganizationColumn extends Migration
{

	public function up ()
	{
		Schema::table ( 'auth_sessions' , function($t)
		{
			$t -> string ( 'organization' , 50 ) ;
		} ) ;
	}

	public function down ()
	{
		Schema::table ( 'auth_sessions' , function($t)
		{
			$t -> dropColumn ( 'organization' ) ;
		} ) ;
	}

}
