<!DOCTYPE html>

<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>SmartEDU - Education Responsive HTML5 Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<style>
    /* fix the padding size of body correctly */
    body {
        padding-top: 70px;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: #f5b335;
        transition: top 0.2s ease-in-out;
        z-index: 9999;
    }

    .nav-up {
        top: -40px;
    }

</style>
<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="css/style.css">
<!-- ALL VERSION CSS -->
<link rel="stylesheet" href="css/versions.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/custom.css">

<!-- Modernizer for Portfolio -->
<script src="js/modernizer.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body class="host_version">

<!-- MODAL -->
@include('layouts.LoginModal')

<!-- LOADER -->
<div id="preloader">
    <div class="loader-container">
        <div class="progress-br float shadow">
            <div class="progress__item"></div>
        </div>
    </div>
</div>
<!-- END LOADER -->

<!-- Start header -->
<header class="top-navbar" id="myHeader">
    @include('layouts.header')
</header>
<!-- End header -->

@yield('content')


<footer class="footer">
    @include('layouts.footer')
</footer><!-- end footer -->

<div class="copyrights">
    @include('layouts.copyrights')
</div><!-- end copyrights -->

<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="js/all.js"></script>
<!-- ALL PLUGINS -->
<script src="js/custom.js"></script>
<script src="js/timeline.min.js"></script>
<script>
    timeline(document.querySelectorAll('.timeline'), {
        forceVerticalMode: 700,
        mode: 'horizontal',
        verticalStartPosition: 'left',
        visibleItems: 4
    });
</script>
<script>

    var didScroll;

    $(window).scroll(function (event) {
        didScroll = true;
    }); // hasScrolled()를 실행하고 didScroll 상태를 재설정

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        // 동작을 구현
    }

</script>
</body>
</html>
