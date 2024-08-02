<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'hr_absences';

    public function overtime()
    {
        return $this->hasOne(Overtime::class, 'absence_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'id');
    }
}
