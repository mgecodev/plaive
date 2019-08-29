<style>
    .hover-btn-new::before {
        height: 100%;
        left: 0;
        top: 0;
        width: 100%;
    }

    .hover-btn-new::after {
        background: #eea412 !important;
        height: 100%;
        left: 0;
        top: 0;
        width: 100%;
    }

    .hover-btn-new span {
        position: relative;
        z-index: 2;
    }

    .hover-btn-new:hover:after {
        height: 0;
        left: 50%;
        top: 50%;
        width: 0;
    }
</style>

<div id="courses">
    <div class="container">
        <div class="row">
            @foreach($courses as $course)
                <?php
                $courseworks = $course->getCoursework()->get()->toarray();
                ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="course-item">
                        <div class="image-blog">
                            @if($course->CourseImage == null)
                                <img src="/images/blog_1.jpg" alt="" class="img-fluid"
                                     style="max-height:200px;min-height:200px;">
                            @else
                                <img src="{{ $course->CourseImage }}" alt="" class="img-fluid"
                                     style="max-height:200px;min-height:200px;">
                            @endif
                        </div>
                        <div class="course-br" onclick="goCoursework({{ $course->CourseId }})">
                            <div class="course-title">
                                <h2><a href="#" title="">{{ str_limit($course->Title, 24) }}</a></h2>
                            </div>
                            <div class="course-desc">
                                <p>{{ str_limit($course->Comment, 30) }}</p>
                            </div>
                        </div>
                        <button type="button" href="/ManageCourse/{{ $course->CourseId }}/specific">세부사항 설정</button>

                        <div class="course-meta-bot">
                            <ul>
                                <li><i class="fa fa-users" aria-hidden="true"></i> {{ $course->NumOfStudent }} 학생들</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $course->HourCount }} 시수</li>
                                <li><i class="fa fa-book" aria-hidden="true"></i> {{ $course->WeekCount }} 주수</li>
                            </ul>
                        </div>
                        <div class="big-tagline" style="text-align: center;">
                            <span class="switchery switchery-default"
                                  style="background-color: rgb(0, 153, 255); border-color: rgb(0, 153, 255); box-shadow: rgb(0, 153, 255) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small
                                    style="left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                            <a href="javascript:void(0)" class="hover-btn-new"
                               onclick="myFunction('{{ $course->CreatedBy }}','{{ $course->CourseId }}','{{ $course->Title }}','{{ $course->Comment }}','{{ $course->NumOfStudent }}','{{ $course->HourCount }}','{{ $course->WeekCount }}','{{ $course->Prerequisite }}')"><span>수정</span></a>
                            <a href="#" class="hover-btn-new"
                               onclick="clickDelete('{{ $course->CreatedBy }}', '{{ $course->CourseId }}', '{{ $course->Title }}')"><span>삭제</span></a>
                        </div>
                    </div>
                </div><!-- end col -->
                {{-- <hr class="hr3">  --}}
            @endforeach
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->
<script>
    // Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
    $('.switch-btn').each(function () {
        new Switchery($(this)[0], $(this).data());
    });

    // Bootstrap Touchspin
    $("input[name='demo_vertical2']").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'fa fa-plus',
        verticaldownclass: 'fa fa-minus'
    });
    $("input[name='demo3']").TouchSpin();
    $("input[name='demo1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
    $("input[name='demo2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: '$'
    });
    $("input[name='demo3_22']").TouchSpin({
        initval: 40
    });
    $("input[name='demo5']").TouchSpin({
        prefix: "pre",
        postfix: "post"
    });

    var arr = new Array();

    function buildCourse(_jsoncourseworks, _weekcount, _courseid, _createdby) {

        _courseworks = JSON.parse(_jsoncourseworks);
        console.log(_courseworks);
        var len = _courseworks.length;
        console.log(len);
        for (var i = 0; i < _courseworks.length; i++) {
            console.log(_courseworks[i]['Content']);
        }

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('커리큘럼 정보를 입력해주세요');
        $("#modal-content1").empty();

        for (var i = 0; i < _weekcount; i++) {
            arr[i] = 1; // initialize
        }

        var content = '<form>';

        if (len == 0) {
            for (var i = 1; i <= _weekcount; i++) {
                content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">' + i + ' 주차' + '</label><div class="col-sm-12 col-md-8" id="week_' + i + '">';
                content += '<input class="form-control" value="" type="search" id="week' + i + '"></div><a href="javascript:void(0);" onclick="appendRow(' + i + ');">';
                content += '<i class="icon-copy ion-plus-circled"></i></a><div></div></div>';
            }
        } else {
            var value = null, week, day;
            var res = new Array();

            // change array into new array which is called as res
            for (var i = 0; i < len; i++) {

                value = _courseworks[i]['Content'];
                week = _courseworks[i]['WeekNumber'];
                day = _courseworks[i]['ContentNumber'];
                try {
                    res[week][day] = value;
                } catch(e) {
                    res[week] = new Array();
                    res[week][day] = value;
                }
            }
            console.log(res);
            for (var i = 1; i <= _weekcount; i++) {
                // console.log(res[i][0]);
                content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">' + i + ' 주차' + '</label><div class="col-sm-12 col-md-8" id="week_' + i + '">';
                try {
                    content += '<input class="form-control" value="' + res[i][0] + '" type="search" id="week' + i + '">';
                    for(var j=1;j<res[i].length;j++) {
                        content += '<br><input class="form-control" placeholder="소주제" type="search" value="'+res[i][j]+'">';
                        content += '<a href="javascript:void(0);" onclick="appendRow(' + i + ');">';
                        content += '<i class="icon-copy ion-plus-circled"></i></a>';
                    }
                    content += '</div><a href="javascript:void(0);" onclick="appendRow(' + i + ');">';
                } catch(e){
                    content += '<input class="form-control" value="" type="search" id="week' + i + '"></div><a href="javascript:void(0);" onclick="appendRow(' + i + ');">';
                }
                content += '<i class="icon-copy ion-plus-circled"></i></a></div>';
            }

        }

        content += '</form>';


        $("#modal-content1").append(content);

        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" data-dismiss="modal" id="save-course">저장</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');

        $('#save-course').click(function (e) {

            var result = new Array(_weekcount);
            console.log(arr);

            for (var i = 0; i < _weekcount; i++) {  // get data from every step

                result[i] = [];
                for (var j = 0; j < arr[i]; j++) {
                    if (j == 0) { // save main title

                        var main_title = 'week' + i;
                        if (document.getElementById(main_title) == null) {
                            continue;
                        } else {
                            var main = document.getElementById(main_title).value;
                        }
                        // alert(main);
                        result[i][j] = main;
                    } else { // save sub title
                        var sub_title = 'week_' + i + '_' + j;
                        if (document.getElementById(sub_title) == null) {
                            continue;
                        } else {
                            var sub = document.getElementById(sub_title).value;
                        }

                        // alert(sub);
                        result[i][j] = sub;
                    }
                }
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/ManageCourse/SaveCurriculum',
                data: {
                    "_result": result,
                    "_courseid": _courseid,
                    "_createdby": _createdby
                },
                success: function (data) {
                    $("#modal-success-title").empty();
                    $("#modal-success-title").append('커리큘럼 등록 성공');
                    $("#modal-content6").empty();
                    $("#modal-content6").append('성공적으로 등록 되었습니다.');
                    $("#modal-success-button").empty();
                    $("#modal-success-button").append(' <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
                    $("#success-modal").modal('show');
                    $('#courses').html(data)
                },
                error: function (request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                    alert('fail');
                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
            // alert(result);
        });
    }

    function appendRow(i) {

        var week = 'week_' + i;
        // alert(arr[i]);
        var sub_id = week + '_' + arr[i];
        arr[i] += 1;    // count how many time the button has pushed

        var d = document.getElementById(week);
        // d.innerHTML += "<input type='text' id='tst" + i++ + "'><br >";
        d.innerHTML += '<br><input class="form-control" placeholder="소주제" type="search" id=' + sub_id + '>';
    }

    function myFunction(_createdby, _courseid, _title, _comment, _numofstudent, _hourcount, _weekcount, _prerequisite) {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌 정보를 수정해주세요');
        $("#modal-content1").empty();

        var content = '<form>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">제목</label><div class="col-sm-12 col-md-10"><input class="form-control" id="title" type="Title" value="' + _title + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">소개말</label><div class="col-sm-12 col-md-10"><input class="form-control" id="comment" type="Comment" value="' + _comment + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">학생 수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="numofstudent" type="NumOfStudent" value="' + _numofstudent + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">주수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="weekcount" type="Title" value="' + _weekcount + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">시수</label><div class="col-sm-12 col-md-10"><input class="form-control" id="hourcount" type="Title" value="' + _hourcount + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">선수강과목</label><div class="col-sm-12 col-md-10"><input id="prerequisite" class="form-control" type="text" placeholder="선수강 과목" value="' + _prerequisite + '"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">썸네일</label><div class="col-sm-12 col-md-10"><input type="file" class="form-control" id="images" name="file" accept="image/*" /></div></div>';
        content += '</form>';

        $("#modal-content1").append(content);
        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" data-dismiss="modal" id="save">저장</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');

        $('#save').click(function (e) {

            var title = document.getElementById("title").value;
            var comment = document.getElementById("comment").value;
            var numofstudent = document.getElementById("numofstudent").value;
            var weekcount = document.getElementById("weekcount").value;
            var hourcount = document.getElementById("hourcount").value;
            var prerequisite = document.getElementById("prerequisite").value;
            if (title == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>강좌 제목을 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if (numofstudent == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>학생 수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if (hourcount == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>시수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if (weekcount == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>주수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if (comment == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>소개말을 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else {
                var formData = new FormData();
                formData.append("course_image", $("input[name=file]")[0].files[0]);
                formData.append("_userid", _createdby);
                formData.append("_courseid", _courseid);
                formData.append("_title", title);
                formData.append("_comment", comment);
                formData.append("_numofstudent", numofstudent);
                formData.append("_weekcount", weekcount);
                formData.append("_hourcount", hourcount);
                formData.append("_prerequisite", prerequisite);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '/ManageCourse/UpdateCourse',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (data) {
                        $("#modal-success-title").empty();
                        $("#modal-success-title").append('수정 성공');
                        $("#modal-content6").empty();
                        $("#modal-content6").append('성공적으로 수정 되었습니다.');
                        $("#modal-success-button").empty();
                        $("#modal-success-button").append(' <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
                        $("#success-modal").modal('show');
                        $('#courses').html(data)
                    },
                    error: function (request, status, error) {
                        // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                        //console.log(request + "/" + status + "/" + error);
                    }
                }) // End Ajax Request
            }
        });
    }

    function clickDelete(_userid, _courseid, _coursename) {
        $("#confirmation-title").empty();
        $("#confirm-content1").empty();
        $("#confirm-content2").empty();
        $("#confirmation-title").append(_coursename + ' 을 지우겠습니까?');
        var content1 = '<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>';
        content1 += '아니오';
        var content2 = '<button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" onclick="CourseDelete(' + _userid + ',' + _courseid + ')"><i class="fa fa-check"></i></button>';
        content2 += '예';
        $("#confirm-content1").append(content1);
        $("#confirm-content2").append(content2);
        $("#confirmation-modal").modal('show');
    }

    function CourseDelete(_userid, _courseid) {
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: '/ManageCourse/DeleteCourse',
            type: 'POST',
            data: {
                "_token": token,
                "_userid": _userid,
                "_courseid": _courseid
            },
            success: function (data) {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('삭제 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 삭제 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
                $("#success-modal").modal('show');
                $('#courses').html(data)
            },
            error: function () {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>삭제 실패 하였습니다.</p>');
                $("#alert-modal").modal('show');
            }
        });
    }
    function goCoursework(_courseid) {
        location.href = '/EnrollCourseDetail/'+_courseid;
    }
</script>
