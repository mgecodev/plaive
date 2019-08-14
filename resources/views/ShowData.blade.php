@extends('layouts.Master')
@section('javascript')
<script>
var field_data = new Array();
var t_data = <?php echo $data; ?>;
var option = <?php echo $option;?>;
var channel = <?php echo $channel;?>;
var first_count = 0;
console.log(option);
console.log(t_data);
console.log(channel);

t_data.forEach(function(field_data){
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(t_data[first_count]);
        if(option[first_count]['field_valid']== "Y") {
            var temp_count = first_count+1;
            var graph_title = 'Field'+temp_count+'Name';
            if(option[first_count]['valid']=="N") {
                var chart_option = {
                    title: channel[graph_title]
                };
                var graph_div = 'graph'+temp_count;
                $('#'+graph_div).show();
                var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                chart.draw(data, chart_option);
            } else {
                var chart_option = {
                    interpolateNulls: true,
                    title: channel[graph_title],
                    hAxis: {title: option[first_count]['x_label']},
                    vAxis: {title: option[first_count]['y_label'],
                        viewWindow: {
                            max:option[first_count]['max'],
                            min:option[first_count]['min']
                        }
                    },
                    colors: [option[first_count]['graph_color']],
                    backgroundColor: option[first_count]['back_color']
                };
                var graph_div = 'graph'+temp_count;
                $('#'+graph_div).show();
                if(option[first_count]['line_type'] == "basicline") {
                    var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                    chart.draw(data, chart_option);
                } else if(option[first_count]['line_type'] == "smoothline") {
                    var chart_option = {
                        interpolateNulls: true,
                        title: channel[graph_title],
                        hAxis: {title: option[first_count]['x_label']},
                        vAxis: {title: option[first_count]['y_label'],
                            viewWindow: {
                                max:option[first_count]['max'],
                                min:option[first_count]['min']
                            }
                        },
                        curveType: 'function',
                        colors: [option[first_count]['graph_color']],
                        backgroundColor: option[first_count]['back_color']
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                    chart.draw(data, chart_option);
                } else if(option[first_count]['line_type'] == "arealine") {
                    var chart = new google.visualization.AreaChart(document.getElementById('linechart'+temp_count));
                    chart.draw(data, chart_option);
                } else if(option[first_count]['line_type'] == "column") {
                    var chart = new google.visualization.ColumnChart(document.getElementById('linechart'+temp_count));
                    chart.draw(data, chart_option);
                }
            }
            first_count++;
        } else {
            first_count++;
            var div_name = 'linechart'+first_count;
            var graph_div = 'graph'+first_count;
            $('#'+graph_div).show();
            $('#'+div_name).append('<center><h4>데이터가 존재 하지 않습니다.</center></h4>');
        }
    }
});

