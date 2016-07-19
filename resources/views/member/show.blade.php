@extends('app')


@section('content')

@section('steps-menu')

    @include('partials.navsteps')

@stop

<div class='container-fluid'>
    <div class='row'>
        <div class='col-md-8 col-md-offset-2'>
            <div class='panel panel-default'>
                <div class='panel-heading'>{!! $member->name !!}</div>
                <div class='panel-body'>

                    {!! Form::model($member, ['method'=>'delete', 'action'=>['Member\MemberController@destroy', $member->id]]) !!}
                    {!! Form::hidden('id',$member->id,['class'=>'form-control']) !!}

                    <a href="{{ URL::previous()  }}" class="btn btn-primary"> Cancel</a>
                    {!! Form::submit('Confirm Delete',['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>




@stop

<script type="text/javascript">


</script>


    