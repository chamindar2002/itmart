@extends('app_login')


@section('content')

<div class="container" style="margin-top:40px">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class='panel panel-default'>
                <div class='panel-heading'><i class="fa fa-sign-in fa-1x" aria-hidden="true"></i> &nbsp; Log in to continue</div>
                <div class='panel-body'>

                    <br />


                    
                    {!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class'=>'')) !!}
                        {!! csrf_field() !!}

                    <fieldset>

                        <div class='form-group'>
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                <input type="email" name="email" placeholder="Email"  value="{{ old('email') }}" class='form-control'>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-lock"></i>
								</span>
                                <input type="password" name="password" placeholder="Password" id="password" class='form-control'>
                            </div>
                        </div>
                        
                        

                        <div class='form-group'>

                                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>

                            {{----}}
                            {{--<div class='col-md-6'>--}}
                                {{--{!! link_to("auth/register", 'Signup', array('class'=>'')) !!} --}}
                            {{--</div>--}}

                            {{--<div class='col-md-6'>--}}
                                {{--{!! link_to("password/email", 'Forgot Password?', array('class'=>'')) !!}--}}
                            {{--</div>--}}
                        </div>

                        <div class="input-group">
                                <input type="checkbox" name="remember"> Remember Me
                        </div>

                        
                     </fieldset>
<!--                    </form>-->
                        {!! Form::close() !!}
                    
                </div>
                <div class="panel-footer ">
                    Don't have an account! {!! link_to("auth/register", 'Sign Up Here', array('class'=>'')) !!} </a>

                    <br> or &nbsp;

                    {!! link_to("password/email", 'Forgot Password?', array('class'=>'')) !!}
                </div>
            </div>
        </div>
    </div>

</div>



@stop