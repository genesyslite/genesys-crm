<?php

namespace GenesysLite\GenesysCrm\Models;

use GenesysLite\GenesysUbigee\Models\Country;
use GenesysLite\GenesysUbigee\Models\Department;
use GenesysLite\GenesysUbigee\Models\District;
use GenesysLite\GenesysUbigee\Models\Province;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    protected $table = 'person_addresses';
    protected $with = [];
    public $timestamps = false;
    protected $fillable = [
        'person_id',
        'country_id',
        'department_id',
        'province_id',
        'district_id',
        'address',
        'location_id',
        'phone',
        'email',
        'main',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function setLocationIdAttribute($value)
    {
        $this->attributes['department_id'] = (count($value) === 3)?$value[0]:null;
        $this->attributes['province_id'] = (count($value) === 3)?$value[1]:null;
        $this->attributes['district_id'] = (count($value) === 3)?$value[2]:null;
    }

    public function getLocationIdAttribute()
    {
        return [
            $this->department_id,
            $this->province_id,
            $this->district_id,
        ];
    }

    public function getAddressFullAttribute()
    {
        $address = trim($this->address);
        $address = ($address === '-' || $address === '')?'':$address.' ,';
        if ($address === '') {
            return '';
        }
        return "{$address} {$this->department->description} - {$this->province->description} - {$this->district->description}";
    }
}
