<?php

namespace App\Http\Controllers;

use App\Customer;
use App\RealEstate;
use Illuminate\Http\Request;
use \DataTables;

class RequestByCustomerController extends Controller
{
    public function getList() {
        return v('request-by-customer.list');
    }

    public function data() {
        $customer = Customer::where('user_id', auth()->user()->id)->pluck('id');
        $data   =   RealEstate::whereIn('customer_id', $customer);
        $result = Datatables::of($data)
            ->addColumn('type', function(RealEstate $item){
                return $item->reType?$item->reType->name:'';
            });

        return $result->make(true);
    }
}
