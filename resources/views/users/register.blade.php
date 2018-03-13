@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::open(['url' => 'user/register', 'method'=>'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '用户名：') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', '邮箱：') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', '密码：') !!}
                    {!! Form::password('password', ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', '确认密码：') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('注册', ['class' => 'form-control btn btn-info']) !!}
                </div>
                {!! Form::close() !!}

                @include('users.third_login')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection