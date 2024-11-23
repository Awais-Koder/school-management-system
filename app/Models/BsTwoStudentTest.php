<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BsTwoStudentTest extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(BsTwo::class, 'roll_number', 'roll_no'); // 'roll_no' is primary key in BsTwo
    }

    public function test()
    {
        return $this->belongsTo(BsEightTest::class);
    }
}
