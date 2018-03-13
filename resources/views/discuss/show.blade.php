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
                {{-- discussion begin --}}
                <h3 class="media-heading" style="font-weight: bold">{{ $discussion->title }} </h3>
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $discussion->user->avatar }}" alt="" style="width:64px;height:64px" class="media-object">
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            {!! $discussion->user->name !!}
                            发表于{!! $discussion->user->created_at->diffForHumans() !!}<span></span>
                            @if (\Auth::check())
                            <div style="display: none">
                                {!! Form::open(['url' => '/favorite/' . $discussion->id, 'method'=>'DELETE', 'id' => 'favorite_del']) !!}
                                    {!! Form::hidden('discuss_id', $discussion->id) !!}
                                {!! Form::close() !!}

                                {!! Form::open(['url' => '/favorite', 'method'=>'POST', 'id' => 'favorite_store']) !!}
                                    {!! Form::hidden('discuss_id', $discussion->id) !!}
                                {!! Form::close() !!}
                            </div>
                            <a href="javascript:void(0);" id="favorite">
                                <i class="<?= in_array($discussion->id, $favorites) ? 'icon-heart' : 'icon-heart-empty' ?>"></i>
                            </a>
                            @endif
                            <div class="media-bottom">
                                <div class="social-share"  data-disabled="google,twitter,facebook,qq" data-wechat-qrcode-title="请打开微信扫一扫" data-description="Share.js - 一键分享到微博，QQ空间，腾讯微博，人人，豆瓣"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="blog-post">
                 {!! $html !!}
                </div>
                {{-- discussion ending --}}
                <hr>
                {{-- comment --}}
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
    </div>

    {{--<script>--}}

    {{--</script>--}}
    <script  type="text/javascript">


        $(function(){
            var favorite = $('#favorite');

            // 收藏或者不收藏
            favorite.click(function(){
                var options = {
                    success : favoriteResponse
                };

                var favorite_class = $('#favorite').children('i').attr('class');
                if ( favorite_class === 'icon-heart-empty') {
                    $('#favorite_store').ajaxForm(options).submit();
                } else {
                    $('#favorite_del').ajaxForm(options).submit();
                }
            });

            function favoriteResponse(response) {
                var favorite_class = $('#favorite').children('i').attr('class');

                if (response.success) {
                    // 收藏
                    if (favorite_class === 'icon-heart-empty') {
                        $('a .icon-heart-empty').attr('class', 'icon-heart');
                    } else {
                    // 取消收藏
                        $('a .icon-heart').attr('class', 'icon-heart-empty');
                    }
                } else {
                    console.log(response.errors);
                }
            }

            // 提示
            favorite.mouseenter(function(){
                var class_sel = $(this).children('i').attr('class');
                if (class_sel === 'icon-heart-empty') {

                } else {

                }
            });
        });
    </script>
@endsection