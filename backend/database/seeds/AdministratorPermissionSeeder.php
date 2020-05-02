<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdministratorPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'administrator']);
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@site.local',
            'password' => Hash::make('administrator')
        ]);

        $user->assignRole('administrator');
    }
}
