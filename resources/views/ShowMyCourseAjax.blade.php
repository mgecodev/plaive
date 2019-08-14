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
    .hover-btn-new span{
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
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $course->NumOfStudent }} 학생들</li>
                                <li><i class="fa fa-users" aria-hidden="true"></i> {{ $course->HourCount }} 시수</li>
                                <li><i class="fa fa-book" aria-hidden="true"></i> {{ $course->WeekCount }} 주수</li>
                            </ul>
                        </div>
                        <div class="big-tagline" style="text-align: center;" >
                            <a href="javascript:void(0)" class="hover-btn-new" data-toggle="modal" onclick="myFunction('{{ $course->Title }}')"><span>수정</span></a>
                            <a href="#" class="hover-btn-new" data-toggle="modal" data-target="#confirmation-modal"><span>삭제</span></a>
                            <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center font-18">
                                            <h4 class="padding-top-30 mb-30 weight-500">정말 삭제하시겠습니까?</h4>
                                            <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                                <div class="col-6">
                                                <button type="button" id="no" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                    아니요
                                                </div>
                                                <div class="col-6">
                                                <button type="button" id="yes" val="{{ $course->CourseId }}" user="{{ $course->CreatedBy }}" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
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

$("#yes").click(function(e) {
            
    e.preventDefault();
    
    var user_id = $(this).attr('user');
    var id = $(this).attr('val');
    // var user_id = $(this).attr('user');

    // alert(user_id);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'POST',
        url : '/ManageCourse/DeleteCourse',
        data : {
            'course_id' : id,
            'user_id' : user_id
        },
        success : function(data) {      
            $('#courses').html(data)
            },
        error: function(request, status, error) {
            alert("error!");
        }
    }) // End Ajax Request
});

function myFunction(_title, _comment, _numofstudent, _weekcount, _hourcount, _prerequisite) {

    $("#myLargeModalLabel").empty();
    $("#myLargeModalLabel").append('강좌 정보를 입력해주세요');
    $("#modal-content1").empty();

    var content = '<form>';
    content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">Text</label><div class="col-sm-12 col-md-10"><input class="form-control" type="Title" value="'+_title+'"></div></div>';
    content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">Text</label><div class="col-sm-12 col-md-10"><input class="form-control" type="Comment" placeholder="{{ $course->Comment }}"></div></div>';
    content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">Text</label><div class="col-sm-12 col-md-10"><input class="form-control" type="NumOfStudent" placeholder="{{ $course->NumOfStudent }}"></div></div>';
    content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">Text</label><div class="col-sm-12 col-md-10"><input class="form-control" type="Title" placeholder="{{ $course->Title }}"></div></div>';

    content += '<div class="form-group row"><label class="col-sm-12 col-md-2 col-form-label">Select</label><div class="col-sm-12 col-md-10"><select class="custom-select col-12"><option selected="">Choose...</option><option value="1">One</option><option value="2">Two</option><option value="3">Three</option></select></div></div>';
    content += '</form>';
    $("#modal-content1").append(content);
    $("#Large-modal").modal('show');
}

</script>