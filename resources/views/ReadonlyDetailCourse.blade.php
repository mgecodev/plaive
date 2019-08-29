@extends('layouts.Master')
@section('javascript')
<script>
    var sub_click = new Array();
    var courseworks = new Array();
    var subcourseworks = new Array();
    var week = <?php echo $course->WeekCount;?>;
    var presubworks = <?php echo $subcourseworks;?>;
    var precourseworks = <?php echo $courseworks;?>;
    $(document).ready(function(){
        console.log(week);
        console.log(presubworks);
        console.log(precourseworks);

        for(var i=1;i<=week;i++) {
            sub_click[i] = 1;
            subcourseworks[i] = new Array();
        }

        for(var k=0;k<precourseworks.length;k++){
            for(var j=0;j<presubworks.length;j++){
                if(presubworks[j]['CourseworkId'] == precourseworks[k]['CourseworkId']) {
                    var index = precourseworks[k]['WeekNumber'];
                    var week_sub_total_div = "week_sub_total_div"+index;
                    var content = '<div class="form-group row" id="week_sub_div'+sub_click[index]+'_'+index+'">';
                    content += '<label class="col-sm-12 col-md-2 col-form-label">STEP'+sub_click[index]+'</label>';
                    content += '<div class="col-sm-12 col-md-8">';
                    content += '<input class="form-control" value="'+presubworks[j]['Content']+'" type="search" id="week_sub_input'+sub_click[index]+'_'+index+'" readonly>';
                    content += '</div>';
                    content += '</div>';
                    $("#"+week_sub_total_div).css('display','');
                    $("#"+week_sub_total_div).append(content);
                    sub_click[index]++;
                }
            }
        }
        console.log(sub_click);
    });
</script>
@endsection
@section("page_title")
<h1>{{ $course->Title.' 강좌' }}</h1>
@endsection
@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            @for($i=1;$i<=$course->WeekCount;$i++)
                <?php
                $update_flag = 0;
                ?>
                @foreach($courseworks as $coursework)
                <?php
                    if($i == $coursework->WeekNumber) {
                        $update_flag = 1;
                        $name = $coursework->Content;
                        break;
                    } 
                ?>
                @endforeach
                <div id="total_week_div{{ $i }}">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ $i. ' 주차' }}</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" value="{{ $update_flag == 1 ? $name : '' }}" type="search" id="week_input{{ $i }}" readonly>
                        </div>
                    </div>
                    <div id="week_sub_total_div{{ $i }}" style="display:none;"></div>
                </div>
            @endfor
        </div>
    </div>
@endsection
