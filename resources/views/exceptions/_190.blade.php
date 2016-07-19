
<section>

    <ul class="list-group">
        <li class="list-group-item list-group-item-danger">
            Your Access Token has expired. You must reset the old token and obtain a new token from Facebook to continue.

        </li>

    </ul>

</section>

<div class='form-group'>

    {!! Form::button('Reset Old Token', ['class'=>'btn btn-success form-control', 'id'=>'reset_fb_access_token'])   !!}

</div>



{{--{!! Form::button('Feth Ad Set',['class'=>'btn btn-success form-control','id'=>'test']) !!}--}}



<hr>

@section('scripts')

    @include('exceptions._scripts')

@stop