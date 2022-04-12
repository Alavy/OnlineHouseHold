<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email=$this->faker->unique()->safeEmail;
        return [
            'name' => $this->faker->name,
            'email' => $email,
            'email_verified_at' => now(),
            'role'=> 'admin',
            'user_identity'=>crc32($email.' '.time()),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
