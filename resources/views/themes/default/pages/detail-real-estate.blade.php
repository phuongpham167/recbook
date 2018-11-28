@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="Description page" >
@endsection

@section('title')
    Title Page
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/detail-real-estate.css') }}"/>
@endpush

@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
       <div class="container padding-top-30 padding-bottom-30">
           <div class="row">
               <div class="col-xs-12 col-md-9 detail-content-wrap">
                   <p class="title_box"><strong>Cần bán <i class="fa fa-angle-right"></i> Nhà trong ngõ (1416)</strong></p>
                   <div class="detail-content">
                       <h1 class="title">Bán nhà số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng</h1>
                       <h2 class="title-second">Bán nhà số 28 ngõ 389 đường Đằng Hải, Hải An, Hải Phòng</h2>
                       <div class="brief_detail row">
                           <div class="col-xs-12 col-sm-8">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Mã số tin:</strong> HP-9047</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p><strong>- Ngày cập nhật:</strong> 20/11/2018</p>
                                    </div>
                                </div>
                           </div>
                           <div class="col-xs-12 col-sm-4">

                           </div>
                       </div>
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
