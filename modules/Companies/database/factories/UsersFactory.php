<?php

namespace Rezyon\Companies\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Rezyon\Companies\Models\Companies;
use Rezyon\Companies\Models\Users;
use Rezyon\Users\Enums\Types;

class UsersFactory extends \Rezyon\Users\Database\Factories\UsersFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Users::class;

}
