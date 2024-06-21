<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'mkr_karyawan';
    protected $guarded = [];

    public $keyType = 'string';

    public function user()
    {
        return $this->hasOne(User::class, 'karyawan_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    // handle postgre id increment when insert new data
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Employee::max('id') + 1;
        });
    }
}
