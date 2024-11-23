<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondYearStudentTest extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(SecondYear::class, 'roll_number', 'roll_no'); // 'roll_no' is primary key in BsOne
    }

    public function test()
    {
        return $this->belongsTo(SecondYearTest::class);
    }
}
