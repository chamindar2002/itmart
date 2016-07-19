@extends('app')


@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>New Member</div>
                <div class='panel-body'>


                    {!! Form::open(array('url' => 'member/store', 'method' => 'post', 'class'=>'form-horizontal')) !!}

                    @include('member._form',['submitButtonText' => 'Create'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>




@stop


    