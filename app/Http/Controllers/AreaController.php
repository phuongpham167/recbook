<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\CreateAreaRequest;
use App\Province;
use App\Street;
use App\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getArea()
    {
        $data1 = Province::orderBy('order','ASC')->get();
        $data2  =   (object)[];
        $data3  =   (object)[];
        $data4  =   (object)[];
        if(!empty(\request('province_id')))
            $data2 = District::where('province_id',\request('province_id'))->orderBy('order','ASC')->get();

        if(!empty(\request('province_id'))) {
            if(!empty(\request('district_id')))
                $data3 = Ward::where('province_id',\request('province_id'))->where('district_id',\request('district_id'))->orderBy('order','ASC')->get();
        }

        if(!empty(\request('province_id'))) {
            if(!empty(\request('district_id'))) {
                if(!empty(\request('ward_id')))
                    $data4 = Street::where('province_id',\request('province_id'))->where('district_id',\request('district_id'))->where('ward_id',\request('ward_id'))->orderBy('name','ASC')->get();
            }
        }

        return v('pages.area',compact('data1','data2','data3','data4'));
    }

    public function postArea(CreateAreaRequest $request)
    {
        if(!empty($request->province_input)) {
            $data = new Province();

            $data->name = $request->province_input;
            $data->created_at = Carbon::now();
            $data->save();

            set_notice(trans('system.add_success'), 'success');
            return redirect()->back();
        }
        if(!empty($request->district_input)) {
            if(!empty(request('province_id'))) {
                $data = new District();

                $data->name = $request->district_input;
                $data->province_id = request('province_id');
                $data->created_at = Carbon::now();
                $data->save();

                set_notice(trans('system.add_success'), 'success');
                return redirect()->back();
            }
        }
        if(!empty($request->ward_input)) {
            if(!empty(request('province_id'))) {
                if(!empty(request('district_id'))) {
                    $data = new Ward();

                    $data->name = $request->ward_input;
                    $data->province_id = request('province_id');
                    $data->district_id = request('district_id');
                    $data->created_at = Carbon::now();
                    $data->save();

                    set_notice(trans('system.add_success'), 'success');
                    return redirect()->back();
                }
            }
        }
        if(!empty($request->street_input)) {
            if(!empty(request('province_id'))) {
                if(!empty(request('district_id'))) {
                    if(!empty(request('ward_id'))) {
                        $data = new Street();

                        $data->name = $request->street_input;
                        $data->province_id = request('province_id');
                        $data->district_id = request('district_id');
                        $data->ward_id = request('ward_id');
                        $data->created_at = Carbon::now();
                        $data->save();

                        set_notice(trans('system.add_success'), 'success');
                        return redirect()->back();
                    }
                }
            }
        }
        set_notice(trans('system.add_fail'), 'danger');
        return redirect()->back();
    }

    public function update() {
        $id = request('id');
        $type = \request('type');
        $order = \request('order');

        if($type == 'province'){
            $data   =   Province::find($id);
            $data->order   =   $order;
        }
        elseif($type == 'district'){
            $data   =   District::find($id);
            $data->order   =   $order;
        }
        elseif($type == 'ward'){
            $data   =   Ward::find($id);
            $data->order   =   $order;
        }elseif($type == 'street'){
            $data   =   Street::find($id);
            $data->order   =   $order;
        }
        $data->save();

        set_notice(trans('system.edit_success'), 'success');
        return redirect()->back();
    }
    public function searchArea()
    {
        if(!empty($id = request('province_id'))){
            $data   =   new District();
            $data   =   $data->where('province_id', $id);
        }
        elseif(!empty($id = request('district_id'))){
            $data   =   new Ward();
            $data   =   $data->where('district_id', $id);
        }
        elseif(!empty($id = request('ward_id'))){
            $data   =   new Street();
            $data   =   $data->where('ward_id', $id);
        }
        $data   =   $data->get();
        $result =   [];
        foreach($data as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return response()->json($result);
    }
    public function list_province_token(){
        $string = request('term');
        $data = Province::where('name', 'LIKE', '%'.$string.'%')->select('id', 'name')->get();
        $result =   [];
        foreach($data as $item){
            $result[]   =   [
                'id'    =>  $item->id,
                'name'  =>  $item->name
            ];
        }
        return $result;
    }
}
