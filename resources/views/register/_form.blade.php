<div class='form-group'>
    {!! Form::label('first_name','First Name',['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::text('first_name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('last_name','Last Name',['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::text('last_name',null,['class'=>'form-control']) !!}
    </div>
</div>

@if(!$edit)
<div class='form-group'>
    {!! Form::label('email','Email',['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('password','Password',['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
</div>

<div class='form-group'>
    {!! Form::label('password_confirmation','Confirm Password',['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
    </div>
</div>

@endif

<div class='form-group'>
    <div class='col-md-6'>
    {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']); !!}
    </div>
</div>