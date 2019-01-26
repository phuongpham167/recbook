@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Danh sách tin bất động sản" >
@endsection

@section('title')
    Danh sách tin bất động sản
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
                    <p class="title_box">
                        <strong>
                            @if(isset($pageTitle) && $pageTitle)
                                {{ $pageTitle }}
                            @else
                                {{ $category->name }} @if($type)<i class="fa fa-angle-right"></i> {{ $type->name }} @endif {{"(" . $count . ")"}}
                            @endif
                        </strong>
                    </p>
                    @if(isset($isSearch) && $isSearch)
                    <div>
                        <p style="margin: 10px 0 20px 0; font-weight: bold;">Có <strong style="color: #e00;">80</strong> kết quả tìm kiếm cho từ khóa hoặc mã số tin: <strong style="color: #e00;">"{{\request('txtkeyword')}}"</strong></p>
                    </div>
                    @endif
                    <div class="row list-re-item" style="margin-left: -15px; margin-right: -15px;">
                        @foreach($data as $item)
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                @php
                                    $itemClass = '';
                                    if($item->is_hot) {
                                        $itemClass = 'hot';
                                    }
                                @endphp
                                <div class="col-xs-12 re-item {{$itemClass}}">
                                    <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                        @php
                                            $images = $item->images ? json_decode($item->images) : [];
                                            $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                            $imgAlt = $images ? $images[0]->alt : $item->title;
                                        @endphp
                                        <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                                    </a>
                                    <div class="icon_viphot">
                                        @if($item->is_hot)
                                            <img src="{{ asset('images/vip1.gif') }}" alt="{{ $item->title }}">
                                        @endif
                                        @if($item->is_vip)
                                            <img src="{{ asset('images/vip2.gif') }}" alt="{{ $item->title }}">
                                        @endif
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
                                            <i class="fa fa-map-marker"></i> {{$item->district?$item->district->name:''}}
                                        </div>
                                        <div class="col-xs-12 rprice">
                                            {{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}
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
