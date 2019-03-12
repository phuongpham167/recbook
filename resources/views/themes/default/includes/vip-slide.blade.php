<div class="right_box vip_box">
    <p class="title_box">
        <a href="#">
            <strong>TIN VIP</strong>
        </a>
    </p>
    <div>

        <ul class="vip_slider">
            @if($vipRealEstates)
                @foreach($vipRealEstates as $item)
                <li>
                    <dl class=" _hot">
                        <dt>
                            <a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">
                                @php
                                    $images = $item->images ? json_decode($item->images) : [];
                                    $imgThumbnail = $images ? $images[0]->link : '/images/default_real_estate_image.jpg';
                                    $imgAlt = $images ? $images[0]->alt : $item->title;
                                @endphp
                                <img src="{{asset($imgThumbnail)}}" alt="{{ $imgAlt }}">
                            </a>
                            <div class="code_row">{{ $item->code }}</div>
                            <div class="icon_viphot">
                                <img src="{{ asset('images/vip2.gif') }}" alt="{{$item->title}}">
                            </div>
                        </dt>
                        <dd>
                            <h3><a href="{{ route('detail-real-estate', ['slug' => $item->slug . '-' . $item->id]) }}">{{$item->title}}</a></h3>
                            <p><strong>Diện tích:</strong> {{$item->area_of_premises ? ( (ceil($item->area_of_premises) - $item->area_of_premises) != 0 ? $item->area_of_premises : ceil($item->area_of_premises)) . 'm2' : '0m2'}}</p>
                            <p><strong>Giá:</strong> <span>{{convert_number_to_words($item->price)}} {{$item->unit ? $item->unit->name : 'VND'}}</span></p>
                            <p><strong>Hướng:</strong> {{ $item->direction_id?$item->direction()->withTrashed()->first()->name:'' }}</p>
                        </dd>
                    </dl>
                </li>
                @endforeach
                {{--<li>--}}
                    {{--<dl class=" _hot">--}}
                        {{--<dt>--}}
                            {{--<a href="#"><img src="http://nhadathaiphong.vn/images/attachment/thumb/183011.jpg" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng"></a>--}}
                            {{--<div class="icon_viphot">--}}
                                {{--<img src="{{ asset('images/vip2.gif') }}" alt="Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng">								</div>--}}
                        {{--</dt>--}}
                        {{--<dd>--}}
                            {{--<h3><a href="#">Bán nhà mặt đường Tô Hiệu (6x20) Lê Chân Hải Phòng</a></h3>--}}
                            {{--<p><strong>Diện tích:</strong> 120 m2</p>--}}
                            {{--<p><strong>Giá:</strong> <span>Thỏa thuận</span></p>--}}
                            {{--<p><strong>Hướng:</strong> Liên hệ</p>--}}
                        {{--</dd>--}}
                    {{--</dl>--}}
                {{--</li>--}}

            @endif
        </ul>

    </div>
</div>

@push('js')
    <script>
        $('.vip_slider').bxSlider({
            mode: 'vertical',
            auto: true,
            minSlides: 30,
            maxSlides: 30,
            moveSlides: 1,
            pager: false
        });

    </script>
@endpush
