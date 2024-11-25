<?php

namespace Rezyon\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rezyon\Companies\Database\Factories\CompanyOfficialFactory;

class CompanyOfficials extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'first_name',
        'last_name',
        'email',
        'title',
        'phone',
        'phone_country'
    ];

    protected static function newFactory(): CompanyOfficialFactory
    {
        return CompanyOfficialFactory::new();
    }
}
