@extends('app')
@section('content')
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2>欢迎来到laravel社区
                @if(\Auth::check() && $discussion->user_id == \Auth::id())
                    <a class="btn btn-lg btn-primary" style="float: right;" href="/discussions/{{ $discussion->id }}/edit" role="button">编辑帖子 &raquo;</a>
                @endif
            </h2>
        </div>
    </div> <!-- /container -->

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <h4 class="media-heading">Title: {{ $discussion->title }} </h4>
                <div class="blog-post">
                 {!! $html !!}
                </div>
                <hr>
                {{-- discussion --}}
                <?php $comments=$discussion->comments()->paginate(10); ?>
                @foreach($comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href=""><img  class="media-object" style="width: 64px; height: 64px;" src="{{ $comment->user->avatar }}" alt=""></a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {!! (new \App\Markdown\Markdown(new \App\Markdown\Parser()))->markdown($comment->body) !!}
                        </div>
                    </div>
                @endforeach
                <br>
                {{-- comments --}}
                @if (\Auth::check())
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="{{ \Auth::user()->avatar }}" style="width: 64px; height: 64px;" alt="">
                        </div>
                        <div class="media-body">
                            {!! Form::open(['url' => 'comments','method' => 'POST']) !!}
                            {!! Form::hidden('discussion_id', $discussion->id) !!}
                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class'=>'form-control', 'placeholder' => '发表评论...', 'rows'=>4]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('发布评论', ['class' => 'pull-left btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div>
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @else
                    <a href="/login" class="but but-block but-info">登录参与评论吧</a>
                @endif
            </div>

            {{-- page --}}
            <div class="col-md-9" role="doc-pagelist">
                {{ $comments->links() }}
            </div>
    </div>
@endsection