<?php
class AdminSeeder extends Seeder {
    public function run()
    {

        DB::table('users')->delete();

        $admin = new User;
        $admin->UserId = '201100000';
        $admin->password = Hash::make('admin');
        $admin->Fname = 'Carmina';
        $admin->Lname = 'Iglesias';
        $admin->Mname = 'Potot';
        $admin->status = '9';
        $admin->save();

        $assign = new Assigned;
        $assign->user_id = $admin->id;
        $assign->role_id = 1;
        $assign->save();
    }
}