<?php

namespace  Rezyon\Companies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\CompanyOfficials;

class CompanyOfficialFactory extends Factory
{

    protected $model = CompanyOfficials::class;

    public function definition(): array
    {
        return [
            'companies_id' => Companies::factory()->create()->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'title' => $this->faker->jobTitle(),
            'phone' => $this->faker->numerify('532#######'),
            'phone_country' => 'TR'
        ];
    }

}
