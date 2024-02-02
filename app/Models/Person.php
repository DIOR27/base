<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Person
 *
 * @property int $id
 * @property string|null $identifier_type
 * @property string|null $identifier
 * @property string $name
 * @property string $lastname
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $zip_code
 * @property int|null $city_id
 * @property string|null $country_id
 * @property string $email
 * @property string $gender
 * @property string $marital_status
 * @property string|null $birthdate
 * @property string|null $photo
 * @property string|null $job_position
 * @property string|null $title
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereIdentifierType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereJobPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Person withoutTrashed()
 * @mixin \Eloquent
 */
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
