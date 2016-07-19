@extends('app_login')


@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Sign In</div>
                <div class='panel-body'>
                    
                    {!! link_to($url,'',['class'=>'fa fa-facebook-official  fa-5x']) !!}
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    