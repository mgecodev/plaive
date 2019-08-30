<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>학생 수업 현황</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/css/datatable/responsive.dataTables.css">
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
    <!-- ALL JS FILES -->
    <script src="/js/all.js"></script>
    <script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/jquery.dataTables.min.js"></script>
    <script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/dataTables.bootstrap4.js"></script>
    <script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/dataTables.responsive.js"></script>
    <script src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/js/datatable/responsive.bootstrap4.js"></script>
    <!-- ALL PLUGINS -->
    <script src="/js/custom.js"></script>
    <script>
    var class_id = <?php echo $class_id;?>;
    var coursework_id = <?php echo $coursework_id?>;
    $(document).ready( function () {
        var lang_kor = {
            "decimal" : "",
            "emptyTable" : "데이터가 없습니다.",
            "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
            "infoEmpty" : "0개",
            "infoFiltered" : "(전체 _MAX_ 개 중 검색결과)",
            "infoPostFix" : "",
            "thousands" : ",",
            "lengthMenu" : "_MENU_ 개씩 보기",
            "loadingRecords" : "로딩중...",
            "processing" : "처리중...",
            "search" : "검색 : ",
            "zeroRecords" : "검색된 데이터가 없습니다.",
            "paginate" : {
                "first" : "첫 페이지",
                "last" : "마지막 페이지",
                "next" : "다음",
                "previous" : "이전"
            },
            "searchPlaceholder": "검색어",
            "aria" : {
                "sortAscending" : " :  오름차순 정렬",
                "sortDescending" : " :  내림차순 정렬"
            }
        };
        $('#status_table').DataTable({
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            },{
                targets: "datatable-nosearch",
                searchable: false,
            }],
            language: lang_kor
        });
        $.ajax({
            type : "GET",
            url : "/ShowStatus/student/data/"+class_id+"/"+coursework_id,
            success:function(data) {
                console.log(data);
                if(data.result == "Fail"){

                } else if(data.result == "Success") {
                    for(var i=0;i<data.data.length;i++){
                        var td = "sub_check_"+data.data[i]['AccountId']+"_"+data.data[i]['SubCourseworkId'];
                        $("#"+td).html('<img style="min-height:30px; max-height:30px;" src="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/vendors/images/success.png">');
                    }
                }
            }
        });
    });
    setInterval(() => {
        location.reload();
    }, 60000);
    </script>
</head>
<body class="host_version"> 
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="table-responsive text-center">
                <table class="table table-bordered stripe hover nowrap" id="status_table" style="width:100%;">
                    <thead>
                        <tr>
                        <th class="text-center"></th>
                        @foreach($subcourseworks as $subcoursework)
                        <th class="text-center datatable-nosort datatable-nosearch">{{ $subcoursework->Content }}</th>
                        @endforeach
                        </tr>
                    </thead>
                    @foreach($students as $student)
                        <tr>
                        <td style="vertical-align: middle;">{{ $student->name }}</td>
                            @foreach($subcourseworks as $subcoursework)
                            <td class="text-center" id="sub_check_{{ $student->id }}_{{ $subcoursework->SubCourseworkId }}"></td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div><!-- end container -->
    </div><!-- end section -->
</body>
</html>