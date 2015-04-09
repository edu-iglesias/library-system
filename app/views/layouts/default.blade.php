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

        {{ HTML::style('fancy/source/jquery.fancybox.css?v=2.1.5')}}
        {{ HTML::script('fancysource/jquery.fancybox.js?v=2.1.5')}}

        <script type="text/javascript">
        $(document).ready(function() {
            /*
             *  Simple image gallery. Uses default settings
             */

            $('.fancybox').fancybox();

            /*
             *  Different effects
             */

            // Change title type, overlay closing speed
            $(".fancybox-effects-a").fancybox({
                helpers: {
                    title : {
                        type : 'outside'
                    },
                    overlay : {
                        speedOut : 0
                    }
                }
            });

            // Disable opening and closing animations, change title type
            $(".fancybox-effects-b").fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                helpers : {
                    title : {
                        type : 'over'
                    }
                }
            });

            // Set custom style, close if clicked, change title type and overlay color
            $(".fancybox-effects-c").fancybox({
                wrapCSS    : 'fancybox-custom',
                closeClick : true,

                openEffect : 'none',

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    overlay : {
                        css : {
                            'background' : 'rgba(238,238,238,0.85)'
                        }
                    }
                }
            });

            // Remove padding, set opening and closing animations, close if clicked and disable overlay
            $(".fancybox-effects-d").fancybox({
                padding: 0,

                openEffect : 'elastic',
                openSpeed  : 150,

                closeEffect : 'elastic',
                closeSpeed  : 150,

                closeClick : true,

                helpers : {
                    overlay : null
                }
            });

            /*
             *  Button helper. Disable animations, hide close button, change title type and content
             */

            $('.fancybox-buttons').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    buttons : {}
                },

                afterLoad : function() {
                    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                }
            });


            /*
             *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
             */

            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,
                arrows    : false,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });

            /*
             *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
            */
            $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    nextEffect : 'none',

                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    }
                });

            /*
             *  Open manually
             */

            $("#fancybox-manual-a").click(function() {
                $.fancybox.open('1_b.jpg');
            });

            $("#fancybox-manual-b").click(function() {
                $.fancybox.open({
                    href : 'iframe.html',
                    type : 'iframe',
                    padding : 5
                });
            });

            $("#fancybox-manual-c").click(function() {
                $.fancybox.open([
                    {
                        href : '1_b.jpg',
                        title : 'My title'
                    }, {
                        href : '2_b.jpg',
                        title : '2nd title'
                    }, {
                        href : '3_b.jpg'
                    }
                ], {
                    helpers : {
                        thumbs : {
                            width: 75,
                            height: 50
                        }
                    }
                });
            });


        });
    </script>
    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }


    </style>

        {{ HTML::style('css/custom.css') }}
    
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
                    <a class="navbar-brand" href="/" style="color:#008cba;">{{ HTML::image('images/logo2.png',"",['height'=>'25px', 'width'=>'25px']) }} WSA Library System</font></a>
                </div>

                <!-- div for side and top menu -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <!-- Side Menu -->
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="/admin" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="">
                            <a href="/admin/users" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);"> <i class="fa fa-user"></i> Manage Users </a>
                        </li>
                        <li class="">
                            <a href="/admin/books" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);"><i class="fa fa-book"></i> Manage Books</a>
                        </li>
                        <li class="">
                            <a href="/admin/books/borrowed" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);"><i class="fa fa-table"></i> Borrowed Books</a>
                        </li>
                        <li class="">
                            <a href="/admin/archives" style="border-bottom: solid 1px rgba(0, 0, 0, 0.2);"><i class="fa fa-archive"></i> View Archives</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> {{ Session::get('admin_firstname') . " " . Session::get('admin_lastname') }}  <b class="caret" style="margin-top: 0;"></b>
                            </a>



                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#t"><i class="fa fa-user-secret"></i> Edit Profile</a>
                                </li>
                                <li>
                                    <a href="/admin/logout"><i class="fa fa-sign-out"></i></i> Log Out</a>
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
                    <br>
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

       {{ HTML::script('js/bootstrap.min.js') }}

       @yield('footer')

    </body>
</html>