@extends('app')

@section('content')
<h1>Agents</h1> 

        
    
    @can('add_user')
         {!! link_to("/agents/create", 'Add Agent', array('class'=>'btn btn-link')) !!} 
    @endcan
    
    <hr>
        
    {{ Auth::user()}}
@stop