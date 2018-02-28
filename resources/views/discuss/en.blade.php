@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <label for="" class="col-md-offset-4  toggle_lang" style="cursor: pointer;">中文</label>
            <label for="" class="col-md-offset-2 toggle_lang" style="cursor: pointer">ENGLISH</label>
        </div>
        <div class="row">

            {!! Form::open(['url' => '', 'class' => 'form-horizontal']) !!}
            <div class="form-group" id="lang_en">
                <label class="col-md-offset-2 col-md-2 control-label" id="label_name">NAME</label>
                <div class="col-md-4">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-offset-2 col-md-2 control-label" id="label_address">ADDRESS</label>
                <div class="col-md-4">
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('label.toggle_lang').click(function () {
                if ($(this).text() === '中文') {
                    $('#label_address').text('地址');
                    $('#label_name').text('名字');
                } else {
                    $('#label_address').text('NAME');
                    $('#label_name').text('ADDRESS');
                }
            });


        });

    </script>

@endsection