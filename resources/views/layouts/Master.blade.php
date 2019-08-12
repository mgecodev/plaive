<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <style>

        .status--waiting {
            color: #fff900;
        }

        .table-earning thead th {
            background: #4c5a7d !important;
            font-size: 16px;
            color: #fff;
            vertical-align: middle;
            font-weight: 400;
            text-transform: capitalize;
            line-height: 1;
            padding: 22px 40px;
            white-space: nowrap;
        }

        .close{
            padding:1rem;
            margin:0rem 0rem 0rem auto !important;
        }
    </style>
    <!-- Basic -->
    <meta charset="utf-8">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- Site Metas -->
    <title>Plaive Education Management Service</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!--link rel="stylesheet" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/framework/bootstrap-4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"-->
    <link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/responsive.dataTables.css">

	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/bootstrap-wysihtml5-master/src/bootstrap-wysihtml5.css">
    <link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/bootstrap-4.0.0/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/fonts/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/fonts/foundation-icons/foundation-icons.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/fonts/ionicons-master/css/ionicons.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/fonts/themify-icons/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/air-datepicker/dist/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/timedropper/timedropper.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/highlight.js/src/styles/solarized-dark.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/select2/dist/css/select2.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/bootstrap-select/dist/css/bootstrap-select.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/styles/style.css">
	<link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/styles/media.css">

    <!-- Site CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="/css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Modernizer for Portfolio -->
    <script src="/js/modernizer.js"></script>


    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="host_version">

	<!-- Modal -->
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
	@include('layouts.Header')
	<!-- End header -->
    <div class="all-title-box">
        <div class="container text-center">
            @yield('page_title')
        </div>
    </div>
	<!-- Start content -->
    @yield('content')
	<!-- End content -->

    <!-- Start footer -->
    @include('layouts.Footer')
	<!-- End footer -->

    <!-- Start copyrights -->
    @include('layouts.Copyrights')
    <!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="/js/all.js"></script>
    <!--script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script-->
    <script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/jquery.dataTables.min.js"></script>
	<script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/dataTables.bootstrap4.js"></script>
	<script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/dataTables.responsive.js"></script>
	<script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/responsive.bootstrap4.js"></script>
    <!-- ALL PLUGINS -->

    <script src="/js/custom.js"></script>
    <script src="/js/timeline.min.js"></script>
    @yield('javascript')
	<script>
		timeline(document.querySelectorAll('.timeline'), {
			forceVerticalMode: 700,
			mode: 'horizontal',
			verticalStartPosition: 'left',
			visibleItems: 4
		});

        $('#openClassForm').click(function() {

            var title = document.getElementById("title").value;
            var num_of_books = document.getElementById("num_of_books").value;
            var stars = document.getElementById("stars").value;
            var period = document.getElementById("period").value;
            var comments = document.getElementById("comments").value;

            alert('going');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/SaveCourseInfo',
                type:"GET",
                data: {title: title, num_of_books: num_of_books, stars: stars, period: period, comments: comments},
                success: function(data) {

                    alert("success");
                },// end
                error: function(data) {

                    alert("fail");
                }
            });// end ajax
            return false;
        });

        $('#submit').click(function (e) {
                        
            var student_ids = [];
            
            $(':checkbox:checked').each(function(i){
                student_ids[i] = $(this).val();
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'POST',
                url : '/SaveStudent',
                data : {
                    "student_ids" : student_ids
                },
                success : function(data) {
                    
                    $('#overviews').html(data)
                    $('#title_for_invitation').html(student_ids.length + " 명의 학생이 선택되었습니다.");
                    $("#submit").val("되돌리기");
                   
                },
                error: function(request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다. 

                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
        });

    </script>

</body>
</html>
