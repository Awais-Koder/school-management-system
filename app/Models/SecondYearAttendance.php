<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondYearAttendance extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(SecondYear::class);
    }
}
