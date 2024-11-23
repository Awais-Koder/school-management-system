<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsOne extends Model
{
    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany(BsOneAttendance::class);
    }
    public function tests()
    {
        return $this->hasMany(BsOneStudentTest::class, 'roll_number', 'roll_no'); // Matches foreign key and primary key
    }

}
