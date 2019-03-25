<div class="menu-footer">
    <div class="container">
        <ul>
            <li>
                <a href="#">QUY CHẾ HOẠT ĐỘNG</a>
            </li>
            <li>
                <a href="#">Cơ chế giải quyết khiếu nại</a>
            </li>
            <li>
                <a href="#">Chính sách bảo mật thông tin</a>
            </li>
            <li>
                <a href="#">Liên hệ - Gửi yêu cầu</a>
            </li>
        </ul>
    </div>
</div>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                @foreach(ads_display(9) as $k=>$item)
                    <div class="col-xs-6">
                        <a href="{{$item->url}}">
                            <img src="http://{{env('DOMAIN_BACKEND', 'recbook.net')}}/{{$item->image}}" class="img-responsive" style="width: 50%" alt="{{$item->note}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-6 footer-info">
                {!! get_config('footer', '') !!}
            </div>
        </div>
    </div>
</footer>
<div class="bottom__label">
    <a href="">
        <img src="source/images/footer-label-1.png" alt="">
    </a>
    <a href="">
        <img src="source/images/footer-label-2.png" alt="">
    </a>
    <a href="">
        <img src="source/images/footer-label-3.png" alt="">
    </a>
    <a href="">
        <img src="source/images/footer-label-4.png" alt="">
    </a>
</div>
<div class="left__label">
    <div>
        <a href="">
            <img src="source/images/label-left-1.png" alt="">
        </a>
    </div>
    <div>
        <a href="">
            <img src="source/images/label-left-2.png" alt="">
        </a>
    </div>
    <div>
        <a href="">
            <img src="source/images/label-left-3.png" alt="">
        </a>
    </div>
    <div>
        <a href="">
            <img src="source/images/label-left-4.png" alt="">
        </a>
    </div>
    <div>
        <a href="">
            <img src="source/images/label-left-5.png" alt="">
        </a>
    </div>
    <div id="goTop">
        <img src="source/images/label-left-6.png" alt="">
    </div>
</div>

@push('js')
    <script>

    </script>
@endpush
