@if (!empty(session('message')))
    <div class="alert alert-{{session('message.type')}}">
        {!!session('message.message')!!}
    </div>
@endif
@if (!empty($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif