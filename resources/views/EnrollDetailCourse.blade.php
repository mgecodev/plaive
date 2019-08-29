@extends('layouts.Master')
@section('javascript')
<script>
    var sub_click = new Array();
    var courseworks = new Array();
    var subcourseworks = new Array();
    var week = <?php echo $course->WeekCount;?>;

    $(document).ready(function(){
        console.log(week);
        for(var i=1;i<=week;i++) {
            sub_click[i] = 1;
            subcourseworks[i] = new Array();
        }
        console.log(sub_click);
    });
    function appendSub(_week) {
        console.log(_week);
        var week_input = "week_input"+_week;
        var week_sub_total_div = "week_sub_total_div"+_week;

        if($("#"+week_input).val() == "" ){
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>주차 내용을 먼저 입력하여주세요</p>');
            $("#alert-modal").modal('show');
        } else {
            var content = '<div class="form-group row" id="week_sub_div'+sub_click[_week]+'_'+_week+'">';
            content += '<label class="col-sm-12 col-md-2 col-form-label">STEP'+sub_click[_week]+'</label>';
            content += '<div class="col-sm-12 col-md-8">';
            content += '<input class="form-control" value="" type="search" id="week_sub_input'+sub_click[_week]+'_'+_week+'">';
            content += '</div>';
            content += '<a href="javascript:void(0);" onclick="MinusSub('+sub_click[_week]+','+_week+')"><i class="icon-copy ion-minus-circled"></i></a>';
            content += '</div>';
            $("#"+week_sub_total_div).css('display','');
            $("#"+week_sub_total_div).append(content);
            sub_click[_week]++;
        }
    }
    function MinusSub(_subid,_week) {
        var sub_div = "week_sub_div"+_subid+"_"+_week;
        if(_subid == sub_click[_week]-1) {
            $("#"+sub_div).remove();
            sub_click[_week]--;
        } else {
            var total_sub_div = "week_sub_total_div"+_week;
            var pre_input_val = new Array();
            for(var k=1;k<sub_click[_week];k++) {
                if(k != _subid) {
                    var pre_input_div = "week_sub_input" + k +"_"+_week;
                    pre_input_val[k] = $("#"+pre_input_div).val();
                }
            }
            $("#"+total_sub_div).empty();
            var h = 1;
            for(var k=1;k<sub_click[_week];k++) {
                if(k != _subid) {
                    var content = '<div class="form-group row" id="week_sub_div'+h+'_'+_week+'">';
                    content += '<label class="col-sm-12 col-md-2 col-form-label">STEP'+h+'</label>';
                    content += '<div class="col-sm-12 col-md-8">';
                    content += '<input class="form-control" value="'+pre_input_val[k]+'" type="search" id="week_sub_input'+h+'_'+_week+'">';
                    content += '</div>';
                    content += '<a href="javascript:void(0);" onclick="MinusSub('+h+','+_week+')"><i class="icon-copy ion-minus-circled"></i></a>';
                    content += '</div>';
                    h++;
                    $("#"+total_sub_div).append(content);
                }
            }
            sub_click[_week]--;
        }
    }
    function SaveCurriculum(_courseid) {
        var error_flag = 0;
        for(var i=1;i<=week;i++){
            var course_input = "week_input"+i;
            var course_input_value = $("#"+course_input).val();
            
            courseworks[i] = course_input_value;
            if(sub_click[i] != 1){
                if(course_input_value == "") {
                    $("#modal-content4").empty();
                    $("#modal-content4").append('<p>주차 내용을 먼저 입력하여주세요</p>');
                    $("#alert-modal").modal('show');
                    error_flag = 1;
                } else {
                    for(j=1;j<sub_click[i];j++){
                        var sub_course_input = "week_sub_input"+j+"_"+i;
                        var sub_course_input_value = $("#"+sub_course_input).val();
                        if(sub_course_input_value == "") {
                            $("#modal-content4").empty();
                            $("#modal-content4").append('<p>소주제 내용을 먼저 입력하여주세요</p>');
                            $("#alert-modal").modal('show');
                            error_flag = 1;
                        } else {
                            subcourseworks[i][j] = sub_course_input_value
                        }
                    }
                }
            }
        }
        if(error_flag == 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/ManageCourse/SaveCurriculum',
                data: {
                    "_courseid": _courseid,
                    "_courseworks": courseworks,
                    "_subcourseworks": subcourseworks,
                    "_week": week
                },
                success: function (data) {
                    location.href = "/ManageCourse";
                },
                error: function (request, status, error) {
                    // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                    alert('fail');
                    //console.log(request + "/" + status + "/" + error);
                }
            })
        }
    }
</script>
@endsection
@section("page_title")
<h1>{{ $course->Title.' 강좌' }}</h1>
@endsection
@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            @for($i=1;$i<=$course->WeekCount;$i++)
            <div id="total_week_div{{ $i }}">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">{{ $i. ' 주차' }}</label>
                    <div class="col-sm-12 col-md-8">
                        <input class="form-control" value="" type="search" id="week_input{{ $i }}">
                    </div>
                    <a href="javascript:void(0);" onclick="appendSub({{ $i }})"><i class="icon-copy ion-plus-circled"></i></a>
                </div>
                <div id="week_sub_total_div{{ $i }}" style="display:none;"></div>
            </div>
            @endfor
            <div style="height:20px;"></div>
            <div>
                <div class="row">
                    <div class="col-6">
                        <button id="payment-button" class="btn btn-lg btn-info btn-block" onclick="SaveCurriculum({{ $course->CourseId }})">
                            <i class="fa fa-save fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">저장</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <a href="{{ asset('/ManageCourse') }}">
                            <button id="payment-button" class="btn btn-lg btn-danger btn-block">
                                <i class="fa fa-times fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">취소</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
