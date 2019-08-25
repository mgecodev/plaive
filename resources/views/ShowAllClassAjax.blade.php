<div class="row">
    <div id="courses">
        <div class="container">
            <div class="row">
                @foreach($classes as $class)
                    <?php
                    $course_info = $class->getCourseInfo()->first();
                    $student_info = $class->getStudentInfo()->count();
                    $tot_invited_student = $class->getTotalInvitedStudent()->where('InviterId', $id)->count();
                    $matched_student_info = $class->getMatchedStudent()->where('Accepted', 1)->where('InviterId', $id)->count();
                    ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                                @if($class->ClassImage  == null)
                                    <img src="/images/blog_1.jpg" alt="" class="img-fluid">
                                @else 
                                    <img src={{ $class->ClassImage }} alt="" class="img-fluid">
                                @endif
                            </div>
                            <div class="course-br">
                                <div class="course-title" style="text-align:center;">
                                    <h2><a href="/Class/{{ $class->ClassId }}" target="_blank">{{ str_limit($class->ClassName,24) }}</a></h2>
                                </div>
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-calendar"
                                           aria-hidden="true"></i> 초대된 학생들 {{ $tot_invited_student }}
                                    </li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> 수락한
                                        학생들 {{ $matched_student_info }}
                                    </li>
                                </ul>
                            </div>
                            <div class="big-tagline" style="text-align: center;">
                                <a href="javascript:void(0)" class="hover-btn-new"
                                   onclick="ClassModify({{ $class->ClassId }})"><span>수정</span></a>
                                <a href="#" class="hover-btn-new" data-toggle="modal" data-target="#confirmation-modal"><span>삭제</span></a>
                                <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center font-18">
                                                <h4 class="padding-top-30 mb-30 weight-500">정말 삭제하시겠습니까?</h4>
                                                <div class="padding-bottom-30 row"
                                                     style="max-width: 170px; margin: 0 auto;">
                                                    <div class="col-6">
                                                        <button type="button" id="no"
                                                                class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                                                data-dismiss="modal"><i class="fa fa-times"></i>
                                                        </button>
                                                        아니요
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" id="yes" val="{{ $class->ClassId }}"
                                                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                                                data-dismiss="modal"><i class="fa fa-check"></i>
                                                        </button>
                                                        네
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
</div><!-- end row -->


<script>
    $("#yes").click(function (e) {

        e.preventDefault();

        var user_id = $(this).attr('user');
        var id = $(this).attr('val');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/ManageClass/DeleteClass',
            data: {
                '_classid': id
            },
            success: function (data) {
                $('#courses').html(data)
            },
            error: function (request, status, error) {
                alert("error!");
            }
        }) // End Ajax Request
    });

    function ClassModify(_classid) {
        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌 수정(1 / 2) - 강좌를 수정 안할 경우 다음 버튼을 눌러주세요');
        $("#modal-content1").empty();

        var content = '<div class="table-responsive text-center" style="color:black;">';
        content += '<table class="table table-bordered stripe hover nowrap" id="table" style="width:100%;"><thead><tr><th>코스 제목</th><th>선생님</th><th class="datatable-nosort datatable-nosearch"></th></tr></thead>';
        content += '<tbody>@foreach($courses as $course)<tr><td>{{ $course->Title }}</td>@if ($course->CreatedBy == 0)<td>{{ "Plaive" }}</td>';
        content += '@else<td>{{ $course->getTeacherInfo()->first()->name }}</td>@endif<td><button type="button" class="btn btn-primary" onclick="ClassName('+_classid+', {{ $course->CourseId }})">선택</button></td></tr>@endforeach</tbody></table>';
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

        var content = '<button type="button" class="btn btn-primary" onclick="ClassName('+_classid+',0)">다음</button>';
        content += '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');
    }
    function ClassName(_classid, _courseid) {
        console.log(_courseid);
        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('클래스 정보 수정(2 / 2)');
        $("#modal-content1").empty();

        var content = '<div class="form-group">';
        content += '<label style="color:black;font-size:1rem;">클래스 이름</label>';
        content += '<input class="form-control" id="class_name" type="text" placeholder="클래스 이름">';
        content += '</div>';
        content += '<div class="form-group">';
        content += '<label style="color:black;font-size:1rem;">클래스 썸네일</label>';
        content += '<input type="file" class="form-control" id="images" name="file" accept="image/*" />';            
        content += '</div>';
        $("#modal-content1").append(content);
        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-primary" onclick="ClassNext('+_courseid+','+_classid+')">저장</button>';
        content += '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');
    }
    function ClassNext(_courseid,_classid) {
        var class_name = $("#class_name").val();
        if(class_name != "") {
            var formData = new FormData();
            formData.append("class_name",class_name);
            formData.append("class_image",$("input[name=file]")[0].files[0]);
            formData.append("_courseid",_courseid);
            formData.append("_classid",_classid);
            formData.append('_method','PATCH');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                processData: false,
                contentType: false,
                url: '/ManageClass/IncludeStudent/'+_classid,
                data: formData,
                success: function (data) {
                    // $('#courses').html(data)
                    $("#Large-modal").modal('hide');
                    alert("success!");
                },
                error: function (request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
        } else {
            alert("이름 입력");
        }
    }
</script>
