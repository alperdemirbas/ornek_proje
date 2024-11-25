<?php

namespace Rezyon\Users\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Rezyon\Companies\Models\Companies;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\Models\Users;

class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Users::class;
    public function definition(): array
    {
        return [
            'companies_id' => Companies::factory()->create([
                'is_active' => true,
                'verify_at' => Carbon::now()
            ]),
            'type' => $this->faker->randomElement(Types::values()),
            'pnr' => $this->faker->numerify('#######'),
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('userpassword'), // password
        ];
    }

}
