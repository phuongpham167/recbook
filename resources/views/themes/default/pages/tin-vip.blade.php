{{-- this blade is for route tin-vip hard set --}}

@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách tin bất động sản" >
@endsection

@section('title')
    Danh sách tin vip bất động sản
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/list-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-xs-12 col-md-9 list-content-wrap">
                    <p class="title_box"><strong>TIN NHÀ ĐẤT VIP</strong>
                    </p>
                    <div class="row list-re-item" style="margin-left: -15px; margin-right: -15px;">
                        @foreach($data as $item)
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="col-xs-12 re-item hot">
                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                        @php
                                            $images = $item->images ? json_decode($item->images) : [];
                                            $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                            $imgAlt = $images ? $images[0]->alt : $item->title;
                                        @endphp
                                        <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                    </a>
                                    <div class="icon_viphot">
                                        <img src="{{ asset('images/vip2.gif') }}" alt="{{$item->title}}">
                                    </div>

                                    <div class="code_row">{{ $item->code }}</div>

                                    <h3>
                                        <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{$item->title}}</a>
                                    </h3>

                                    <p>{{$item->short_description}}
                                    </p>
                                    <div class="row area">
                                        <div class="col-xs-6 larea">DTMB: {{$item->area_of_premises ? $item->area_of_premises . 'm2' : '0m2'}}</div>
                                        <div class="col-xs-6 rarea">DTSD: {{$item->area_of_use ? $item->area_of_use . 'm2' : '0m2'}}</div>
                                    </div>
                                    <div class="row price">
                                        <div class="col-xs-12 lprice">
                                            <i class="fa fa-map-marker"></i> {{$item->district->name}}
                                        </div>
                                        <div class="col-xs-12 rprice">
                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}{{$item->don_vi ? '/'.$item->don_vi : ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    @include(theme(TRUE).'.includes.right-sidebar')
                    @include(theme(TRUE).'.includes.vip-slide')
                </div>
            </div>
        </div>
    </div>
    {{-- Include footer --}}
    @include(theme(TRUE).'.includes.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush
