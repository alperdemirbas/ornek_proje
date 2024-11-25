<?php

namespace Rezyon\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'packages_id',
        'state',
        'error',
        'success',
    ];
}
