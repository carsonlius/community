<div class="form-group">
    {!! Form::label('title', '标题：') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', '内容：') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('更新帖子', ['class' => 'btn btn-info pull-right']) !!}
</div>