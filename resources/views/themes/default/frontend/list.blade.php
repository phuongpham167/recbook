@extends(theme(TRUE).'.layouts.app')

@section('title')
    {{trans('frontend.index')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />
@endsection

@section('content')
    @include(theme(TRUE).'.includes.header')
    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-6 col-xs-offset-3">
                @include('themes.default.includes.message')
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{trans('frontend.index')}}</h3>

                        <div class="box-tools pull-right">
                            {!! a('frontend/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'btn btn-sm btn-primary'],'')  !!}
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>{{trans('frontend.title')}}</th>
                                <th>{{trans('frontend.domain')}}</th>
                                <th>{{trans('frontend.theme')}}</th>
                                <th>{{trans('frontend.administrator')}}</th>
                                <th>{{trans('g.manage')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')
    <script>
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! asset('frontend/data') !!}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'domain', name: 'domain'},
                    { data: 'theme', name: 'theme' },
                    { data: 'user_id', name: 'user_id' },
                    { data: 'manage', name: 'manage'  , sortable:false, searchable: false}
                ]
            });
        });
    </script>
@endsection
