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
    console.log(_number);
    var title = "Field"+_number+'&nbsp;&nbsp셋팅';
    $("#myLargeModalLabel").empty();
    $("#myLargeModalLabel").append(title);
    $("#modal-content1").empty();
    var content = 
    $("#bd-example-modal-lg").modal('show');
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
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
                        <a class="hover-btn-new orange" href="#"><span>설정<span></a>
					</div>
                </div>
            </div>
        </div><!-- end row -->
    </div>
</div>
@endsection