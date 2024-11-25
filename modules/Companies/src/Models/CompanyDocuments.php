<?php

namespace Rezyon\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDocuments extends Model
{
    use HasFactory;
    protected $fillable = [
      'companies_id',
      'name',
      'ext'
    ];
}
