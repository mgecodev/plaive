\<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- CSS -->
<style>
    .center {
        width: 200px !important;
        margin: 0 auto !important;
    }
    .test {
        width:700px;
        display:inline-block;
        overflow: auto;
        white-space: nowrap;
        margin:0px auto;
        /*border:1px red solid;*/
    }
</style>

<script>
    $(document).ready(function () {
    });
</script>

<!-- CSS -->
<link rel="stylesheet" type="text/css"
      href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/vendors/styles/style.css">
<link rel="stylesheet" type="text/css"
      href="https://s3.ap-northeast-2.amazonaws.com/s3.finedust.10make.com/plaive/src/plugins/jquery-steps/build/jquery.steps.css">
<div id="courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="big-tagline">
                        <h2><strong>클래스</strong>를 개설하고 학생들을 초대해 보세요.</h2>
                        <div style="height:10px;"></div>
                        <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal"
                           onclick="myFunction1()">
                            <span>클래스 개설하기</span>
                        </a>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
        <hr class="hr3">
    </div><!-- end container -->
</div><!-- end section -->

<script>

    var arr = new Array();

    function inviteStudent(_courseid, _id) {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('학생을 초대해주세요(2 / 3)');
        $("#modal-content1").empty();
        var content = '<div class="table-responsive text-center" style="color:black;">';
        content += '<table class="table table-bordered stripe hover nowrap" id="second_table" style="width:100%;"><thead><tr><th>학생 이름</th><th>이메일</th><th class="datatable-nosort datatable-nosearch"></th></tr></thead>';
        content += '<tbody>@foreach($students as $student)<tr><td>{{ $student->name }}</td><td>{{ $student->email }}</td><td><button type="button" class="btn btn-primary choose" id="choose_{{ $student->id }}" val="{{ $student->id }}">선택</button></td>';
        content += '@endforeach</tbody></table>';
        content += '</div>';

        $("#modal-content1").append(content);
        var lang_kor = {
            "decimal": "",
            "emptyTable": "데이터가 없습니다.",
            "info": "_START_ - _END_ (총 _TOTAL_ 개)",
            "infoEmpty": "0개",
            "infoFiltered": "(전체 _MAX_ 개 중 검색결과)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "_MENU_ 개씩 보기",
            "loadingRecords": "로딩중...",
            "processing": "처리중...",
            "search": "검색 : ",
            "zeroRecords": "검색된 데이터가 없습니다.",
            "paginate": {
                "first": "첫 페이지",
                "last": "마지막 페이지",
                "next": "다음",
                "previous": "이전"
            },
            "searchPlaceholder": "검색어",
            "aria": {
                "sortAscending": " :  오름차순 정렬",
                "sortDescending": " :  내림차순 정렬"
            }
        };
        $('#second_table').DataTable({
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }, {
                targets: "datatable-nosearch",
                searchable: false,
            }],
            language: lang_kor
        });

        $("#large-modal-button").empty();
        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" id="save">다음</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');

        $('.choose').click(function(e) {

            var id = $(this).attr('id');
            e.preventDefault();
            if($(this).html() == "선택") {
                $(this).html('취소');
                $(this).removeClass("btn-primary");
                $(this).addClass("btn-danger");                 
                var _accountid = $(this).attr('val');
                arr.push(_accountid);
            } else {
                $(this).html('선택');
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-primary"); 
                var _accountid = $(this).attr('val');
                arr = arr.filter(e => e !== _accountid);
            }
        });

        $('#save').click(function(e) {
            e.preventDefault();
            if(arr != "") {
                ClassName(_courseid, _id);
            } else {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>최소 한명 이상 학생을 선택하여 주세요</p>');
                $("#alert-modal").modal('show');
            }
        })
    }

    function myFunction1() {
        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌를 선택해 주세요(1 / 3)');
        $("#modal-content1").empty();

        // var content = '<form>';
        var content = '<div class="table-responsive text-center" style="color:black;">';
        content += '<table class="table table-bordered stripe hover nowrap" id="table" style="width:100%;"><thead><tr><th>코스 제목</th><th>선생님</th><th class="datatable-nosort datatable-nosearch"></th></tr></thead>';
        content += '<tbody>@foreach($courses as $course)<tr><td>{{ $course->Title }}</td>@if ($course->CreatedBy == 0)<td>{{ "Plaive" }}</td>';
        content += '@else<td>{{ $course->getTeacherInfo()->first()->name }}</td>@endif<td><button type="button" class="btn btn-primary" onclick="inviteStudent({{ $course->CourseId }}, {{ $id }})">선택</button></td></tr>@endforeach</tbody></table>';
        content += '</div>';

        $("#modal-content1").append(content);
        var lang_kor = {
            "decimal": "",
            "emptyTable": "데이터가 없습니다.",
            "info": "_START_ - _END_ (총 _TOTAL_ 개)",
            "infoEmpty": "0개",
            "infoFiltered": "(전체 _MAX_ 개 중 검색결과)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "_MENU_ 개씩 보기",
            "loadingRecords": "로딩중...",
            "processing": "처리중...",
            "search": "검색 : ",
            "zeroRecords": "검색된 데이터가 없습니다.",
            "paginate": {
                "first": "첫 페이지",
                "last": "마지막 페이지",
                "next": "다음",
                "previous": "이전"
            },
            "searchPlaceholder": "검색어",
            "aria": {
                "sortAscending": " :  오름차순 정렬",
                "sortDescending": " :  내림차순 정렬"
            }
        };
        $('#table').DataTable({
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }, {
                targets: "datatable-nosearch",
                searchable: false,
            }],
            language: lang_kor
        });
        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');
    }
    function ClassName(_courseid, _id) {
        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('클래스 정보 입력(3 / 3)');
        $("#modal-content1").empty();

        var content = '<div class="form-group">';
        content += '<label style="color:black;font-size:1rem;">클래스 이름<font color="red">(필수)</font></label>';
        content += '<input class="form-control" id="class_name" type="text" placeholder="클래스 이름">';
        content += '</div>';
        content += '<div class="form-group">';
        content += '<label style="color:black;font-size:1rem;">클래스 썸네일(입력 안할 경우 기본 이미지)</label>';
        content += '<input type="file" class="form-control" id="images" name="file" accept="image/*" />';            
        content += '</div>';
        $("#modal-content1").append(content);
        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-primary" onclick="ClassNext('+_courseid+','+_id+')">저장</button>';
        content += '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');
    }
    function ClassNext(_courseid,_id) {
        var class_name = $("#class_name").val();
        if(class_name != "") {
            var formData = new FormData();
            formData.append("class_name",class_name);
            formData.append("class_image",$("input[name=file]")[0].files[0]);
            formData.append("_courseid",_courseid);
            formData.append("_teacherid",_id);
            formData.append("_checked_students",arr);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                processData: false,
                contentType: false,
                url: '/ManageClass/IncludeStudent',
                data: formData,
                success: function (data) {
                    // $('#courses').html(data)
                    $("#Large-modal").modal('hide');
                    if(data.result == "Success"){
                        $("#Large-modal").modal('hide');
                        $("#modal-success-title").empty();
                        $("#modal-success-title").append('등록 성공');
                        $("#modal-content6").empty();
                        $("#modal-content6").append('성공적으로 등록 되었습니다.');
                        $("#modal-success-button").empty();
                        $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="location.reload()">확인</button>');
                        $("#success-modal").modal('show');
                    } else {
                        $("#modal-content4").empty();
                        $("#modal-content4").append('<p>등록 실패 다시 시도해주세요</p>');
                        $("#alert-modal").modal('show');
                    }
                },
                error: function (request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
        } else {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>이름을 입력하여 주세요.</p>');
            $("#alert-modal").modal('show');
        }
    }
</script>

