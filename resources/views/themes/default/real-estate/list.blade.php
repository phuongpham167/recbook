@extends('layouts.app')

@section('title')
    {{trans('real-estate.list.pageTitle')}}
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('real-estate.list.tableTitle')}}</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-danger" id="multi-delete"><i class="fa fa-trash"></i></a>
                        {!! a('real-estate/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'btn btn-sm btn-primary'],'')  !!}
                    </div>
                </div>
                <div class="box-body">
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table-bordered" id="datatable">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Id</th>--}}
                                {{--<th>Tên</th>--}}
                                {{--<th>Mô tả ngắn</th>--}}
                                {{--<th>Danh mục</th>--}}
                                {{--<th>Loại BĐS</th>--}}
                                {{--<th>Nơi rao</th>--}}
                                {{--<th>Ngày đăng</th>--}}
                                {{--<th>Quản lý</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        {{--$(function() {--}}
            {{--$('#datatable').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: '{!! asset('real-estate/data') !!}',--}}
                {{--columns: [--}}
                    {{--{ data: 'id', name: 'id' },--}}
                    {{--{ data: 'title', name: 'title' },--}}
                    {{--{ data: 'short_description', name: 'short_description' },--}}
                    {{--{ data: 'category', name: 'reCategory.name' },--}}
                    {{--{ data: 'type', name: 'reType.name' },--}}
                    {{--{ data: 'province', name: 'province.name' },--}}
                    {{--{ data: 'post_date', name: 'post_date' },--}}
                    {{--{ data: 'manage', name: 'manage'  , sortable:false, searchable: false}--}}
                {{--]--}}
            {{--});--}}
        {{--});--}}
        $("#dataTablesCheckbox").on('click',function() { // bulk checked
            var status = this.checked;
            $(".deleteRow").each( function() {
                $(this).prop("checked",status);
            });
        });
        $('#multi-delete').click(function() {
            var dataTable = $('#dataTableBuilder').DataTable();
            if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
                var ids = [];
                $('.deleteRow').each(function(){
                    if($(this).is(':checked')) {
                        ids.push($(this).val());
                    }
                });
                var ids_string = ids.toString();  // array to string conversion
                console.log(ids_string);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/real-estate/multi-delete",
                    data: {ids:ids_string},
                    success: function(result) {
                        dataTable.draw(); // redrawing datatable
                    },
                    async:false
                });
            }
        });
    </script>
@endsection