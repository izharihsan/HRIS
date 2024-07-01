<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTrip extends Model
{
    use HasFactory;

    protected $table = 'hr_business_trips';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }
}
