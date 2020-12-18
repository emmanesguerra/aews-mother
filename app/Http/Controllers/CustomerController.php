<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\Customer;
use App\Http\Requests\CustomerStore;

class CustomerController extends Controller {

    //
    public function index(Request $request) {

        $search = $request->search;
        $show = (isset($request->show)) ? $request->show: 10;
        
        if($request->has('wbalance')) {
            $customers = Customer::search($search)->wbalance()->paginate($show);
        } else {
            $customers = Customer::search($search)->paginate($show);
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
            Session::flash('status-success', $ex->getMessage());
            return redirect()->route('customer.create');
        }
    }

    public function show($id) {
        echo 'show ' . $id;
    }

    public function edit($id) {
        echo 'edit ' . $id;
    }

    public function update($id) {
        echo 'update ' . $id;
    }

    public function destroy($id) {
        echo 'destroy ' . $id;
    }

}
