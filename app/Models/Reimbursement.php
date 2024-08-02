<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;

    protected $table = 'hr_reimbursements';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }
}
