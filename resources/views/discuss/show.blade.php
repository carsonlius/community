@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::model($discussion, ['url' => 'discussions', 'method'=>'post']) !!}
                <div class="form-group">
                    {!! Form::label('title', '标题：') !!}
                    {!! Form::text('title', $discussion->title, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', '内容：') !!}
                    {!! Form::textarea('body', $discussion->body, ['class' => 'form-control']) !!}
                </div>
                {!! Form::close() !!}
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