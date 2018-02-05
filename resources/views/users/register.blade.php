@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::open(['url' => '', 'method'=>'post']) !!}
                <div class="form-group">
                    {!! Form::label('name', '姓名：') !!}
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
                    {!! Form::label('password_confirm', '确认密码：') !!}
                    {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('注册', ['class' => 'form-control btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection