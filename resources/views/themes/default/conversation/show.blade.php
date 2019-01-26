@extends(theme(TRUE).'.layouts.app')

@section('meta-description')
    <meta name="description" content="{{ trans('detail-conversation.meta_description') }}" >
@endsection

@section('title')
    {{ trans('detail-conversation.page_title') }}
@endsection

@push('style')
    {{-- Link css for page here --}}
    <link rel="stylesheet" href="{{ asset('css/list-real-estate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/detail-conversation.css') }}"/>
    <style>

    </style>
@endpush
@section('content')
    {{-- Include Header --}}
    @include(theme(TRUE).'.includes.header')
    {{--Page html content --}}
    <div class="content-body">
        <div class="container padding-top-30 padding-bottom-30">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    if(!empty($conversation->user1()->first()) && $conversation->user1()->first()->id == auth()->user()->id){
                                        $name   =   $conversation->user2()->first()?$conversation->user2()->first()->name:'Người dùng Recbook';
                                    }
                                    else {
                                        $name   =   $conversation->user1()->first()?$conversation->user1()->first()->name:'Người dùng Recbook';
                                    }
                                    ?>
                                    {{$name}}
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" id="panel-body">
                            @foreach($conversation->messages as $message)
                                <div class="row">
                                    <div class="message {{ ($message->user_id!=Auth::user()->id)?'not_owner':'owner'}}">
                                        <p class="mes">{{$message->text}}</p>
                                        <p class="time">{{$message->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <textarea id="msg" class="form-control" placeholder="{{ trans('detail-conversation.input_message_placeholder') }}"></textarea>
                            <input type="hidden" id="csrf_token_input" value="{{csrf_token()}}"/>
                            <br/>
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <button class="btn btn-primary btn-block btn-send-message" onclick="button_send_msg()">{{ trans('detail-conversation.btn_send') }}</button>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
    <script>
        var socket = io('{{env('CHAT_SERVER')}}');
        socket.emit('add user', {'client':{{Auth::user()->id}},'conversation':{{$conversation->id}}});

        socket.on('message', function (data) {
            $('#panel-body').append(
                '<div class="row">'+
                '<div class="message not_owner">'+
                '<p class="mes">' + data.msg + '</p>'+
                '<p class="time">bây giờ</p>'+
                '</div>'+
                '</div>');

            scrollToEnd();

            var audio = new Audio('/audio/ding.mp3');
            audio.play();

        });
    </script>
    {{--<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>--}}
    {{--<script>--}}
        {{--var socket = io.connect('http://127.0.0.1:8890');--}}
        {{--socket.emit('add user', {'client':{{Auth::user()->id}},'conversation':{{$conversation->id}}});--}}

        {{--socket.on('message', function (data) {--}}
            {{--$('#panel-body').append(--}}
                    {{--'<div class="row">'+--}}
                    {{--'<div class="message not_owner">'+--}}
                    {{--data.msg+'<br/>'+--}}
                    {{--'<b>now</b>'+--}}
                    {{--'</div>'+--}}
                    {{--'</div>');--}}

            {{--scrollToEnd();--}}

         {{--});--}}
    {{--</script>--}}
    <script>
        $(document).ready(function(){
            scrollToEnd();

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    var msg = $('#msg').val();
                    $('#msg').val('');//reset
                    send_msg(msg);
                }
            });
        });

        function button_send_msg(){
            var msg = $('#msg').val();
            $('#msg').val('');//reset
            send_msg(msg);
        }


        function send_msg(msg){
            $.ajax({
                headers: { 'X-CSRF-Token' : $('#csrf_token_input').val() },
                type: "POST",
                url: "{{route('message.store')}}",
                data: {
                    'text': msg,
                    'conversation_id':{{$conversation->id}},
                },
                success: function (data) {
                    if(data==true){

                        $('#panel-body').append(
                                '<div class="row">'+
                                '<div class="message owner">'+
                                '<p class="mes">' + msg + '</p>'+
                                '<p class="time">bây giờ</p>'+
                                '</div>'+
                                '</div>');

                        scrollToEnd();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

        function scrollToEnd(){
            var d = $('#panel-body');
            d.scrollTop(d.prop("scrollHeight"));
        }

    </script>
@endpush
