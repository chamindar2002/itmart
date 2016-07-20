@extends('app')


@section('content')

    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-8 col-md-offset-2'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>New Media</div>
                    <div class='panel-body'>


                        {!! Form::open(array('url' => 'media/upload', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}

                        @include('productsmedia._form',['submitButtonText' => 'Upload'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>




@stop


