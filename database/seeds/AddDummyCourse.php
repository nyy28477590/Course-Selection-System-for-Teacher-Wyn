<?php

use Illuminate\Database\Seeder;
use App\Teacher;

class AddDummyCourse extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
                't_date'=>'2020-10-01', 
                't_time'=>'09:00:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-01', 
            't_time'=>'09:30:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-01', 
            't_time'=>'10:00:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-01', 
            't_time'=>'10:30:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-02', 
            't_time'=>'19:00:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-02', 
            't_time'=>'19:30:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-02', 
            't_time'=>'20:00:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-02', 
            't_time'=>'20:30:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-03', 
            't_time'=>'21:00:00',
        ]);

        Teacher::create([
            't_date'=>'2020-10-03', 
            't_time'=>'21:30:00',
        ]);
    }
}
