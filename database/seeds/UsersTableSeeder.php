<?php

use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class)->times(15)->create();

        foreach ($users as $key => $user) {
            $user->roles()->attach(Role::find(3));
            $user->save();
        }
    }
}
