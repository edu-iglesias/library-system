<?php
class UserSeeder extends Seeder 
{
    public function run()
    {

        $user = new User;
        $user->UserId = '201110802';
        $user->password = Hash::make('student');
        $user->Fname = 'Sam';
        $user->Lname = 'Iglesias';
        $user->Mname = 'Camara';
        $user->Mname = '09192845459';
        $user->status = '1';
        $user->save();

        $assign = new Assigned;
        $assign->user_id = $user->id;
        $assign->role_id = 2;
        $assign->save();

        $user = new User;
        $user->UserId = '201110803';
        $user->password = Hash::make('faculty');
        $user->Fname = 'Marth Deniece';
        $user->Lname = 'Geronimo';
        $user->Mname = 'Gee';
        $user->Mname = '09152543679';
        $user->status = '1';
        $user->save();

        $assign = new Assigned;
        $assign->user_id = $user->id;
        $assign->role_id = 3;
        $assign->save();
    }
}