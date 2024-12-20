<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsTwoAttendance extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(BsTwo::class);
    }
}
