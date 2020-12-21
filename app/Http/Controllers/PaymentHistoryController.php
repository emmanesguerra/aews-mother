<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\PaymentHistory;
use App\Model\Customer;

class PaymentHistoryController extends Controller
{
    //
    public function index(Request $request) {

        $search = $request->search;
        $show = (isset($request->show)) ? $request->show: 10;
        
        if($search) {
            $customers = Customer::search($search)->get('id');
            $phs = PaymentHistory::whereIn('customer_id', $customers)->notCanceled()->orderBy('id', 'desc')->paginate($show);
        } else {
            $phs = PaymentHistory::notCanceled()->orderBy('id', 'desc')->paginate($show);
        }
        
        return view('phs.index', ['phs' => $phs])->withQuery($search);
    }
    
    public function revert($id) {
        try
        {
            DB::beginTransaction();
            $ph = PaymentHistory::find($id);
            //update customer balance
            $customer = Customer::find($ph->customer_id);
            $customer->current_balance = $ph->old_balance;
            $customer->save();
            
            //update ph status
            $ph->can_cancel = 0;
            $ph->date_canceled = \Carbon\Carbon::now();
            $ph->save();         
            
            DB::commit();
            Session::flash('status-balance-success', "Payment record has been reverted back");
            return redirect()->route('customer.show', $ph->customer_id);
        } catch (Exception $ex) {
            DB::rollback();
            Session::flash('status-error', $ex->getMessage());
            return redirect()->route('customer.show', $id)->withInput();
        }
    }
}
