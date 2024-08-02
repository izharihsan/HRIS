<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTimeoff extends Model
{
    use HasFactory;

    protected $table = 'hr_master_timeoffs';
    protected $guarded = [];
}
