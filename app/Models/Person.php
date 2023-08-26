<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'identifier_type_id',
        'identifier',
        'name',
        'lastname',
        'phone',
        'address',
        'zip_code',
        'city',
        'state',
        'country',
        'email',
        'gender',
        'marital_status',
        'birthdate',
        'photo',
        'job_position',
        'title',
        'company_id',
    ];

    public function identifierType()
    {
        return $this->belongsTo(IdentifierType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
