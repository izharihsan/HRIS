<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'hr_permissions';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
