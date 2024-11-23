<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsOneAttendance extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(BsOne::class);
    }
}
