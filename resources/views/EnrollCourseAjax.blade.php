<div id="courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="big-tagline">
                        <h2><strong>직접 강좌 </strong>를 개설해 보세요.</h2>

                        <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal"
                           onclick="myFunction('{{ $id }}')">
                            <span>강좌 개설하기</span>
                        </a>

                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->

        <hr class="hr3">

    </div><!-- end container -->
</div><!-- end section -->

<script>
    function myFunction(_createdby) {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌 정보를 입력해주세요');
        $("#modal-content1").empty();

        var content = '<form>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">강좌 제목<font color="red">(필수)</font></label><div class="col-sm-12 col-md-10"><input id="title" class="form-control" type="text" placeholder="Data Structure"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">학생 수<font color="red">(필수)</font></label><div class="col-sm-12 col-md-10"><input id="numofstudent" class="form-control" type="text" placeholder="30"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">시수<font color="red">(필수)</font></label><div class="col-sm-12 col-md-10"><input id="hourcount" class="form-control" type="text" placeholder="32"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">주수<font color="red">(필수)</font></label><div class="col-sm-12 col-md-10"><input id="weekcount" class="form-control" type="text" placeholder="16"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">선수강과목<font color="blue">(선택)</font></label><div class="col-sm-12 col-md-10"><input id="prerequisite" class="form-control" type="text" placeholder="C Programming"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">소개말<font color="red">(필수)</font></label><div class="col-sm-12 col-md-10"><input id="comment" class="form-control" type="text" placeholder="Hello world"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">썸네일<font color="blue">(선택)</font></label><div class="col-sm-12 col-md-10"><input type="file" class="form-control" id="images" name="file" accept="image/*" /></div></div>';
        content += '<div class="form-group"><label class="col-form-label" style="color:black;">이미지 선택 안 할 경우 기본이미지로 셋팅 됩니다</label></div>';
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
            var prerequisite = document.getElementById("prerequisite").value;
            if(title == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>강좌 제목을 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if(numofstudent == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>학생 수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if(hourcount == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>시수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if(weekcount == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>주수를 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else if(comment == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>소개말을 입력 해주세요</p>');
                $("#alert-modal").modal('show');
            } else {
                var formData = new FormData();
                formData.append("course_image",$("input[name=file]")[0].files[0]);
                formData.append("_userid",_createdby);
                formData.append("_title",title);
                formData.append("_comment",comment);
                formData.append("_numofstudent",numofstudent);
                formData.append("_weekcount",weekcount);
                formData.append("_hourcount",hourcount);
                formData.append("_prerequisite",prerequisite);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'POST',
                    url : '/ManageCourse/EnrollCourse',
                    processData: false,
                    contentType: false,
                    data : formData,
                    success : function(data) {
                        $('#courses').html(data)
                        $("#Large-modal").modal('hide');
                    },
                    error: function(request, status, error) {
                        // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                        //console.log(request + "/" + status + "/" + error);
                    }
                }) // End Ajax Request
            }
        });
    }

</script>
