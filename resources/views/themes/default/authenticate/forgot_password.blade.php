@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Forgot Password Page" >
@endsection

@section('title')
{{trans('page.forgot_password')}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}"/>
@endpush

@section('content')
    @include(theme(TRUE).'.includes.header')

    <div class="container-vina">
        <div class="row subpage">
            <div class="col-xs-6 col-xs-offset-3">
                @include(theme(TRUE).'.includes.message')
                <div class="_form dangnhap_page bg_fdfdfd">
                    <form class="_check_validate" id="dangnhap-form" method="post">
                        {{csrf_field()}}
                        <h3 class="title_form"><i class="fa fa-sign-in"></i> NHẬP EMAIL CỦA BẠN</h3>


                        <dl>
                            <dt>Email <span class="required">*</span></dt>
                            <dd>
                                <input type="text" name="email" class="form-control" required placeholder="Email" />
                            </dd>
                        </dl>

                        <dl>
                            <dt></dt>
                            <dd>
                                <button type="submit" class="_btn bg_red"><i class="fa fa-sign-in fa-lg fa-fw"></i> Gửi mã xác nhận</button>
                            </dd>
                        </dl>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include(theme(TRUE).'.includes.footer')
@endsection

@section('js')

@endsection