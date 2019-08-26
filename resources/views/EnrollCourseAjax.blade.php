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
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">강좌 제목</label><div class="col-sm-12 col-md-10"><input id="title" class="form-control" type="text" placeholder="Data Structure"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">학생 수</label><div class="col-sm-12 col-md-10"><input id="numofstudent" class="form-control" type="text" placeholder="30"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">시수</label><div class="col-sm-12 col-md-10"><input id="hourcount" class="form-control" type="text" placeholder="32"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">주수</label><div class="col-sm-12 col-md-10"><input id="weekcount" class="form-control" type="text" placeholder="16"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">선수강과목</label><div class="col-sm-12 col-md-10"><input id="prerequisite" class="form-control" type="text" placeholder="C Programming"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">소개말</label><div class="col-sm-12 col-md-10"><input id="comment" class="form-control" type="text" placeholder="Hello world"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label" style="color:black;">썸네일</label><div class="col-sm-12 col-md-10"><input type="file" class="form-control" id="images" name="file" accept="image/*" /></div></div>';
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

            } else if(comment == "") {

            } else if(numofstudent == "") {

            } else if(weekcount == "") {

            } else if(hourcount == "") {

            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'POST',
                url : '/ManageCourse/EnrollCourse',
                data : {
                    "_userid" : _createdby,
                    "_title" : title,
                    "_comment" : comment,
                    "_numofstudent" : numofstudent,
                    "_weekcount" : weekcount,
                    "_hourcount" : hourcount,
                    "_prerequisite" : prerequisite
                },
                success : function(data) {

                    $('#courses').html(data)
                    $("#Large-modal").modal('hide');

                },
                error: function(request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                    //console.log(request + "/" + status + "/" + error);
                }
            }) // End Ajax Request
        });
    }

</script>
