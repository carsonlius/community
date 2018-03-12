@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <div id="validation-errors"></div>
                    <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
                    {!! Form::open(['url'=>'/user/storeAvatar','files'=>true,'id'=>'avatar']) !!}
                    <div class="text-center">
                        <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像</button>
                    </div>
                    {!! Form::file('avatar',['class'=>'avatar','id'=>'image']) !!}
                    {!! Form::close() !!}
                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 模态框--}}
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document" aria-hidden="true">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/crop/api'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img src="{{ \Auth::user()->avatar }}" class="ui centered image" id="cropbox">
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
           var options = {
               beforeSubmit : showRequest,
               success : showResponse
           };

           // ajaxForm
           $('#image').change(function(){
               $('#upload-avatar').html('正在上传...');
               $('#avatar').ajaxForm(options).submit();
           });
        });

        function showRequest()
        {
            $('#validation-errors').hide().empty();
            $('#output').css('display', 'none');
            return true;
        }

        // boolean string undefined object null
        // boolean string integer float array object  resource null
        function showResponse(response)
        {
            // show errors
            if (response.success === false) {
                var responseErrors = response.errors['avatar'];

                $.each(responseErrors, function(index, value){
                    if (value.length !== 0) {
                        var html_err = '<div class="alert alert-danger" role="alert"><strong>' + value + '</strong></div>';
                        $('#validation-errors').append(html_err);
                    }
                });
                $('#validation-errors').show();
            } else {

                var cropBox = $("#cropbox");
                cropBox.attr('src',response.avatar);
                $('#photo').val(response.avatar);
                $('#upload-avatar').html('更换新头像');
                $('#avatar-login').attr('src', response.avatar);
                $('#exampleModal').modal('show');
                cropBox.Jcrop({
                    aspectRatio: 1, //  裁剪框的
                    onSelect: updateCoords, //选中裁剪框的事件
                    setSelect: [120,120,10,100]
                });
                $('.jcrop-holder img').attr('src',response.avatar);
            }
        }

        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }

        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            alert('请选择图片.');
            return false;
        }
    </script>
@endsection