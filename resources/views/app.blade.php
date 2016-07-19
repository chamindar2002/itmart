<!DOCTYPE html>
<html lang="en">
   
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/styles-custom.css')!!}"/>   
   
    <!-- INCLUDE ALL CSS FILES -->
    @include('partials.lte-theme.css_files')
    
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

     <!-- INCLUDE NAVIGATIONS AND HEADER CONTENT -->
     @include('partials.lte-theme.header_nav')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          
          @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            
          <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
              @endforeach
          </div>


        <section class="content">
          @yield('steps-menu')

          @yield('content')
        </section>


      </div><!-- /.content-wrapper -->

      
      <!-- INCLUDE FOOTER AND THE REST OF THE CONTENT -->
      @include('partials.lte-theme.footer')
      
      
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- INCLUDE ALL JAVASCRIPTS AND LIBRARIES -->
    @include('partials.lte-theme.script_files')
    
    
    @yield('footer')

        
    @yield('scripts')
        
  </body>
</html>
