<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('customer', 'CustomerController');
Route::post('customer/{customer}/pay', 'CustomerController@pay')->name('customer.pay');


Route::resource('payhistory', 'PaymentHistoryController');
Route::get('payhistory/{payhistory}/revert', 'PaymentHistoryController@revert')->name('payhistory.revert');


use App\Attendance;
Route::get('display-date', function () {
    echo '<table border="1" cellpadding="5">';
    $timeHandler = [];
    foreach(Attendance::limit(3)->get() as $attend) {
        $t1 = Carbon\Carbon::create(date('H:i:s', strtotime($attend->time_in)));
        $t2 = Carbon\Carbon::create(date('H:i:s', strtotime($attend->time_out)));
        $ot = $t2->diff($t1);
        $t3 = Carbon\Carbon::create(date('H:i:s', strtotime($ot->format('%H:%I'))));
        $break = Carbon\Carbon::create(date('H:i:s', strtotime("00:15")));
        $otwbreak = $t3->diff($break);
        echo '<tr>'
            . '<td>'.$attend->time_in.'</td>'
            . '<td>'.$attend->time_out.'</td>'
            . '<td>'.$otwbreak->format('%H:%I').'</td>'
            . '</tr>';
        
        array_push($timeHandler, $otwbreak->format('%H:%I'));
    }
    echo '</table>';
    
    $sum = strtotime('00:00:00');
    $totaltime = 0;
    foreach( $timeHandler as $element ) {

        // Converting the time into seconds
        $timeinsec = strtotime($element) - $sum;

        // Sum the time with previous value
        $totaltime = $totaltime + $timeinsec;
    }
    
    // Totaltime is the summation of all
    // time in seconds

    // Hours is obtained by dividing
    // totaltime with 3600
    $h = intval($totaltime / 3600);

    $totaltime = $totaltime - ($h * 3600);

    // Minutes is obtained by dividing
    // remaining total time with 60
    $m = intval($totaltime / 60);

    // Remaining value is seconds
    $s = $totaltime - ($m * 60);

    // Printing the result
    echo ("$h:$m:$s");
});