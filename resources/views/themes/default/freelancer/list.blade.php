@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Freelancer List">
@endsection

@section('title')
    {{trans('freelancer.index')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
    <link rel="stylesheet" href="{{asset('plugins/jquery.datatables/css/jquery.dataTables.min.css')}}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.user-info-header')
    <div class="container-vina">
        <div class="row subpage">
            <!--Begin left-->
            <div class="col-xs-3 left">
                @include(theme(TRUE).'.includes.left-menu')
            </div>
            <!--End left-->

            <div class="col-xs-9 right">
                @include('themes.default.includes.message')
                <div class="listlandA_page">
                    <p class="title_boxM"><strong><i class="fa fa-list-alt"></i>{{trans('freelancer.index')}}</strong></p>

                    {{--<div class="box-tools pull-right">--}}
                        {{--{!! a('freelancer/create', '', '<i class="fa fa-plus"></i> '.trans('system.add'), ['class'=>'_btn bg_red'],'')  !!}--}}
                    {{--</div>--}}

                    <div>
                        <div class="box-body">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{trans('freelancer.title')}}</th>
                                    <th>{{trans('freelancer.end_at')}}</th>
                                    <th>{{trans('freelancer.finish_at')}}</th>
                                    <th>{{trans('freelancer.budget')}}</th>
                                    <th>{{trans('freelancer.address')}}</th>
                                    <th>{{trans('g.manage')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="{{route('freelancerReview')}}">
        {{csrf_field()}}
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Đánh giá và nhận xét</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row lead">
                                <span style="color: gold"><input type="hidden" class="rating" data-fractions="2"/></span>
                                <input type="hidden" name="rate" id="rate">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="type" id="type">
                            </div>
                        </div>
                        <hr>
                        <label class="control-label">Nhận xét</label>
                        <div>
                            <textarea class="form-control" name="review"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_new"
                                id="add-new-re"
                                class="_btn bg_red pull-right"><i
                                class="fa fa-plus"></i> &nbsp;&nbsp;LƯU
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @include(theme(TRUE).'.includes.footer')

@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/js/bootstrap-rating.js')}}"></script>
    <script src="{{asset('plugins/bootbox.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.datatables/js/jquery.dataTables.js')}}"></script>
    <script>
        $(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': urlDatatable ='{!! route('freelancerData') !!}?filter={{$filter}}',
                    'type': 'GET',
                    'data': function (d) {

                    }
                },
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'end_at', name: 'end_at'},
                    {data: 'finish_at', name: 'finish_at'},
                    {data: 'budget', name: 'budget'},
                    {data: 'address', name: 'address'},
                    {data: 'manage', name: 'manage', sortable: false, searchable: false}
                ]
            });
        });
        $('.table').on('click', '.btn-done', function () {
            // console.log(check);
            var id      =   $(this).attr('id');
            var type   =   $(this).data('type');

            $('.modal #type').val(type);
            $('.modal #id').val(id);
            $('#myModal').modal('show');
        });

        $(function () {
            $('input.check').on('change', function () {
                alert('Rating: ' + $(this).val());
            });
            $('#programmatically-set').click(function () {
                $('#programmatically-rating').rating('rate', $('#programmatically-value').val());
            });
            $('#programmatically-get').click(function () {
                alert($('#programmatically-rating').rating('rate'));
            });
            $('#programmatically-reset').click(function () {
                $('#programmatically-rating').rating('rate', '');
            });
            $('.rating-tooltip').rating({
                extendSymbol: function (rate) {
                    $(this).tooltip({
                        container: 'body',
                        placement: 'bottom',
                        title: 'Rate ' + rate
                    });
                }
            });
            $('.rating-tooltip-manual').rating({
                extendSymbol: function () {
                    var title;
                    $(this).tooltip({
                        container: 'body',
                        placement: 'bottom',
                        trigger: 'manual',
                        title: function () {
                            return title;
                        }
                    });
                    $(this).on('rating.rateenter', function (e, rate) {
                        title = rate;
                        $(this).tooltip('show');
                    })
                        .on('rating.rateleave', function () {
                            $(this).tooltip('hide');
                        });
                }
            });
            $('.rating').each(function () {
                $('<span class="label label-default"></span>')
                    .text($(this).val() || ' ')
                    .insertAfter(this);
            });
            $('.rating').on('change', function () {
                $(this).next('.label').text($(this).val());
                $('#rate').val($(this).val());
            });
        });
    </script>
@endpush
