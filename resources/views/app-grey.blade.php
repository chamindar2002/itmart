<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->  
    <link href="{!! asset('theme_startbootstrap-sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet"/>
    
    <!-- MetisMenu CSS -->
    <link href="{!! asset('theme_startbootstrap-sb-admin/bower_components/metisMenu/dist/metisMenu.min.css') !!}" rel="stylesheet" />

    <!-- Timeline CSS -->
    <link href="{!! asset('theme_startbootstrap-sb-admin/dist/css/timeline.css') !!}" rel="stylesheet" />

    <!-- Custom CSS -->
<!--    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">-->
    <link href="{!! asset('theme_startbootstrap-sb-admin/dist/css/sb-admin-2.css') !!}" rel="stylesheet" />

    <!-- Morris Charts CSS -->
<!--    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">-->
    <link href="{!! asset('theme_startbootstrap-sb-admin/bower_components/morrisjs/morris.css') !!}" rel="stylesheet" />

    <!-- Custom Fonts -->
<!--    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link href="{!! asset('theme_startbootstrap-sb-admin/bower_components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Select2 https://select2.github.io/ -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('home', null) }}">Allison</a>
                
            </div>
            <!-- /.navbar-header -->
            @include('partials.nav_notifications')
            
            <!-- /.nav side bar -->
            @include('partials.nav_main')
            
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            
           
                
<!--            <button type='buuton' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <div class='alert alert-success'>{{ Session::get('success') }}</div>-->

                <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
                </div>
                  
          
            
            @yield('steps-menu')
        
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<!--    <script src="../bower_components/jquery/dist/jquery.min.js"></script>-->
    <script src="{!! asset('theme_startbootstrap-sb-admin/bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <!-- Bootstrap Core JavaScript -->
<!--    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <script src="{!! asset('theme_startbootstrap-sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}" ></script>
    <!-- Metis Menu Plugin JavaScript -->
<!--    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->

    <script src="{!! asset('theme_startbootstrap-sb-admin/bower_components/metisMenu/dist/metisMenu.min.js') !!}"></script>
    <!-- Morris Charts JavaScript -->
<!--    <script src="../bower_components/raphael/raphael-min.js"></script>-->

    <script src="{!! asset('theme_startbootstrap-sb-admin/bower_components/raphael/raphael-min.js') !!}"></script>
<!--    <script src="../bower_components/morrisjs/morris.min.js"></script>-->

    <script src="{!! asset('theme_startbootstrap-sb-admin/bower_components/morrisjs/morris.min.js') !!}" ></script>
<!--    <script src="../js/morris-data.js"></script>-->

<!--    <script src="{!! asset('theme_startbootstrap-sb-admin/js/morris-data.js') !!}" ></script>-->
    <!-- Custom Theme JavaScript -->
<!--    <script src="../dist/js/sb-admin-2.js"></script>-->

    <script src="{!! asset('theme_startbootstrap-sb-admin/dist/js/sb-admin-2.js') !!}" ></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
       
        @yield('footer')
        
        
        @yield('scripts')
</body>

</html>
