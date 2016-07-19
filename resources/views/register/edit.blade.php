@extends('app')

@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Edit {!! $user->email !!}</div>
                <div class='panel-body'>
    

                {!! Form::model($user, ['method'=>'PATCH', 'url'=>['user-registration-basic', $user->id] ]) !!}

                    @include('register._form',['submitButtonText' => 'Update','edit'=>true])

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>


@stop