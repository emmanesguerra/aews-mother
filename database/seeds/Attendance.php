<?php

use Illuminate\Database\Seeder;

use App\Attendance as aModel;

class Attendance extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        aModel::truncate();
        
        $date = date('F Y');//Current Month Year
        while (strtotime($date) <= strtotime(date('Y-m') . '-' . date('t', strtotime($date)))) {
            $attendance = new aModel();
            $attendance->date = date('Y-m-d', strtotime($date));
            $time = Carbon\Carbon::create(date('H:i:s', rand(1,18000)));
            $attendance->time_in = $time->format('H:i:00');
            $attendance->time_out = $time->addSeconds(rand(1,18000))->format('H:i:00');
            $attendance->save();
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
    }
}
