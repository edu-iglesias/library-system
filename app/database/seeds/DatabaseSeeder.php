<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Removes foreign key constraint

		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('RoleSeeder');
		$this->command->info('The Role table has been seeded.');

		$this->call('AdminSeeder');
		$this->command->info('The Admin has been seeded.');

		$this->call('UserSeeder');
		$this->command->info('The User table has been seeded.');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Return foreign key constraint
	}

}
