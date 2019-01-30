

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
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive" style="width: 50%"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive" style="width: 50%"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive" style="width: 50%"/>
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive" style="width: 50%"/>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 footer-info">
                {!! get_config('footer', '') !!}
            </div>
        </div>
    </div>
</footer>

@push('js')
    <script>

    </script>
@endpush
