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
        'identifier_type',
        'identifier',
        'name',
        'lastname',
        'phone',
        'address',
        'zip_code',
        'city_id',
        'country_id',
        'email',
        'gender',
        'marital_status',
        'birthdate',
        'photo',
        'job_position',
        'title',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function profilePhoto()
    {
        if ($this->photo) {
            return asset('storage/profile/' . $this->photo);
        }

        return asset('images/default/default-avatar.png');
    }
}
