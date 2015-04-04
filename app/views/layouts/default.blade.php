<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Library System</title>
        {{ HTML::style('css/font-awesome.css') }}
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-theme.min.css') }}
        {{ HTML::style('css/sb-admin.css') }}
        {{ HTML::style('css/custom.css') }}
        {{ HTML::style('css/table_sorter/bootstrap-sortable.css') }}
        
        @yield('header')
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- div for header with title -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Library System</a>
                </div>

                <!-- div for side and top menu -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <!-- Side Menu -->
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="/" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);">Dashboard</a>
                        </li>
                        <li class="">
                            <a href="/admin/users" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);">Manage User</a>
                        </li>
                        <li class="">
                            <a href="/" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);">Manage Book</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> Edu Iglesias  <b class="caret" style="margin-top: 0;"></b>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/user/editprof/#"> <i class="fa fa-user"></i> Edit Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/logout"><i class="fa fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>

                <br/>

                <div class="container no-print" style="width: 100%">
                    <p class="text-muted" style="text-align: center; font-size: 11px;">Developed by 
                        <a href="#" title="#">Web Synergy 2.0</a><br/>
                        Powered by <a href="http://laravel.com/" style="color: #f47063">Laravel</a>.
                    </p>
                </div>
            </div>
        </div>

        <!-- JavaScript -->

        <script type="text/javascript">  
            $(document).ready(function () {  
                $('.dropdown-toggle').dropdown();  
            });  
       </script>  

        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/jquery-1.10.2.js') }}

        {{ HTML::script('js/table_sorter/bootstrap-sortable.js') }}
        {{ HTML::script('js/table_sorter/moment.min.js') }}
       
       @yield('footer')

    </body>
</html>