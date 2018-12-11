<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RangePriceService;
use App\RangePrice;

class RangePriceController extends Controller
{
    protected $service;

    public function __construct(RangePriceService $rangePriceService)
    {
        $this->service = $rangePriceService;
    }

    public function list()
    {
        $data = $this->service->getList();
        \Log::info($data);
        return v('re-range-price.list');
    }

    public function data()
    {
        $data = $this->service->getList();

        $result = Datatables::of($data)
            ->addColumn('manage', function($dt) {
                return a('range-price/delete', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                        "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('range-price/delete?id='.$dt->id)."')}})").'  '.a('range-price/edit',
                        'id='.$dt->id,trans('g.edit'), ['class'=>'btn btn-xs btn-default']);
            })->rawColumns(['manage']);

        return $result->make(true);
    }

    public function getListDropDown($catId)
    {
        $result = $this->service->getListDropDown($catId);
        return response()->json($result);
    }

    public function create()
    {
        return v('re-range-price.create');
    }

    public function store()
    {
        $input = request()->all();
        $result = $this->service->store($input);
        if($result) {
            set_notice(trans('re-category.message.createSuccess'), 'success');
            return redirect()->back();
        } else {
            set_notice(trans('re-category.message.error'), 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit()
    {
        $data = RangePrice::find(request('id'));
        return v('re-range-price.edit', compact('data'));
    }

    public function update()
    {

    }

    public function getDelete()
    {
        $id = request('id');
        if ($id) {
            $rangePrice = RangePrice::find($id);
            if ($rangePrice) {
                $result = $rangePrice->delete();
                set_notice(trans('re-category.message.deleteSuccess'), 'success');
                return redirect()->back();
            }
        }
        set_notice(trans('re-category.message.error'), 'error');
        return redirect()->back();
    }
}
