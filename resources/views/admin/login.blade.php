<!DOCTYPE html>
<html lang="en-us" id="extr-page">
    <head>
        <meta charset="utf-8">
        <title> Love Dating</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/smartadmin-skins.min.css">

        <!-- SmartAdmin RTL Support is under construction
                 This RTL CSS will be released in version 1.5
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/smartadmin-rtl.min.css"> -->

        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to('/') }}/public/admin/css/your_style.css"> -->



        <!-- #FAVICONS -->
        <link rel="shortcut icon" href="{{ URL::to('/') }}/public/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="{{ URL::to('/') }}/public/images/favicon.ico" type="image/x-icon">

        <!-- #GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- #APP SCREEN / ICONS -->
        <!-- Specifying a Webpage Icon for Web Clip 
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="{{ URL::to('/') }}/public/admin/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to('/') }}/public/admin/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::to('/') }}/public/admin/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::to('/') }}/public/admin/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="{{ URL::to('/') }}/public/admin/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="{{ URL::to('/') }}/public/admin/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="{{ URL::to('/') }}/public/admin/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

    </head>

    <body class="animated fadeInDown">

        <header id="header" style="height: 100px !important;">

            <div id="logo-group">
                <span id="logo"> <img src="{{ URL::to('/') }}/public/images/logo.png" alt="Flop Logo"> </span>
            </div>



        </header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                        <h1 class="txt-color-red login-header-big">About Flop</h1>
                        <div class="hero">

                            <div class="pull-left login-desc-box-l">
                                <h4 class="paragraph-header">Lorium ipsum dummy content. Lorium ipsum dummy content.Lorium ipsum dummy content.Lorium ipsum dummy content.</h4>

                            </div>



                        </div>



                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <div class="well no-padding">
                            <form action="{{ URL::to('/') }}/login" id="login-form" method="post" class="smart-form client-form">
                                <header>
                                    Admin Login Area
                                </header>
                                {{ csrf_field() }}

                                <fieldset>

                                    <section>
                                        <label class="label">E-mail</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                            <span class="help-block" style="color:red">
                                                <i class="fa fa-warning"></i> 
                                                {{ $errors->first('email') }}
                                            </span>
                                            @endif
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address</b></label>
                                    </section>

                                    <section>
                                        <label class="label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input id="password" type="password" class="form-control" name="password">

                                            @if ($errors->has('password'))
                                            <span class="help-block" style="color:red">
                                                <i class="fa fa-warning"> </i>
                                                {{ $errors->first('password') }}
                                            </span>
                                            @endif
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>

                                    </section>


                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        LogIn
                                    </button>
                                </footer>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!--================================================== -->	

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/pace/pace.min.js"></script>

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script> if (!window.jQuery) {
    document.write('<script src="{{ URL::to("/") }}/public/admin/js/libs/jquery-2.0.2.min.js"><\/script>');
}</script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) {
    document.write('<script src="{{ URL::to("/") }}/public/admin/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
}</script>

        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

        <!-- BOOTSTRAP JS -->		
        <script src="{{ URL::to('/') }}/public/admin/js/bootstrap/bootstrap.min.js"></script>

        <!-- JQUERY VALIDATE -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/jquery-validate/jquery.validate.min.js"></script>

        <!-- JQUERY MASKED INPUT -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

        <!--[if IE 8]>
                
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
                
        <![endif]-->

        <!-- MAIN APP JS FILE -->
        <script src="{{ URL::to('/') }}/public/admin/js/app.min.js"></script>

        <script type="text/javascript">
runAllForms();

$(function () {
    // Validation
    $("#login-form").validate({
        // Rules for form validation
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        // Messages for form validation
        messages: {
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a VALID email address'
            },
            password: {
                required: 'Please enter your password'
            }
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        }
    });
});
        </script>

    </body>
</html>