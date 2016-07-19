@extends('app')


@section('content')

@section('steps-menu')

    @include('partials.navsteps')

@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Error</div>
                <div class='panel-body'>

                    <strong>Oooops!</strong>
                    {!! $e->getMessage() !!}}}

                </div>
            </div>


        </div>
    </div>
</div>



@stop

