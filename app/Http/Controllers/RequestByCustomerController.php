<?php

namespace App\Http\Controllers;

use App\Customer;
use App\RealEstate;
use App\Scopes\PrivateScope;
use Illuminate\Http\Request;
use \DataTables;

class RequestByCustomerController extends Controller
{
    public function getList() {
        return v('request-by-customer.list');
    }

    public function data() {
        $customer = Customer::where('user_id', auth()->user()->id)->pluck('id')->toArray();
        $data   =   RealEstate::whereIn('customer_id', $customer)->withoutGlobalScope(PrivateScope::class);
        $result = Datatables::of($data)
            ->addColumn('title', function(RealEstate $item){
                return "<a href='".route('customerCare', ['id'=>$item->customer_id,'re_id' => $item->id])."'>".$item->title."</a>";
            })
            ->addColumn('type', function(RealEstate $item){
                return $item->reType?$item->reType->name:'';
            })->rawColumns(['title']);

        return $result->make(true);
    }
}
