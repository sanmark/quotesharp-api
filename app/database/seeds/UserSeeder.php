<?php

class UserSeeder extends Seeder
{

	public function run ()
	{
		$users = [
			[
				'id'		 => 1 ,
				'username'	 => 'budhajeewa' ,
				'email'		 => 'budhajeewa@thesanmark.com' ,
				'password'	 => 'budhajeewa' ,
				'first_name' => 'Firstname' ,
				'last_name'	 => 'Lastname' ,
			] ,
			[
				'id'		 => 2 ,
				'username'	 => 'randika' ,
				'email'		 => 'randika@thesanmark.com' ,
				'password'	 => 'randika' ,
				'first_name' => 'Randika' ,
				'last_name'	 => 'Srimal' ,
			] ,
			[
				'id'		 => 3 ,
				'username'	 => 'kosala' ,
				'email'		 => 'kosala@thesanmark.com' ,
				'password'	 => 'kosala' ,
				'first_name' => 'Kosala' ,
				'last_name'	 => 'Indrasiri' ,
			] ,
			[
				'id'		 => 4 ,
				'username'	 => 'mahesh' ,
				'email'		 => 'mahesh@thesanmark.com' ,
				'password'	 => 'mahesh' ,
				'first_name' => 'Mahesh' ,
				'last_name'	 => 'Chathuranga' ,
			] ,
//			[
//				'id'		 =>  ,
//				'username'	 => '' ,
//				'email'		 => '' ,
//				'password'	 => '' ,
//				'first_name' => '' ,
//				'last_name'	 => '' ,
//			] ,
			] ;

		foreach ( $users as $user )
		{
			$user[ 'password' ] = Hash::make ( $user[ 'password' ] ) ;

			User::create ( $user ) ;
		}
	}

}
