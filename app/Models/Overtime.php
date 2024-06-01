<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $table = 'overtimes';
    protected $guarded = [];

    public function absence()
    {
        return $this->belongsTo(Absence::class, 'absence_id');
    }
}
