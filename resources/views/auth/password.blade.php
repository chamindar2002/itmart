@extends('app_login')


@section('content')

    <div class="container" style="margin-top:40px">
        <div class='row'>
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class='panel panel-default'>
                    <div class='panel-heading'><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp;Reset Password</div>
                    <div class='panel-body'>


                        {!! Form::open(array('url' => '/password/email', 'method' => 'post', 'class'=>'')) !!}

                            <div class='form-group'>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" placeholder="Enter email here:" class='form-control'>
                                </div>
                            </div>

                            <div class='form-group'>

                                    <button type="submit"  class="btn btn-lg btn-primary btn-block">
                                        Send Password Reset Link
                                    </button>

                            </div>


                        {!! Form::close() !!}

                    </div>

                    <div class="panel-footer ">
                        {!! link_to("auth/login", 'Login', array('class'=>'')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

{{--https://laravel.com/docs/5.1/authentication#resetting-passwords--}}

