<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => "Mark Lester Morta",
            'email' => 'marklester@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'), // password
            'remember_token' => Str::random(10),
        ];
    }
}