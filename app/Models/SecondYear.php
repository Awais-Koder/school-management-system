<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondYear extends Model
{
    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany(SecondYearAttendance::class);
    }
    public function tests()
    {
        return $this->hasMany(SecondYearTest::class, 'roll_number', 'roll_no'); // Matches foreign key and primary key
    }
}
