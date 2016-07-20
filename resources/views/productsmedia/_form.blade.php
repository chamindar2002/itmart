<div class='form-group'>
    {!! Form::label('media_file','Media file', ['class'=>'col-md4 control-label']) !!}
    <div class='col-md-6'>
        {!! Form::file('media_file') !!}

    </div>
</div>




<div class='form-group'>
    <div class='col-md-6'>
        {!! Form::submit($submitButtonText,['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>