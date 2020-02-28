<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        //Usuario administrador.
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@admin.com";
        $user->email_verified_at = now();
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->roles()->attach(Role::find(1));
        $user->save();
    }
}
