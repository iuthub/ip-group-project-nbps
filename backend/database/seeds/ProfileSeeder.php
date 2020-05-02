<?php

use App\User;
use App\Profile;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::all();
        foreach ($users as $user) {
            if (is_null($user->profile)) {
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
            }
        }
    }
}
