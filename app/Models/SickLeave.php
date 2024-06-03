<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SickLeave extends Model
{
    use HasFactory;

    protected $table = 'sick_leaves';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
