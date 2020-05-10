<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@site.local',
            'password' => Hash::make('password')
        ]);
        $faker = Factory::create();
        $user->profile()->create([
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'birthday' => $faker->date('Y-m-d'),
            'phone' => $faker->phoneNumber,
            'country' => $faker->country,
            'city' => $faker->city,
            'postcode' => $faker->postcode,
            'address' => $faker->address
        ]);
    }
}
