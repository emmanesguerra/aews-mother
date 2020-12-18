<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;

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
        echo 'create';
    }

    public function store() {
        echo 'store';
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