function openSetting(_number) {
    var c_id = channel['ChannelId'];
    var title = "Field"+_number+'&nbsp;&nbsp셋팅';
    $("#myLargeModalLabel").empty();
    $("#myLargeModalLabel").append(title);
    $("#modal-content1").empty();
    var content = '<form action="/SaveOption/'+c_id+'" method="post" novalidate="novalidate" id="OptionForm">';
    if(option[_number-1]['valid'] == "Y") {
        var o_id = option[_number-1]['Id'];
        var content = '<form action="/SaveOption/'+o_id+'" method="post" novalidate="novalidate" id="OptionForm">';
        content+='<input type="hidden" name="_method" value="PATCH">';
    } else {
        var content = '<form action="/SaveOption/'+c_id+'" method="post" novalidate="novalidate" id="OptionForm">';
    }
    content += '@csrf';
    content += '<input type="hidden" name="FieldNumber" value="'+_number+'">';
    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">그래프 유형</label>';
	content += '<div class="col-sm-12 col-md-10">';
    content += '<select class="custom-select col-12" id="graph_line" name="LineType">';
    if(option[_number-1]['line_type'] === undefined || option[_number-1]['line_type'] == null || option[_number-1]['line_type']=='basicline') {
	    content += '<option value="basicline" selected>Basic Line</option>';
    } else {
        content += '<option value="basicline">Basic Line</option>';
    }
    if(option[_number-1]['line_type']=='smoothline') {
	    content += '<option value="smoothline" selected>Smooth Line</option>';
    } else {
        content += '<option value="smoothline">Smooth Line</option>';
    }
    if(option[_number-1]['line_type']=='arealine') {
	    content += '<option value="arealine" selected>Area Line</option>';
    } else {
        content += '<option value="arealine">Area Line</option>';
    }
    if(option[_number-1]['line_type']=='column') {
	    content += '<option value="column" selected>Column</option>';
    } else {
        content += '<option value="column">Column</option>';
    }
    content += '</select>';
    content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">X축 이름</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['x_label'] === undefined || option[_number-1]['x_label'] == null) {
        content += '<input class="form-control" type="text" placeholder="X축 이름" name="Xlabel" value="">';
    } else {
        content += '<input class="form-control" type="text" placeholder="X축 이름" name="Xlabel" value="'+option[_number-1]['x_label']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">Y축 이름</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['y_label'] === undefined || option[_number-1]['y_label'] == null) {
        content += '<input class="form-control" type="text" placeholder="Y축 이름" name="Ylabel" value="">';
    } else {
        content += '<input class="form-control" type="text" placeholder="Y축 이름" name="Ylabel" value="'+option[_number-1]['y_label']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">그래프 색상</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['graph_color'] === undefined || option[_number-1]['graph_color'] == null) {
        content += '<input class="form-control" type="color" name="GraphColor" value="#0007e3">';
    } else {
        content += '<input class="form-control" type="color" name="GraphColor" value="'+option[_number-1]['graph_color']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">배경 색상</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['back_color'] === undefined || option[_number-1]['back_color'] == null) {
        content += '<input class="form-control" type="color" name="BackColor" value="#ffffff">';
    } else {
        content += '<input class="form-control" type="color" name="BackColor" value="'+option[_number-1]['back_color']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">기간</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['day'] === undefined || option[_number-1]['day'] == null) {
        content += '<input class="form-control" type="text" name="Day" placeholder="기간" value="">';
    } else {
        content += '<input class="form-control" type="text" name="Day" placeholder="기간" value="'+option[_number-1]['day']+'">';
    }
	content += '</div>';
	content += '</div>';
    
    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">결과 개수</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['result'] === undefined || option[_number-1]['result'] == null) {
        content += '<input class="form-control" type="text" name="Result" placeholder="결과 개수" value="">';
    } else {
        content += '<input class="form-control" type="text" name="Result" placeholder="가져올 결과 개수" value="'+option[_number-1]['result']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">최소값</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['min'] === undefined || option[_number-1]['min'] == null) {
        content += '<input class="form-control" type="text" name="Min" placeholder="최소값" value="">';
    } else {
        content += '<input class="form-control" type="text" name="Min" placeholder="최소값" value="'+option[_number-1]['min']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">최대값</label>';
	content += '<div class="col-sm-12 col-md-10">';
    if(option[_number-1]['max'] === undefined || option[_number-1]['max'] == null) {
        content += '<input class="form-control" type="text" name="Max" placeholder="최대값" value="">';
    } else {
        content += '<input class="form-control" type="text" name="Max" placeholder="최대값" value="'+option[_number-1]['max']+'">';
    }
	content += '</div>';
	content += '</div>';

    content += '<div class="form-group row">';
    content += '<label class="col-sm-12 col-md-2 col-form-label" style="color:black;">Dynamic 설정</label>';
	content += '<div class="col-sm-12 col-md-10">';
    content += '<select class="custom-select col-12" id="dynamic_setting" name="Dynamic">';
    if(option[_number-1]['dynamic'] == 'Y') {
	    content += '<option value="Y" selected>예</option>';
    } else {
        content += '<option value="Y">예</option>';
    }
    if(option[_number-1]['dynamic'] == 'N') {
	    content += '<option value="N" selected>아니오</option>';
    } else {
        content += '<option value="N">아니오</option>';
    }
    content += '</select>';
    content += '</div>';
	content += '</div>';

    content += '</form>';
    $("#modal-content1").append(content);
    $("#large-modal-button").empty();
    var button = '<button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>';
    button +='<button type="button" class="btn btn-primary" onclick="SaveOption()">저장</button>';
    $("#large-modal-button").append(button);
    $("#Large-modal").modal('show');
}
function SaveOption() {
    //console.log('save');
    $("#OptionForm").submit();
}

