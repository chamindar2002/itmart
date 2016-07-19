@extends('app')


@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Register</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'user-registration', 'method' => 'post', 'class'=>'form-horizontal')) !!}
                       {!! csrf_field() !!}
                       
                       @include('register._form',['submitButtonText' => 'Register', 'edit'=>false])
                       

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    