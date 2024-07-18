<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'hr_schedules';
    public $timestamps = false;

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function users()
    {
        return $this->user_ids ? User::whereIn('id', explode(',', $this->user_ids))->get() : [];
    }

    public function getUsersAttribute()
    {
        return $this->users();
    }
}
