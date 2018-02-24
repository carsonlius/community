@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                {!! Form::model($discussion, ['url' => '/discussions/'. $discussion->id, 'method'=>'PATCH']) !!}
                    {!! Form::hidden('id', $discussion->id) !!}
                    @include('discuss.form')
                <div class="form-group">
                    {!! Form::submit('更新帖子', ['class' => 'btn btn-info pull-right']) !!}
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