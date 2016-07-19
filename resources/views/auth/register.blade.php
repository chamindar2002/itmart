@extends('app_login')


@section('content')

<div class="container" style="margin-top:40px">
    <div class='row'>
        <div class='col-sm-6 col-md-4 col-md-offset-4'>
            <div class='panel panel-default'>
                <div class='panel-heading'><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i>&nbsp;Signup</div>
                <div class='panel-body'>
                    
                    
                    {!! Form::open(array('url' => 'auth/register', 'method' => 'post', 'class'=>'')) !!}
                       {!! csrf_field() !!}
                    <fieldset>
                       <div class='form-group'>
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                               <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"  class='form-control'>

                           </div>

                        </div>

                        <div class='form-group'>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"  class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
                                </span>
                                <input placeholder="Password" type="password" name="password"  class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-unlock-alt"></i>
                                </span>
                                <input placeholder="Confirm Password" type="password" name="password_confirmation"  class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
<!--                            <label class='col-md4 control-label'>Role</label>-->
                            <div class='col-md-6'>
                            <input type="hidden" name="role" value="1"  class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>

                                <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>

                        </div>
                    </fieldset>

                    {!! Form::close() !!}
                    
                </div>
                <div class="panel-footer ">
                    {!! link_to("auth/login", 'Login', array('class'=>'')) !!} </a>

                </div>
            </div>
        </div>
    </div>
</div>




@stop


    