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
    @include(theme(TRUE).'.includes.header')
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
                                <div style="color: gold" id="stars" class="starrr"></div>
                                Bạn đã đánh giá <span id="count">0</span> sao
                                <input type="hidden" name="rate" id="rate">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="type" id="type">
                            </div>
                            {{--<div class="row lead">--}}
                                {{--<p>Also you can give a default rating by adding attribute data-rating</p>--}}
                                {{--<div id="stars-existing" class="starrr" data-rating='4'></div>--}}
                                {{--You gave a rating of <span id="count-existing">4</span> star(s)--}}
                            {{--</div>--}}
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

        var __slice = [].slice;

        (function($, window) {
            var Starrr;

            Starrr = (function() {
                Starrr.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function(e, value) {}
                };

                function Starrr($el, options) {
                    var i, _, _ref,
                        _this = this;

                    this.options = $.extend({}, this.defaults, options);
                    this.$el = $el;
                    _ref = this.defaults;
                    for (i in _ref) {
                        _ = _ref[i];
                        if (this.$el.data(i) != null) {
                            this.options[i] = this.$el.data(i);
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on('mouseover.starrr', 'span', function(e) {
                        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('mouseout.starrr', function() {
                        return _this.syncRating();
                    });
                    this.$el.on('click.starrr', 'span', function(e) {
                        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('starrr:change', this.options.change);
                }

                Starrr.prototype.createStars = function() {
                    var _i, _ref, _results;

                    _results = [];
                    for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
                    }
                    return _results;
                };

                Starrr.prototype.setRating = function(rating) {
                    if (this.options.rating === rating) {
                        rating = void 0;
                    }
                    this.options.rating = rating;
                    this.syncRating();
                    return this.$el.trigger('starrr:change', rating);
                };

                Starrr.prototype.syncRating = function(rating) {
                    var i, _i, _j, _ref;

                    rating || (rating = this.options.rating);
                    if (rating) {
                        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                        }
                    }
                    if (rating && rating < 5) {
                        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                        }
                    }
                    if (!rating) {
                        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }
                };

                return Starrr;

            })();
            return $.fn.extend({
                starrr: function() {
                    var args, option;

                    option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function() {
                        var data;

                        data = $(this).data('star-rating');
                        if (!data) {
                            $(this).data('star-rating', (data = new Starrr($(this), option)));
                        }
                        if (typeof option === 'string') {
                            return data[option].apply(data, args);
                        }
                    });
                }
            });
        })(window.jQuery, window);

        $(function() {
            return $(".starrr").starrr();
        });

        $( document ).ready(function() {

            $('#stars').on('starrr:change', function(e, value){
                $('#count').html(value);
                $('#rate').val(value);
                console.log($('#rate').val());
            });

            $('#stars-existing').on('starrr:change', function(e, value){
                $('#count-existing').html(value);
            });
        });
    </script>
@endpush
