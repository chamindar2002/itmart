<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controller="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
<!--            <a class="navbar-brand" href="">Blog</a>-->
<!--            <a class="navbar-brand" href="{{ action('Register\UserRegistrationController@register') }} ">Register</a>-->
            {!! link_to('home','Home',['class'=>'navbar-brand']) !!}
            {!! link_to('ad/ad-campaign','Ad Manager',['class'=>'navbar-brand']) !!}
            {!! link_to('ad/audience-pixel','Audience Manager',['class'=>'navbar-brand']) !!}
            {!! link_to('user-registration','Register',['class'=>'navbar-brand']) !!}
            {!! link_to('ad-wizard','Ad-Wizard',['class'=>'navbar-brand']) !!}
            {!! link_to('auth/login','Login',['class'=>'navbar-brand']) !!}
            {!! link_to('auth/logout','Logout',['class'=>'navbar-brand']) !!}
            

        </div>
        <div id="navbar" class="collapse navbar-collapse">
           

            @if(Auth::check())
                                              
                        <img src=<?php echo 'http://graph.facebook.com/'.Auth::user()->fbProfile->facebook_id.'/picture'; ?>></img>
                    @endif
        </div>
    </div>
</nav>