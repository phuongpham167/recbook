@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('real-estate.edit.pageTitle')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/manage-real-estate.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/loopj-jquery-tokeninput/styles/token-input-bootstrap3.css')}}" />
    <style>
        .text-red {
            color: red;
        }
    </style>
@endpush

<?php
$user = \Auth::user();
//    dd($user);
$adminGroup = config('res-filemanager.admin_group');
if ($user->group_id != $adminGroup) {
    if (! File::exists(public_path()."/storage/uploads/user".$user->id)) {
        File::makeDirectory(public_path()."/storage/uploads/user".$user->id, $mode=0766, true, true);
    }
    session_start();
    $_SESSION["RF"]["subfolder"] = "user".$user->id;
}

?>

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container">
        <div class="row subpage">
            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <div class="col-xs-9 right">
                @if (!empty(session('message')))
                    <div class="alert alert-{{session('message.type')}} text-center">
                        {{session('message.message')}}
                    </div>
                @endif
                @if (!empty($errors) && count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                    <a type="button" href="#a" class="_btn bg_red pull-right btn-hotvip" id="{{$realEstate->id}}" hot="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->hot_value)}}"
                       hot_hl="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->hot_highlight_value)}}"
                       vip="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->vip_value)}}"
                       vip_hl="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->vip_highlight_value)}}"
                       i_value="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->interesting_value)}}"
                       vip_right="{{number_format(\App\HotVip::where('province_id', $realEstate->province_id)->first()->vip_right_value)}}" style="background-color: green"><i class="fa fa-arrow-up" ></i> &nbsp;&nbsp;UP VIP</a>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.title')}} <span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{ $realEstate->title }}"/>
                        </div>
                    </div>
                    <div class="form-group hidden">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.shortDescription')}} </label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="short-description" name="short_description" maxlength="150" value="{{ $realEstate->short_description }}"/>
                            <span class="help-block"><span id="count-short-des">{{ 150 - mb_strlen($realEstate->short_description) }}</span>{{trans('real-estate.formCreateLabel.shortDescriptionHelpBlock')}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPhone')}} </label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact_phone_number" name="contact_phone_number" value="{{ $realEstate->contact_phone_number }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactPerson')}} </label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $realEstate->contact_person }}" />
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.contactAddress')}} </label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{ $realEstate->contact_address }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reCategory')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="re-category" name="re_category_id" onchange="changeReCategory(this)" value="{{ $realEstate->re_category_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($reCategories as $reCategory)
                                    <option value="{{$reCategory->id}}" {{ $reCategory->id == $realEstate->re_category_id ? 'selected' : '' }}>{{$reCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.reType')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="loai-bds" name="loai_bds" value="{{ $realEstate->loai_bds }}" onChange="changeLoaiBDS(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                <option value="1" {{ $realEstate->loai_bds == 1 ? 'selected' : '' }}>Thổ cư</option>
                                <option value="2" {{ $realEstate->loai_bds == 2 ? 'selected' : '' }}>Dự án</option>
                            </select>
                        </div>
                        <div class="row" >
                            <div class="col-xs-12 {{ (!$realEstate->loai_bds || ($realEstate->loai_bds && $realEstate->loai_bds == 2)) ? 'hidden' : ''}}" id="thocu-select-wrap" style="margin-top: 20px;">
                                <label class="col-sm-2 control-label">Thổ cư</label>
                                <div class="col-sm-4" id="thocu-select">
                                    @if($realEstate->loai_bds && $realEstate->loai_bds == 1)
                                        <select class="form-control" name="re_type_id" value="{{$realEstate->re_type_id}}">
                                            @foreach($reTypes as $reType)
                                                <option value="{{$reType->id}}" {{ $realEstate->re_type_id == $reType->id ? 'selected' : '' }}>{{$reType->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 {{(!$realEstate->loai_bds || ($realEstate->loai_bds && $realEstate->loai_bds == 1)) ? 'hidden' : ''}}" id="duan-select-wrap" style="margin-top: 20px;">
                                <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}}</label>
                                <div class="col-sm-4" id="duan-select">
                                    @if($realEstate->loai_bds && $realEstate->loai_bds == 2)
                                        <select class="form-control" name="project_id" value="{{$realEstate->project_id}}">
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}" {{$realEstate->project_id == $project->id ? 'selected' : ''}}>{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.province')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="province" name="province_id" onchange="changeProvince(this)" value="{{ $realEstate->province_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}" {{$province->id == $realEstate->province_id ? 'selected' : ''}}>{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.district')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="district" name="district_id" onchange="changeDistrict(this)" value="{{ $realEstate->district_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}" {{$district->id == $realEstate->district_id ? 'selected' : ''}}>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.ward')}} </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="ward" name="ward_id" value="{{ $realEstate->ward_id }}" onchange="changeWard(this)">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($wards as $ward)
                                    <option value="{{$ward->id}}" {{$ward->id == $realEstate->ward_id ? 'selected' : ''}}>{{$ward->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.street')}} </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="street_id" id="street" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.address')}} </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" value="{{ $realEstate->address }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.direction')}} </label>
                        <div class="col-sm-2">
                            <select class="form-control" id="direction" name="direction_id" value="{{ $realEstate->direction_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($directions as $direction)
                                    <option value="{{$direction->id}}" {{$direction->id === $realEstate->direction_id ? 'selected' : ''}}>{{$direction->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.exhibit')}} </label>
                        <div class="col-sm-2">
                            <select class="form-control" id="exhibit" name="exhibit_id" value="{{ $realEstate->exhibit_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($exhibits as $exhibit)
                                    <option value="{{$exhibit->id}}" {{$exhibit->id === $realEstate->exhibit_id ? 'selected' : ''}}>{{$exhibit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.project')}} </label>
                        <div class="col-sm-2">
                            <select class="form-control" id="project" name="project_id" value="{{ $realEstate->project_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}" {{$project->id === $realEstate->project_id ? 'selected' : ''}}>{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.block')}}</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="block" name="block_id" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.constructionType')}}</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="construction-type" name="construction_type_id" value="{{ $realEstate->construction_type_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($constructionTypes as $constructionType)
                                    <option value="{{$constructionType->id}}" {{$constructionType->id === $realEstate->construction_type_id ? 'selected' : ''}}>{{$constructionType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.width')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="width" value="{{ $realEstate->width }}"/>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.length')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="length" value="{{ $realEstate->length }}"/>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.lane_width')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="width_lane" value="{{ $realEstate->width_lane }}" step="0.01"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.bedroom')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="bedroom" value="{{ $realEstate->bedroom }}"/>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.living_room')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="living_room" value="{{ $realEstate->living_room }}"/>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.wc')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="wc" value="{{ $realEstate->wc }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfPremises')}} </label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="area_of_premises" value="{{ $realEstate->area_of_premises }}"/>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.areaOfUse')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="area_of_use" value="{{ $realEstate->area_of_use }}"/>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.floor')}}</label>

                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="floor" value="{{ $realEstate->floor }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.price')}}</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="price" value="{{ $realEstate->price }}"/>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.unit')}}</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="unit" name="unit_id" value="{{ $realEstate->unit_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}" {{$unit->id === $realEstate->unit_id ? 'selected' : ''}}>{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.rangePrice')}}</label>
                        <div class="col-sm-2">
                            <select class="form-control" id="range-price" name="range_price_id" value="{{ $realEstate->range_price_id }}">
                                <option value="">{{trans('real-estate.selectFirstOpt')}}</option>
                                @foreach($rangePrices as $rangePrice)
                                    <option value="{{$rangePrice->id}}" {{$rangePrice->id === $realEstate->range_price_id ? 'selected' : ''}}>{{$rangePrice->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.don_vi')}}</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="don_vi" value="{{ $realEstate->don_vi }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_deal" {{ $realEstate->is_deal === 1 ? 'checked' : '' }}>
                                    {{trans('real-estate.formCreateLabel.isDeal')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="gara" {{ $realEstate->gara === 1 ? 'checked' : '' }}>
                                    {{trans('real-estate.formCreateLabel.gara')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.postDate')}} </label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='post-date'>
                                <input type='text' class="form-control" name="post_date" value="{{ $realEstate->post_date }}" {{ $realEstate->approved ? 'disabled' : ''}}/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.expireDate')}}</label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='expire-date'>
                                <input type='text' class="form-control" name="expire_date" value="{{ $realEstate->expire_date }}" {{ $realEstate->approved ? 'disabled' : ''}}/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.image')}}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn btn-primary" type="button" id="choose-image">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="images" class="form-control" name="imagesList" type="hidden" value="" readonly>
                            </div>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2 img-preview">
                            @php
                                $images = json_decode($realEstate->images);
                            @endphp
                            @foreach($images as $image)
                                <div class="col-xs-3 item-img-preview">
                                    <img src="{{$image->link}}" class="img-responsive"/>
                                    <div class=""><input type="hidden" name="images[]" value="{{$image->link}}" class="form-control" />
                                        <label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>
                                        <input type="text" name="alt[]" class="form-control" value="{{$image->alt}}" />
                                    </div>
                                    <a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.map')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="map" id="map" value="{{ ($realEstate->lat && $realEstate->long) ? $realEstate->lat . ', ' . $realEstate->long : '' }}" readonly/>
                            <span class="help-block"><i>{{trans('real-estate.formCreateLabel.mapHelpBlock')}}</i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div id="map-view" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.detail')}} <span class="text-red">*</span> </label>
                        <div class="col-sm-10">
                            <textarea name="detail" class="form-control autoExpand" id="editor">{!! strip_tags($realEstate->detail) !!}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{trans('real-estate.formCreateLabel.isPrivate')}}</label>

                        <div class="col-sm-2">
                            <select class="form-control" id="is-private" name="is_private" value="{{$realEstate->is_private}}">
                                <option value="1" {{$realEstate->is_private == 1 ? 'selected' : ''}}>{{ trans('real-estate.isPrivateSelectText.public') }}</option>
                                <option value="2" {{$realEstate->is_private == 2 ? 'selected' : ''}}>{{ trans('real-estate.isPrivateSelectText.private') }}</option>
                                <option value="3" {{$realEstate->is_private == 3 ? 'selected' : ''}}>{{ trans('real-estate.isPrivateSelectText.privateInOwnWebsite') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" name="add_new" class="_btn bg_red"><i class="fa fa-plus"></i> &nbsp;&nbsp;ĐĂNG TIN</button>
                            {{--<button type="submit" name="add_draft" value="1" class="_btn bg_black"><i class="fa fa-plus"></i> &nbsp;&nbsp;LƯU TIN</button>--}}
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
                {{-- modal select image --}}
                <div class="modal fade" id="myModal" style="opacity: 1; overflow: visible; display: none;" aria-hidden="true">
                    <div class="modal-dialog" style="width: 860px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Chọn ảnh</h4>
                            </div>
                            <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
                                <iframe width="100%" height="400" src="/plugins/filemanager/dialog.php?type=2&amp;field_id=images'&amp;fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{asset('bat-dong-san/sethotvip')}}">
        {{csrf_field()}}
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nâng cấp hot/vip</h4>
                    </div>
                    <div class="modal-body">
                        <input type='hidden' name='id' id="id-re2" value="">
                        <label class="control-label">Chọn loại vip/hot</label>
                        <select class="form-control" name='vip_type' id='vip_type'>
                            @foreach(vip_type() as $k=>$item)
                                <option value='{{$k}}'>{{$item}}</option>
                            @endforeach
                        </select>
                        <label class="control-label">Chọn số ngày gia hạn</label>
                        <select class="form-control" name='vip_time' id='vip_time'>
                            <option value='1'>1 ngày</option>
                            <option value='7'>7 ngày</option>
                            <option value='30'>30 ngày</option>
                            <option value='90'>90 ngày</option>
                        </select>
                        <table class="table table-bordered" id="datatable-price">
                            <thead>
                            <tr>
                                @foreach(vip_type() as $k=>$item)
                                    <th>{{$item}}</th>
                                @endforeach
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="_btn bg_red pull-right"><i
                                    class="fa fa-plus"></i> &nbsp;&nbsp;NÂNG CẤP
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/ckeditor-4/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            let loaiBDS = $(e).val();

            if (loaiBDS == 1) {
                $.ajax({
                    url: "/re-type/list-dropdown",
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '<select class="form-control" name="re_type_id">';
                        if (result) {
                            html += '<option value="">--Chọn loại thổ cư--</option>';
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#thocu-select-wrap').removeClass('hidden');
                            $('#thocu-select').html(html);
                        }
                    }
                });
            } else if (loaiBDS == 2) {
                let provinceId = $('#province').val();
                if (!provinceId) {
                    provinceId = '{{auth()->user()->userinfo->province_id}}';
                }
                provinceId = parseInt(provinceId);
                $.ajax({
                    url: '/project-by-province/' + provinceId,
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '' +
                            '<select class="form-control" name="project_id">';
                        if (result) {
                            html += '<option value="">--Chọn dự án--</option>';
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#duan-select-wrap').removeClass('hidden');
                            $('#duan-select').html(html);
                        }
                    }
                });
            }
        });

        function initMap() {
            let uLat = '{{auth()->user()->userinfo->province->lat}}';
            let uLong = '{{auth()->user()->userinfo->province->long}}';
            var myLatLng = {lat: parseFloat(uLat), lng: parseFloat(uLong)};
            let rLat = '{{$realEstate->lat}}';
            let rLong = '{{$realEstate->long}}';
            if (rLat && rLong) {
                myLatLng = {lat: parseFloat(rLat), lng: parseFloat(rLong)};
            }

            var map = new google.maps.Map(document.getElementById('map-view'), {
                zoom: 11,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable:true,
                title: 'Hello World!'
            });
            // marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent);
        }
        function handleEvent(event) {
            // console.log(event.latLng.lat());
            // console.log(event.latLng.lng());
            $('#map').val(event.latLng.lat() + ',' + event.latLng.lng());
        }

        $(document)
            .one('focus.autoExpand', 'textarea.autoExpand', function () {
                var savedValue = this.value;
                this.value = '';
                this.baseScrollHeight = this.scrollHeight;
                this.value = savedValue;
            })
            .on('input.autoExpand', 'textarea.autoExpand', function () {
                var minRows = this.getAttribute('data-min-rows') | 0, rows;
                this.rows = minRows;
                rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
                this.rows = minRows + rows;
            });

        $(function() {
            $('#contact_phone_number').keyup(function() {
                emptyContactInfo();

                let phone = $(this).val();
                if (phone.length > 9) {
                    $.ajax({
                        url: "/customer-by-phone/" + phone,
                        method: 'GET',
                        success: function (result) {
                            console.log('success');
                            console.log(result);
                            if (!jQuery.isEmptyObject(result)) {
                                $('#contact_person').val(result.name).prop('readonly', true);
                                $('#contact_address').val(result.address).prop('readonly', true);
                            } else {
                                emptyContactInfo();
                            }
                        }
                    });
                }
            });

            // init datetime picker
            $('#post-date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#expire-date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $("#post-date").on("dp.change", function (e) {
                $('#expire-date').data("DateTimePicker").minDate(e.date);
            });
            $("#expire-date").on("dp.change", function (e) {
                $('#post-date').data("DateTimePicker").maxDate(e.date);
            });

            // var options = {
            //     filebrowserBrowseUrl : '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserUploadUrl : '/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            //     filebrowserImageBrowseUrl : '/plugins/filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            // };
            // CKEDITOR.replace('editor', options);

            let totalShortDesLetter = 150;
            $('#short-description').keyup(function() {
                let txtLength = $(this).val().length;
                $('#count-short-des').text(totalShortDesLetter - txtLength);
            });
        });

        function changeReCategory(e) {
            console.log($(e).val());
            let catId = $(e).val();

            $.ajax({
                url: '/re-type/list-dropdown/' + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#re-type').html(html);
                    }
                }
            });

            $.ajax({
                url: '/range-price/list-dropdown/' + catId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    $('#range-price').html(html);
                }
            });
        }

        function changeLoaiBDS(e) {
            if ( !$('#thocu-select-wrap').hasClass('hidden') ) {
                $('#thocu-select-wrap').addClass('hidden');
            }
            $('#thocu-select').html('');

            if ( !$('#duan-select-wrap').hasClass('hidden') ) {
                $('#duan-select-wrap').addClass('hidden');
            }
            $('#duan-select').html('');

            console.log($(e).val());
            let loaiBDS = $(e).val();

            if (loaiBDS == 1) {
                $.ajax({
                    url: "/re-type/list-dropdown",
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '<select class="form-control" name="re_type_id">';
                        if (result) {
                            html += '<option value="">--Chọn loại thổ cư--</option>';
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#thocu-select-wrap').removeClass('hidden');
                            $('#thocu-select').html(html);
                        }
                    }
                });
            } else if (loaiBDS == 2) {
                let provinceId = $('#province').val();
                if (!provinceId) {
                    provinceId = '{{auth()->user()->userinfo->province_id}}';
                }
                provinceId = parseInt(provinceId);
                $.ajax({
                    url: '/project-by-province/' + provinceId,
                    method: 'GET',
                    success: function (result) {
                        console.log('success');
                        console.log(result);
                        let html = '' +
                            '<select class="form-control" name="project_id">';
                        if (result) {
                            html += '<option value="">--Chọn dự án--</option>';
                            for (let r of result) {
                                html += '<option value="' + r.id + '">' + r.name + '</option>';
                            }
                        }
                        html += '</select>';
                        if (html) {
                            $('#duan-select-wrap').removeClass('hidden');
                            $('#duan-select').html(html);
                        }
                    }
                });
            }
        }

        function changeProvince(e) {
            console.log($(e).val());
            let provinceId = $(e).val();

            $.ajax({
                url: '/district-by-province/' + provinceId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#district').html(html);
                    }
                }
            });

            $.ajax({
                url: '/project-by-province/' + provinceId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#project').html(html);
                    }
                }
            });
        }

        function changeDistrict(e) {
            console.log($(e).val());
            let districtId = $(e).val();

            $.ajax({
                url: '/ward-by-district/' + districtId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '<option value="">{{trans('real-estate.selectFirstOpt')}}</option>';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#ward').html(html);
                    }
                }
            });
        }
        function changeWard(e) {
            console.log($(e).val());
            let wardId = $(e).val();

            $.ajax({
                url: '/street-by-ward/' + wardId,
                method: 'GET',
                success: function (result) {
                    console.log('success');
                    console.log(result);
                    let html = '';
                    if (result) {
                        for (let r of result) {
                            html += '<option value="'+ r.id +'">' + r.name + '</option>';
                        }
                    }
                    if (html) {
                        $('#street').html(html);
                    }
                }
            });
        }
        function responsive_filemanager_callback(field_id){
            console.log(field_id);
            var url=jQuery('#'+field_id).val();
            console.log(url);
            var splitImages = url.split(',');
            var isMultiImages = splitImages.length > 1 ? true : false;
            var resultImages = null;
            if (isMultiImages) {
                for (var i= 0, len = splitImages.length; i < len; i++) {
                    let tmp = '';
                    if (i === 0) {
                        tmp = splitImages[i].substr(2, splitImages[i].length - 3);
                    }
                    else if (i === len - 1) {
                        tmp = splitImages[i].substr(1, splitImages[i].length - 3);
                    }
                    else {
                        tmp = splitImages[i].substr(1, splitImages[i].length - 2);
                    }
                    tmp = removeRootUrl(tmp);
                    if (i !== len - 1) {
                        if (resultImages) {
                            resultImages = resultImages + tmp + ',';
                        } else {
                            resultImages = tmp + ',';
                        }
                    } else {
                        resultImages += tmp;
                    }
                }
            } else {
                let tmp = url;
                resultImages = removeRootUrl(tmp);
            }
            console.log('result images');
            console.log(resultImages);
            jQuery('#'+field_id).val(resultImages);

            // handle show preview img and input alt text
            let arrImgLinks = resultImages.split(',');
            var root = location.protocol + '//' + location.host;
            /*
            * 12-07-2018
            * change here - save image with absolute path
            * */
            console.log('arr img');
            console.log(arrImgLinks);
            // empty html before append new image
            $('.img-preview').html('');
            for (let imgLink of arrImgLinks) {
                let htmlMarkup = '<div class="col-xs-3 item-img-preview"><img src="' + root + imgLink + '" class="img-responsive"/>'
                    + '<div class=""><input type="hidden" name="images[]" value="' + root + imgLink +'" class="form-control" />'
                    +'<label>{{ trans("real-estate.formCreateLabel.alt-text") }}</label>'
                    +'<input type="text" name="alt[]" class="form-control" /></div>'
                    +'<a class="img-preview-btn-remove" onclick="removeImgPreview(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    +'</div>';

                $('.img-preview').append(htmlMarkup);
            }
        }
        function removeRootUrl(str) {
            let indexC = str.indexOf('/', 8);
            str = str.substr(indexC);
            return str;
        }

        // remove img preview
        function removeImgPreview(e){
            console.log(e);
            $(e).closest('.item-img-preview').remove();
        }

        function emptyContactInfo() {
            if ($('#contact_person').prop('readonly')) {
                $('#contact_person').val('').prop('readonly', false);
            }
            if ($('#contact_address').prop('readonly')) {
                $('#contact_address').val('').prop('readonly', false);
            }
        }

        $('#street').tokenInput(function(){
            return "{{asset('/ajax/street')}}?province_id="+$("#province").val()+"&district_id="+$("#district").val()+"&ward_id="+$("#ward").val();
        }, {
            theme: "bootstrap",
            queryParam: "term",
            zindex  :   1005,
            tokenLimit  :   1,
            onAdd   :   function(r){
                $('#method').val(r.method);
            },
            @if(!empty($realEstate->street_id) && !empty(\App\Street::find($realEstate->street_id)))
            prePopulate: [
                {id: '{{$realEstate->street_id}}', name: '{{\App\Street::find($realEstate->street_id)->name}}'}
            ]
            @endif
        });
        $('#block').tokenInput(function(){
            return "{{asset('/ajax/block')}}";
        }, {
            theme: "bootstrap",
            queryParam: "term",
            zindex  :   1005,
            tokenLimit  :   1,
            onAdd   :   function(r){
                $('#method').val(r.method);
            },
            @if(!empty($realEstate->block_id) && !empty(\App\Block::find($realEstate->block_id)))
            prePopulate: [
                {id: '{{$realEstate->block_id}}', name: '{{\App\Block::find($realEstate->block_id)->name}}'}
            ]
            @endif
        });
        $('.btn-hotvip').on('click', function(){
            var id      =   $(this).attr('id');
            var hot      =   $(this).attr('hot');
            var hot_hl      =   $(this).attr('hot_hl');
            var vip      =   $(this).attr('vip');
            var vip_hl      =   $(this).attr('vip_hl');
            var i_value      =   $(this).attr('i_value');
            var vip_right      =   $(this).attr('vip_right');

            $('#id-re2').val(id);
            $('.price').remove();
            $('#datatable-price').append('<tr class="price">\n' +
                '                                <td>'+vip+'</td>\n' +
                '                                <td>'+vip_hl+'</td>\n' +
                '                                <td>'+hot+'</td>\n' +
                '                                <td>'+hot_hl+'</td>\n' +
                '                                <td>'+i_value+'</td>\n' +
                '                                <td>'+vip_right+'</td>\n' +
                '                            </tr>');
            $('#myModal2').modal('show');
        });
    </script>
    <script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAxgnRkMsWPSqlxOz_kLga0hJ4eG2l0Vmo&callback=initMap'></script>
@endpush
