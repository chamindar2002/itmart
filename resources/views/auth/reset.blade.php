@extends('app_login')


@section('content')

    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-8 col-md-offset-2'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>Reset Password</div>
                    <div class='panel-body'>


                        {!! Form::open(array('url' => '/password/reset', 'method' => 'post', 'class'=>'form-horizontal')) !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class='form-group'>
                            <label class='col-md4 control-label'>Email</label>
                            <div class='col-md-6'><input type="email" name="email" value="{{ old('email') }}" class='form-control'></div>
                        </div>

                        <div class='form-group'>
                            <label class='col-md4 control-label'>Password</label>
                            <div class='col-md-6'><input type="password" name="password" class='form-control'></div>
                        </div>

                        <div class='form-group'>
                            <label class='col-md4 control-label'>Confirm Password</label>
                            <div class='col-md-6'><input type="password" name="password_confirmation" class='form-control'></div>
                        </div>

                        <div class='form-group'>
                            <div class='col-md-6'>
                            <button type="submit"  class="btn btn-success">
                                Reset Password
                            </button>
                            </div>
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
