<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\Customer;
use App\Model\PaymentHistory;
use App\Http\Requests\CustomerStore;

class CustomerController extends Controller {

    //
    public function index(Request $request) {

        $search = $request->search;
        $show = (isset($request->show)) ? $request->show: 10;
        
        if($request->has('wbalance')) {
            $customers = Customer::search($search)->wbalance()->orderBy('id', 'desc')->paginate($show);
        } else {
            $customers = Customer::search($search)->orderBy('id', 'desc')->paginate($show);
        }

        return view('customer.index', ['customers' => $customers])->withQuery($search);
    }

    public function create() {
        return view('customer.create');
    }

    public function store(CustomerStore $request) {
        
        try
        {
            DB::beginTransaction();
            
            $customer = Customer::create($request->only([
                'first_name', 
                'last_name', 
                'nick_name', 
                'contact_number', 
                'contact_address', 
                'barangay', 
                'landmark', 
                'current_balance']));
            
            DB::commit();
            
            Session::flash('status-success', 'New customer added');
            
            return redirect()->route('customer.index');
            
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('status-error', $ex->getMessage());
            return redirect()->route('customer.create')->withInput();
        }
    }

    public function show($id) {
        $customer = Customer::find($id);
        $phs = PaymentHistory::where('customer_id', $customer->id)->orderBy('id', 'desc')->paginate(10);
        
        return view('customer.show', ['customer' => $customer, 'phs' => $phs]);
    }

    public function edit($id) {
        $customer = Customer::find($id);
        
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id) {
        
        try
        {
            DB::beginTransaction();
            
            $customer = Customer::find($id);
            
            $customer->update($request->only([
                'first_name', 
                'last_name', 
                'contact_number', 
                'contact_address', 
                'barangay', 
                'landmark']));
            
            DB::commit();
            
            Session::flash('status-success', "Customer $id has been updated");
            
            return redirect()->route('customer.index');
            
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('status-error', $ex->getMessage());
            return redirect()->route('customer.edit', $id)->withInput();
        }
    }

    public function destroy($id) {
        echo 'destroy ' . $id;
    }
    
    public function pay(Request $request, $id) {
        try
        {
            DB::beginTransaction();
            
            $customer = Customer::find($id);
            
            if(empty($request->pay_amount)) {
                throw new \Exception('Payment amount cannot be empty');
            }
            if($customer->current_balance < $request->pay_amount) {
                throw new \Exception('Payment amount must be less than current balance');
            }
            
            $oldBalance = $customer->current_balance;
            $newBalance = $oldBalance - $request->pay_amount;
            $customer->current_balance = $newBalance;
            $customer->save();
            
            // update cancel tag
            $table = (new PaymentHistory())->getTable();
            DB::table($table)->where(['customer_id' => $customer->id, 'can_cancel' => 1])->update(['can_cancel' => 0]);
            
            // create payment history
            PaymentHistory::create([
                'customer_id' => $customer->id,
                'old_balance' => $oldBalance,
                'pay_amount' => $request->pay_amount,
                'new_balance' => $newBalance
            ]);
            
            DB::commit();
            
            Session::flash('status-balance-success', "New payment record has been recorded and Customer's current balance has been updated");
            
            return redirect()->route('customer.show', $id);
            
        } catch (\Exception $ex) {
            DB::rollback();
            Session::flash('status-error', $ex->getMessage());
            return redirect()->route('customer.show', $id)->withInput();
        }
    }
}
