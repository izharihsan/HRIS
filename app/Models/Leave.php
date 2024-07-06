<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'hr_leaves';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipe_cuti()
    {
        return $this->belongsTo(MasterTimeoff::class, 'leave_type_id');
    }
}
