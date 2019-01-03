@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Transaction Log" >
@endsection

@section('title')
    {{trans('users.transaction_history')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">

            <!--Begin right-->
        @include(theme(TRUE).'.includes.left-menu')
        <!--End right-->

            <!--Begin left-->
            <div class="col-xs-9 right">
            @include('themes.default.includes.message')
            <!--begin manage_page-->
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-history"></i>{{trans('users.transaction_history')}}</strong></p>
                    <div>

                        <div class="_form search_listlandA_page">
                            <form enctype="multipart/form-data" id="yw0" method="post">
                                <div class="row">

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.datefrom')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="datefrom" id="datefrom" value="{{request('datefrom', \Carbon\Carbon::now()->startOfMonth()->format('d/m/Y'))}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('page.dateto')}}</dt>
                                            <dd>
                                                <input type="text" class="form-control input-sm datepicker" name="dateto" id="dateto" value="{{request('dateto', \Carbon\Carbon::now()->format('d/m/Y'))}}">
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4">
                                        <dl>
                                            <dt>{{trans('users.type_tran')}}</dt>
                                            <dd>
                                                <select name="type_tran" id="type_tran">
                                                    <option value="">{{trans('users.type_tran_all')}}</option>
                                                    <option value="0">{{trans('users.type_tran_add')}}</option>
                                                    <option value="1">{{trans('users.type_tran_minus')}}</option>
                                                </select>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-8">
                                        <dl>
                                            <dd class="list_checkbox">
                                                &nbsp;
                                            </dd>
                                        </dl>
                                    </div>

                                    <div class="col-xs-4" style="text-align: right;">
                                        <button type="submit" class="_btn bg_red" style="padding: 6px 15px;"><i class="fa fa-search fa-fw"></i>{{trans('page.search')}}</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{trans('users.name')}}</th>
                                        <th>{{trans('users.type_tran')}}</th>
                                        <th>{{trans('users.value_tran')}}</th>
                                        <th>{{trans('users.currency_tran')}}</th>
                                        <th>{{trans('users.reason_tran')}}</th>
                                        <th>{{trans('users.created_tran')}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--end manage_page-->

            </div>
            <!--End left-->

        </div>
    </div>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}" />

    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script src="{{asset('plugins/moment-develop/moment.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script>
        $(function() {
            $('.datepicker').datetimepicker({format: 'DD/MM/YYYY'});

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! asset('/lich-su-giao-dich/data') !!}',
                columns: [
                    { data: 'user_id', name: 'user_id' },
                    { data: 'type', name: 'type' },
                    { data: 'value', name: 'value'},
                    { data: 'currency', name: 'currency' },
                    { data: 'reason', name: 'reason' },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
        });

    </script>
@endpush
