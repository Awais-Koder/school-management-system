<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstYearAttendance extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(FirstYear::class);
    }
}
