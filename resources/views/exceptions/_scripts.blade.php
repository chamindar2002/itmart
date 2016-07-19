<script type='text/javascript'>
    
    $('#btn_request_app_permission').click(function() {
      
     $.ajax({
         
         url: "<?php echo URL::to('request-app-permission/') ?>",
         data: {},
         beforeSend: function() {
             $('#target-place-holder').html("<img src='{{ URL::asset('img') }}/ajax-loader.gif' id='form-ajax-loader' />").show();
         },
         success: function(html)
         {
             $('#target-place-holder').html(html);
         }             
         
     });
      
       

//            $.ajax({
//                type: "get",
//                async: true,
//                
//                url: "<?php echo URL::to('ad/ajx-request-target-interest/') ?>/"+text_target_search,
//                data: {},
//                beforeSend: function() {
//                    $('#target-place-holder').html("<img src='{{ URL::asset('img') }}/ajax-loader.gif' id='form-ajax-loader' />").show();
//                },
//
//                success: function(html)
//                {
//                        $('#target-place-holder').html(html);
//                }      
//
//            })
        
        

    });


    $('#reset_fb_access_token').click(function() {

        var redirect_to = "<?php echo Session::get('redirect_url') !== '' ? Session::get('redirect_url') : URL::to('/'); ?>"

        $.ajax({

            url: "<?php echo URL::to('reset-fb-access-token/') ?>",
            data: {},
            beforeSend: function() {
                $('#target-place-holder').html("<img src='{{ URL::asset('img') }}/ajax-loader.gif' id='form-ajax-loader' />").show();
            },
            success: function(html)
            {
                window.location.replace(redirect_to);
//                $('#target-place-holder').html(html);
            }

        });



    });


    $('#test').click(function() {


        $.ajax({

            url: "<?php echo URL::to('ad/ad-set') ?>",
            type:"POST",
            dataType: 'json',
            data: {name:'ad set via ajax', interests:['6004043913548', '6003773483237'], campaign_id:15, start_time:'24-05-2016', end_time:'25-05-2016', bid_amount: '2', daily_budget: '100'},
            beforeSend: function() {
                $('#target-place-holder').html("<img src='{{ URL::asset('img') }}/ajax-loader.gif' id='form-ajax-loader' />").show();
            },
            success: function(html)
            {
//               window.location.replace(redirect_to);
//                $('#target-place-holder').html(html);
            },
            error: function(data){
               results = $.parseJSON(data.responseText);
                $('#target-place-holder').html("");
                $.each(results, function( key, value ) {
                    console.log( key + ": " + value );
                    $('#target-place-holder').append(key + ": " + value +"<br>");

                });

            }

        });



    });

</script>