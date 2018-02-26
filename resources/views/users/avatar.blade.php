@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <img src="{{ \Auth::user()->avatar }}" alt="" style="width: 64px;height: 64px">
                    {!! Form::open(['url' => '/user/storeAvatar', 'method' => 'POST', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::file('avatar') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('上传头像', ['class' => 'btn btn-info pull-right']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6 col-md-offset-3">--}}
                {{--<div class="text-center">--}}
                    {{--<header class="profile-header">--}}
                        {{--<img id="user-avatar" src="{{ \Auth::user()->avatar }}" style="width: 64px;height: 64px">--}}
                        {{--<div id="validation-errors"></div>--}}
                        {{--<div class="avatar-upload" id="avatar-upload">--}}
                            {{--{!! Form::open( [ 'url' => 'user/storeAvatar', 'method' => 'POST', 'id' => 'upload', 'files' => true ] ) !!}--}}
                            {{--<a href="#" class="btn button-change-profile-picture">--}}
                                {{--<label for="upload-profile-picture">--}}
                                    {{--<span id="upload-avatar">更换新头像</span>--}}
                                    {{--<input name="image" id="image" type="file" class="manual-file-chooser js-manual-file-chooser js-avatar-field">--}}
                                {{--</label>--}}
                            {{--</a>--}}
                            {{--{!! Form::close() !!}--}}
                            {{--<div class="span5">--}}
                                {{--<div id="output" style="display:none">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<span id="filename"></span>--}}
                    {{--</header>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection