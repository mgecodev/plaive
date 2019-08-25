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
                                <img src="/images/blog_1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2><a href="/Class/{{ $class->ClassId }}" target="_blank">{{ str_limit($course_info->Title,30) }}</a></h2>
                                </div>
                                <div class="course-desc">
                                    <p>{{ str_limit($course_info->Comment,30) }}</p>
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
                                   data-toggle="modal"><span>수정</span></a>
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

    function myFunction(_createdby, _courseid, _title, _comment, _numofstudent, _weekcount, _hourcount) {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌 정보를 수정해주세요');
        $("#modal-content1").empty();

        var content = '<form>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">제목</label><div class="col-sm-12 col-md-10"><input class="form-control" id="title" type="Title" value="' + _title + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">코멘트</label><div class="col-sm-12 col-md-10"><input class="form-control" id="comment" type="Comment" value="' + _comment + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">학생 수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="numofstudent" type="NumOfStudent" value="' + _numofstudent + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">주수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="weekcount" type="Title" value="' + _weekcount + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">시수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="hourcount" type="Title" value="' + _hourcount + '"></div></div>';
        content += '</form>';

        $("#modal-content1").append(content);

        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" id="save">저장</button>';


        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');

        $('#save').click(function (e) {

            var title = document.getElementById("title").value;
            var comment = document.getElementById("comment").value;
            var numofstudent = document.getElementById("numofstudent").value;
            var weekcount = document.getElementById("weekcount").value;
            var hourcount = document.getElementById("hourcount").value;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/ManageCourse/UpdateCourse',
                data: {
                    "_userid": _createdby,
                    "_courseid": _courseid,
                    "_title": title,
                    "_comment": comment,
                    "_numofstudent": numofstudent,
                    "_weekcount": weekcount,
                    "_hourcount": hourcount
                },
                success: function (data) {

                    $('#courses').html(data)
                    $("#Large-modal").modal('hide');

                },
                error: function (request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
        });
    }
</script>
