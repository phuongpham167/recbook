@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('frontend.create')}}
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
                @include('themes.default.includes.message')
                <form method="post" >
                    {{csrf_field()}}
                    <div class="_form dangnhap_page bg_fdfdfd">
                        <div class="form-horizontal">
                            <h3 class="title_form">{{trans('company.create')}}</h3>

                            <dl>
                                <dt>{{trans('company.title')}} <span class="required">*</span></dt>
                                <dd>
                                    <input type="text" name="name" id="name" required placeholder="{{trans('frontend.title')}}" />
                                    <span class="help-block">Vui lòng điền thông tin</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>{{trans('company.description')}}</dt>
                                <dd>
                                    <textarea class="form-control" name="description" ></textarea>
                                </dd>
                            </dl>
                            <dl>
                                <dt>{{trans('company.address')}}</dt>
                                <dd>
                                    <textarea class="form-control" name="address" ></textarea>
                                </dd>
                            </dl>
                            <dl>
                                <dd>
                                    <p>{{trans('company.addMembersToCompany')}}</p>
                                    <input class="form-control" name="members"/>
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
        $(document).ready(function () {
            $('input[name=members]').tokenInput("{{asset('ajax/user')}}?except={{auth()->user()->id}}&role=friend", {
                queryParam: "term",
                zindex  :   1005,
                preventDuplicates   :   true
            });
        });

    </script>
@endpush
