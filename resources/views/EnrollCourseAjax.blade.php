<div id="courses">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="big-tagline">
                        <h2><strong>로고 </strong>직접 강좌를 개설해 보세요.</h2>
                        <p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
            
                        <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal" onclick="myFunction()">
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
    function myFunction() {

        $("#myLargeModalLabel").empty();
        $("#myLargeModalLabel").append('강좌 정보를 입력해주세요');
        $("#modal-content1").empty();

        var content = '<form>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">강좌 제목</label><div class="col-sm-12 col-md-10"><input id="title" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">학생 수</label><div class="col-sm-12 col-md-10"><input id="numofstudent" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">시수</label><div class="col-sm-12 col-md-10"><input id="hourcount" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">주수</label><div class="col-sm-12 col-md-10"><input id="weekcount" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">선수강과목</label><div class="col-sm-12 col-md-10"><input id="prerequisite" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">소개말</label><div class="col-sm-12 col-md-10"><input id="comment" class="form-control" type="text" placeholder="Johnny Brown"></div></div>';
        content += '</form>';

        $("#modal-content1").append(content);

        $("#large-modal-footer").empty();   
       
        var content = '<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>';
        content += '<button type="button" class="btn btn-primary" id="save">저장</button>';

        $("#large-modal-footer").append(content);
        $("#Large-modal").modal('show');
    }
</script>