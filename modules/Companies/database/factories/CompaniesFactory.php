<?php

namespace  Rezyon\Companies\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Rezyon\Companies\Enums\CompanyTypeEnums;
use Rezyon\Companies\Models\Companies;

class CompaniesFactory extends Factory
{

    protected $model = Companies::class;
    public function definition(): array
    {
        $bool = $this->faker->boolean();
        $verifyAt = ( $bool ) ? Carbon::now() : null;
        return [
            'name' =>  $this->faker->company,
            'domain' => $this->faker->domainWord,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->numerify('532#######'),
            'phone_country' => 'TR',
            'is_active' => $bool,
            'address' => $this->faker->address,
            'description' => null,
            'verify_at' => $verifyAt,
            'type' => $this->faker->randomElement( CompanyTypeEnums::values())
        ];
    }

}