let dynamic = setInterval(function() {
    option.forEach(function(opt,index){
        if(opt['dynamic'] == 'Y' && opt['field_valid'] == 'Y') {
            DynamicDraw(index);
        }
    });
},60000);
function DynamicDraw(_index) {
    //console.log(_index);
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "DynamicData/"+channel['ChannelId']+"/"+_index,
        type: 'GET',
        data: {
            "_token": token,
            "option": option[_index],
        },
        async: false,
        success: function (data){
            //console.log(data);
            if(data.result == "Y"){
                option[_index]['last_field'] = data.last;
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart(data));
                function drawChart(_data) {
                    var data = google.visualization.arrayToDataTable(_data.data);
                    var temp_count = _index+1;
                    var graph_title = 'Field'+temp_count+'Name';
                    if(option[_index]['valid']=="N") {
                        var chart_option = {
                            title: channel[graph_title]
                        };
                        var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                        chart.draw(data, chart_option);
                    } else {
                        var chart_option = {
                            interpolateNulls: true,
                            title: channel[graph_title],
                            hAxis: {title: option[_index]['x_label']},
                            vAxis: {title: option[_index]['y_label'],
                                viewWindow: {
                                    max:option[_index]['max'],
                                    min:option[_index]['min']
                                }
                            },
                            colors: [option[_index]['graph_color']],
                            backgroundColor: option[_index]['back_color']
                        };
                        if(option[_index]['line_type'] == "basicline") {
                            var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                            chart.draw(data, chart_option);
                        } else if(option[_index]['line_type'] == "smoothline") {
                            var chart_option = {
                                interpolateNulls: true,
                                title: channel[graph_title],
                                hAxis: {title: option[_index]['x_label']},
                                vAxis: {title: option[_index]['y_label'],
                                    viewWindow: {
                                        max:option[_index]['max'],
                                        min:option[_index]['min']
                                    }
                                },
                                curveType: 'function',
                                colors: [option[_index]['graph_color']],
                                backgroundColor: option[_index]['back_color']
                            };
                            var chart = new google.visualization.LineChart(document.getElementById('linechart'+temp_count));
                            chart.draw(data, chart_option);
                        } else if(option[_index]['line_type'] == "arealine") {
                            var chart = new google.visualization.AreaChart(document.getElementById('linechart'+temp_count));
                            chart.draw(data, chart_option);
                        } else if(option[_index]['line_type'] == "column") {
                            var chart = new google.visualization.ColumnChart(document.getElementById('linechart'+temp_count));
                            chart.draw(data, chart_option);
                        }
                    }
                }   
            }
        },
        error: function() {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>데이터 fetch 실패</p>');
            $("#alert-modal").modal('show');
        }
    });
}
function DeleteConfirm(_index) {
    $("#confirmation-title").empty();
    $("#confirm-content1").empty();
    $("#confirm-content2").empty();
    $("#confirmation-title").append('Field'+_index + ' 의 데이터를 초기화 하시겠습니까?');
    var content1 = '<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>';
    content1 += '아니오';
    var content2 = '<button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" onclick="DeleteData('+_index+')"><i class="fa fa-check"></i></button>';
    content2 += '예';
    $("#confirm-content1").append(content1);
    $("#confirm-content2").append(content2);
    $("#confirmation-modal").modal('show');
}
function DeleteData(_index) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "DeleteData/"+channel['ChannelId']+'/'+_index,
        type: 'PATCH',
        data: {
            "_token": token,
        },
        success: function (data){
            console.log(data);
            if(data.result != 0) {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('초기화 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 초기화 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="location.reload();" data-dismiss="modal">확인</button>');
                $("#success-modal").modal('show');
            } else {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('초기화 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 초기화 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
                $("#success-modal").modal('show');
            }
        },
        error: function() {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>초기화 실패 하였습니다.</p>');
            $("#alert-modal").modal('show');
        }
    });
}
</script>
@endsection
@section('page_title')
<h1>데이터 보기</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph1" style="display: none">
                    <div class="image-blog">
                        <div id="linechart1" style="width:100%;min-height:200px;"></div>
					</div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field1</h2>
                    </div>
                    <div class="blog-button">
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(1);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(1);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph2" style="display: none">
                    <div class="image-blog">
                        <div id="linechart2" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field2</h2>
                    </div>
                    <div class="blog-button">
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(2);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(2);"><span>데이터 초기화<span></a>                        </center>
					</div>
                </div>
            </div>
        </div><!-- end row -->
        @if($channel->FieldCount>2)
            <hr>
        @endif
        <div class="row"> 
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph3" style="display: none">
                    <div class="image-blog">
                        <div id="linechart3" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field3</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(3);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(3);"><span>데이터 초기화<span></a>                        </center>
                        </center>
					</div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph4" style="display: none">
                    <div class="image-blog">
                        <div id="linechart4" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field4</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(4);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(4);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div>
        </div><!-- end row -->
        @if($channel->FieldCount>4)
            <hr>
        @endif
        <div class="row"> 
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph5" style="display: none">
                    <div class="image-blog">
                        <div id="linechart5" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field5</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(5);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(5);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph6" style="display: none">
                    <div class="image-blog">
                        <div id="linechart6" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field6</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(6);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(6);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div>
        </div><!-- end row -->
        @if($channel->FieldCount>6)
            <hr>
        @endif
        <div class="row"> 
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph7" style="display: none">
                    <div class="image-blog">
                        <div id="linechart7" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field7</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(7);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(7);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="blog-item" id="graph8" style="display: none">
                    <div class="image-blog">
                        <div id="linechart8" style="width:100%;min-height:200px;"></div>
                    </div>
                    <div class="blog-title" style="text-align: center;">
                        <h2>Field8</h2>
                    </div>
                    <div class="blog-button">						
                        <center>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="openSetting(8);"><span>설정<span></a>
                            <a class="hover-btn-new orange" href="javascript:void(0);" onclick="DeleteConfirm(8);"><span>데이터 초기화<span></a>
                        </center>
					</div>
                </div>
            </div>
        </div><!-- end row -->
    </div>
</div>
@endsection