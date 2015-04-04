<?php
class RoleSeeder extends Seeder 
{
    public function run()
    {

        DB::delete('delete from roles');
        
        DB::insert('insert into roles (name) values (?)', array('Admin'));
        DB::insert('insert into roles (name) values (?)', array('Student'));
        DB::insert('insert into roles (name) values (?)', array('Faculty'));

    }
}