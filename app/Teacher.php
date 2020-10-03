<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['t_date', 't_time'];

    public function freeCourse()
    {
        return Teacher::where('booked', '=', 0)->get();
    }
}
