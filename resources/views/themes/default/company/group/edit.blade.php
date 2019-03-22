@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('company.group.edit')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
    <style type="text/css">
        /*.form-inline .form-group {*/
        /*margin-bottom: 10px !important;*/
        /*margin-top: 10px;*/
        /*}*/
        .help-block {display: none; font-size: 11px; font-style: italic}
        .has-error .help-block {display: block}
    </style>
    <link rel="stylesheet" href="{{asset('plugins/jquery.tokenInput/token-input.css')}}" />
@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header')
    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <div class="col-md-9 right">
                @include(theme(TRUE).'.includes.company_customer_manager_tabs', ['company_id'=>$group->company_id])
                @include('themes.default.includes.message')
                <form method="post" >
                    {{csrf_field()}}
                    <div class="_form dangnhap_page bg_fdfdfd">
                        <div class="form-horizontal">
                            <h3 class="title_form">{{trans('company.group.edit')}}</h3>

                            <dl>
                                <dt>{{trans('company.title')}} <span class="required">*</span></dt>
                                <dd>
                                    <input type="text" name="name" id="name" value="{{$group->name}}" required />
                                    <span class="help-block">Vui lòng điền thông tin</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>{{trans('company.description')}}</dt>
                                <dd>
                                    <textarea class="form-control" name="description" >{{$group->description}}</textarea>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="text-center" style="margin-left: 0 !important;">
                                    <button type="submit" class="_btn bg_red btn-submit" href="#a"> Lưu lại</button>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script src="{{asset('plugins/loopj-jquery-tokeninput/src/jquery.tokeninput.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>


    </script>
@endpush
