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

                // change photo
                $('#user-avatar').attr('src', response.avatar);
                $('#upload-avatar').html('更换的新头像');
            }

        }
    </script>
@endsection