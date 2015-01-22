<?php

use Illuminate\Database\Schema\Blueprint ;
use Illuminate\Database\Migrations\Migration ;

class CustomerTelephoneAndAddressNullable extends Migration
{

	public function up ()
	{
		DB::statement ( 'ALTER TABLE `quotes` MODIFY `customer_telephone` VARCHAR(20) NULL;' ) ;
		DB::statement ( 'ALTER TABLE `quotes` MODIFY `customer_address` TEXT NULL;' ) ;
	}

	public function down ()
	{
		DB::statement ( 'ALTER TABLE `quotes` MODIFY `customer_telephone` VARCHAR(20);' ) ;
		DB::statement ( 'ALTER TABLE `quotes` MODIFY `customer_address` TEXT;' ) ;
	}

}
