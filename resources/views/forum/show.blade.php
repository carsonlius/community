@extends('app')
@section('content')
    <div class="container">


        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle" src="{{ $discussion->user->avatar }}" style="width: 64px;height: 64px">
                    </a>
                </div>

                <div class="media-body">
                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}
                </div>
                <div class="media-right">
                    <a class="btn btn-lg btn-primary" style="float: right;" href="../../components/#navbar" role="button">修改帖子 &raquo;</a>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9" role="main">
                {{ $discussion->body }}
            </div>
        </div>


    </div> <!-- /container -->

@endsection