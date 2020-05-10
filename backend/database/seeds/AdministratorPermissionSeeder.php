<?php

use App\Profile;
use App\User;
use Faker\Factory;
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
        $faker = Factory::create();
        $profile = new Profile([
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'birthday' => $faker->date('Y-m-d'),
            'phone' => $faker->phoneNumber,
            'country' => $faker->country,
            'city' => $faker->city,
            'postcode' => $faker->postcode,
            'address' => $faker->address
        ]);
        $profile->user()->associate($user);
        $profile->save();
        $user->assignRole('administrator');
    }
}
