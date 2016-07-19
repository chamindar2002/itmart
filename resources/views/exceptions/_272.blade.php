

<div class='form-group'>

    {!! 
    Form::button('Request Facebook App Permission',
    [
    'class'=>'btn btn-success form-control',
    'id'=>'btn_request_app_permission'
    ])
    !!}

</div>

<section>
    <hr>
    <p><strong>Next</strong></p>
    

        <ul class="list-group">
            <li class="list-group-item list-group-item-success">
                Click on the Notification.<br>
                <img src="{!! asset('img/fb_developer_account_5_cropped.png') !!}">
            </li>
            
            <li class="list-group-item list-group-item-success">
                Click on the green Register Now button.
                <br>(If you already have a Facebook Developer account this button will not be available) <br>
                Continue with the Registration as prompted on the popup window.
                <img src="{!! asset('img/fb_developer_account_3_cropped.png') !!}" width="100%"><br>
                
            </li>
                        
            <li class="list-group-item list-group-item-success">
                Click on the blue Confirm button. <br>
                 <img src="{!! asset('img/fb_developer_account_4_cropped.png') !!}" width="100%">
            </li>
            
        </ul>
            
               
            

</section>



@section('scripts') 

@include('exceptions._scripts')

@stop