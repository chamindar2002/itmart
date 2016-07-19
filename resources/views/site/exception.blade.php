@extends('app')


@section('content')

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>Resolution Center</div>
                <div class='panel-body'>
                    
               
                    <div class='form-group'>
                    <div class='col-md-6' id='target-place-holder'><a href="{!! URL::previous() !!}" >Back</a></div>
                    </div>
                    
                    <br><br>
                    
                                        
                    @if($code == 272)
                         @include('exceptions._272')
                         
                    @elseif($code == 100)
                         @include('exceptions._100')
                    @elseif($code == 190)
                        @include('exceptions._190')
                    @elseif($code == 274)
                        @include('exceptions._274')
                    @elseif($code == 458)
                        @include('exceptions._458')
                    @else
                         @include('exceptions._default')
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>




@stop


    