@extends('app')
@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>欢迎来到laravel社区<a class="btn btn-lg btn-primary" style="float: right;" href="/discussions/create" role="button">发布新的帖子 &raquo;</a></h2>
        </div>
    </div> <!-- /container -->

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <h4 class="media-heading">Title: {{ $discussion->title }} </h4>
                <div class="blog-post">
                 {!! $html !!}
                </div>
            </div>
        </div>
    </div>
@endsection