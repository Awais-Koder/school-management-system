<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsTwo extends Model
{
    protected $guarded = [];
    public function attendances()
    {
        return $this->hasMany(BsTwoAttendance::class);
    }
    public function tests()
    {
        return $this->hasMany(BsTwoStudentTest::class, 'roll_number', 'roll_no'); // Matches foreign key and primary key
    }
}
