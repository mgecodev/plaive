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
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="course-item">
                        <div class="image-blog">
                            <img src="/images/blog_1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="course-br">
                            <div class="course-title">
                                <h2><a href="#" title="">{{ $course->Title }}</a></h2>
                            </div>
                            <div class="course-desc">
                                <p>{{ $course->Comment }}</p>
                            </div>
                            <div class="course-rating">
                                4.5
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half"></i>
                            </div>
                        </div>
                        <div class="course-meta-bot">
                            <ul>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $course->NumOfStudent }} 학생들
                                </li>
                                <li><i class="fa fa-users" aria-hidden="true"></i> {{ $course->HourCount }} 시수</li>
                                <li><i class="fa fa-book" aria-hidden="true"></i> {{ $course->WeekCount }} 주수</li>
                            </ul>
                        </div>
                        <div class="big-tagline" style="text-align: center;">
                            <span class="switchery switchery-default"
                                  style="background-color: rgb(0, 153, 255); border-color: rgb(0, 153, 255); box-shadow: rgb(0, 153, 255) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small
                                    style="left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>
                            <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal"
                               onclick="myFunction('{{ $course->CreatedBy }}','{{ $course->CourseId }}','{{ $course->Title }}','{{ $course->Comment }}','{{ $course->NumOfStudent }}','{{ $course->HourCount }}','{{ $course->WeekCount }}')"><span>수정</span></a>
                            <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal"
                               onclick="buildCourse('{{ $course->WeekCount }}', '{{ $course->CourseId }}', '{{ $course->CreatedBy }}')"><span>커리큘럼 작성</span></a>
                            <a href="#" class="hover-btn-new" data-toggle="modal"
                               data-target="#confirmation-modal"><span>삭제</span></a>
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
                                                            data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                    아니요
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" id="yes" val="{{ $course->CourseId }}"
                                                            user="{{ $course->CreatedBy }}"
                                                            class="btn btn-primary border-radius-100 btn-block confirmation-btn"
                                                            data-dismiss="modal"><i class="fa fa-check"></i></button>
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

    $("#yes").click(function (e) {

        e.preventDefault();

        var user_id = $(this).attr('user');
        var id = $(this).attr('val');
        // var user_id = $(this).attr('user');

        // alert(user_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/ManageCourse/DeleteCourse',
            data: {
                'course_id': id,
                '_userid': user_id,
                '_createdby': _createdby
            },
            success: function (data) {
                $('#courses').html(data)
            },
            error: function (request, status, error) {
                alert("error!");
            }
        }) // End Ajax Request
    });

    var arr = new Array();

    function buildCourse(_weekcount, _courseid, _createdby) {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('커리큘럼 정보를 입력해주세요');
        $("#modal-content1").empty();

        for (var i = 0; i < _weekcount; i++) {
            arr[i] = 1; // initialize
        }

        var content = '<form>';
        for (var i = 0; i < _weekcount; i++) {
            content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">' + i + ' 주차' + '</label><div class="col-sm-12 col-md-8" id="week_' + i + '"><input class="form-control" placeholder="Search Here" type="search" id="week' + i + '"></div><a href="javascript:void(0);" onclick="appendRow('+i+');"><i class="icon-copy ion-plus-circled"></i></a><div></div></div>';
        }
        content += '</form>';

        $("#modal-content1").append(content);

        $("#large-modal-button").empty();

        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" id="save-course">저장</button>';

        $("#large-modal-button").append(content);
        $("#Large-modal").modal('show');

        $('#save-course').click(function(e) {

            var result = new Array(_weekcount);
            console.log(arr);

            for (var i = 0; i < _weekcount; i++) {  // get data from every step

                result[i] = [];
                for (var j = 0; j < arr[i]; j++) {
                    if (j == 0) { // save main title

                        var main_title = 'week'+i;
                        if (document.getElementById(main_title) == null) {
                            continue;
                        }
                        else {
                            var main = document.getElementById(main_title).value;
                        }
                        // alert(main);
                        result[i][j] = main;
                    }
                    else { // save sub title
                        var sub_title = 'week_'+i+'_'+j;
                        if (document.getElementById(sub_title) == null) {
                            continue;
                        }
                        else {
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
                    "_courseid": _courseid
                },
                success: function (data) {

                    alert("success");
                    $('#courses').html(data)
                    $("#Large-modal").modal('hide');

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

        var week = 'week_'+i;
        // alert(arr[i]);
        var sub_id = week +'_'+arr[i];
        arr[i] += 1;    // count how many time the button has pushed

        var d = document.getElementById(week);
        // d.innerHTML += "<input type='text' id='tst" + i++ + "'><br >";
        d.innerHTML += '<br><input class="form-control" placeholder="소주제" type="search" id='+sub_id+'>';
    }

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
