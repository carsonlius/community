@extends('app')
@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>欢迎来到个人社区<a class="btn btn-lg btn-primary" style="float: right;" href="/discussions/create" role="button">发布新的帖子 &raquo;</a></h2>
        </div>
        @if(\Session::has('discussion_edit_failed'))
            <div class="alert alert-danger" role="alert">
                {!!\Session::get('discussion_edit_failed') !!}
            </div>
        @endif
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
                            <h4 class="media-heading">
                            <a href="/discussions/{{ $discussion->id }}">{{ $discussion->title }}</a>
                            </h4>
                            <span style="color:gray">
                                <span class="username">{{ $discussion->user->name }} 发表于</span><time pubdate="true">{!! $discussion->created_at->diffForHumans() !!}</time>
                                &nbsp;<i class="icon-reply"></i>
                                <span class="username"><i class="icon fa fa-fw fa-reply "></i>{!! $discussion->lastUser->name !!}</span>
                                <time pubdate="true" data-humantime="true">{!! $discussion->lastUser->updated_at->diffForHumans() !!}更新</time>
                            </span>

                            {{-- 回复详情 --}}
                            <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a href="">{{ count($discussion->comments) }}</a>
                                        回复
                                    </span>
                            </div>
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