<?php

namespace App\Http\Controllers;

use App\ReType;
use Illuminate\Http\Request;
use App\Services\ReTypeService;
use \DataTables;

class ReTypeController extends Controller
{
    protected $service;

    public function __construct(ReTypeService $reTypeService)
    {
        $this->service = $reTypeService;
    }

    public function list()
    {
        $data = $this->service->getList();
        \Log::info($data);
        return v('re-type.list');
    }

    public function data()
    {
        $data = $this->service->getList();

        $result = Datatables::of($data)
            ->addColumn('manage', function($dt) {
                return a('re-type/delete', 'id='.$dt->id,trans('g.delete'), ['class'=>'btn btn-xs btn-danger'],'#',
                        "return bootbox.confirm('".trans('system.delete_confirm')."', function(result){if(result==true){window.location.replace('".asset('re-type/delete?id='.$dt->id)."')}})").'  '.a('re-type/edit',
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
        return v('re-type.create');
    }

    public function store()
    {
        $input = request()->all();
//        dd($input);
        $result = $this->service->store($input);
        if($result) {
            set_notice(trans('re-type.message.createSuccess'), 'success');
            return redirect()->back();
        } else {
            set_notice(trans('re-type.message.error'), 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit()
    {
        $data = ReType::find(request('id'));
        return v('re-type.edit', compact('data'));
    }

    public function update()
    {
        $input = request()->all();

        $result = $this->service->update($input);
        if($result) {
            set_notice(trans('re-type.message.updateSuccess'), 'success');
            return redirect()->back();
        } else {
            set_notice(trans('re-type.message.error'), 'error');
            return redirect()->back()->withInput();
        }
    }
}
