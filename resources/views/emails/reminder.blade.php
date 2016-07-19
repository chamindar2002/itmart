<p>
    <strong>Admin user email: {!! $user->email !!}</strong>
</p>

<a href="{!! $url !!}}">Reset your access token from here</a>

<?php if(isset($error)){ ?>

<p><strong>{!! $error !!}</strong></p>

<?php } ?>


