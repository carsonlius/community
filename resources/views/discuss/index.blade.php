@extends('app')
@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>欢迎来到laravel社区
                <a class="btn btn-lg btn-primary" style="float: right;" href="/discussions/create" role="button">发布新的帖子 &raquo;</a></h2>
        </div>
    </div> <!-- /container -->

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{!! $discussion->user->avatar !!}" alt="64*64" style="width: 64px;height: 64px" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="/discussions/{{ $discussion->id }}"><h4 class="media-heading">{{ $discussion->title }}</h4>
                            </a>
                            {{ $discussion->user->name }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-9" role="doc-pagelist">
                {{ $discussions->links() }}

            </div>
        </div>
    </div>
@endsection