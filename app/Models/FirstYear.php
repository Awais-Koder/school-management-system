<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstYear extends Model
{
    protected $guarded = [];
    public function attendances()
    {
        return $this->hasMany(FirstYearAttendance::class);
    }
    public function tests()
    {
        return $this->hasMany(FirstYearTest::class, 'roll_number', 'roll_no'); // Matches foreign key and primary key
    }
}
