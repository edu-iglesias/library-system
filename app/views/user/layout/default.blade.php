<html>
    <head>

        <title>Library System</title>
        {{HTML::style('css/user/bootstrap.min.css');}}
        {{HTML::style('css/glyphicons.css');}}
        <!-- {{HTML::style('css/ionic.css');}} -->

        {{ HTML::style('css/font-awesome.css') }}
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrap-theme.min.css') }}
        {{ HTML::style('css/sb-admin.css') }}
        {{ HTML::style('css/custom.css') }}

        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
        {{ HTML::style('colvix/css/jquery.dataTables.css')}}
        {{ HTML::style('colvix/css/dataTables.colVis.css')}}
        {{ HTML::style('colvix/css/shCore.css')}}
        
        {{ HTML::script('colvix/js/jquery.js')}}
        {{ HTML::script('colvix/js/jquery.dataTables.js')}}
        {{ HTML::script('colvix/js/dataTables.colVis.js')}}
        {{ HTML::script('colvix/js/shCore.js')}}
        {{ HTML::script('colvix/js/demo.js')}}

        <script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
                $('#colvixTable').DataTable( {
                    dom: 'C<"clear">lfrtip'
                } );
            } );
        </script>

        <script>
            $(function () {
                $('#myTab a:first').tab('show')
            });
            $(function() {
                //for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
                $('a[data-toggle="tab"]').on('click', function (e) {
                    //save the latest tab; use cookies if you like 'em better:
                    localStorage.setItem('lastTab', $(e.target).attr('href'));
                });

                //go to the latest tab, if it exists:
                var lastTab = localStorage.getItem('lastTab');

                if (lastTab) {
                    $('a[href="'+lastTab+'"]').click();
                }
            });
        </script>
        @yield('header')
    </head>
    <body style="margin: 10px;">

       @if(Auth::user())
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <ul class="nav navbar-nav">
                        <!-- <li style="margin-right: -100px;"><img src="../images/banner.png" style="margin: 10px; width: 45%;"></li> -->
                        <li><a class="navbar-brand" href="/user/home" style="color:#008cba;">{{ HTML::image('images/logo2.png',"",['height'=>'25px', 'width'=>'25px']) }} WSA Library System</font></a></li>
                        
                        <!-- <li class="#active"><a href="#" class=""><i class="fa fa-user"></i> Profile</a></li>
                         --><li><a href="/user/books"><i class="fa fa-th-list"></i></span> List of Books</a></li>
                        <li><a href="/user/books/borrowed"><i class="fa fa-book"></i> Borrowed Books</a></li>
                        <li><a href="/user/archives"><i class="fa fa-archive"></i> Archives</a></li>
                        

                         <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    @if(Route::getCurrentRoute()->getPath() != "user")
                    <a href="/user/logout" title="Logout" style="float: right;"><button class="btn btn-danger" style="margin: 10px;"><i class="fa fa-sign-out"></i></button></a>
                    @endif
                </nav>
                @endif

                @yield('content')

                <script type="text/javascript">  
                    $(document).ready(function () {  
                        $('.dropdown-toggle').dropdown();  
                    });  
               </script>  

                {{ HTML::script('js/bootstrap.min.js') }}

    </body>
</html>
