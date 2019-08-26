@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    var lang_kor = {
        "decimal" : "",
        "emptyTable" : "데이터가 없습니다.",
        "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
        "infoEmpty" : "0개",
        "infoFiltered" : "(전체 _MAX_ 개 중 검색결과)",
        "infoPostFix" : "",
        "thousands" : ",",
        "lengthMenu" : "_MENU_ 개씩 보기",
        "loadingRecords" : "로딩중...",
        "processing" : "처리중...",
        "search" : "검색 : ",
        "zeroRecords" : "검색된 데이터가 없습니다.",
        "paginate" : {
            "first" : "첫 페이지",
            "last" : "마지막 페이지",
            "next" : "다음",
            "previous" : "이전"
        },
        "searchPlaceholder": "검색어",
        "aria" : {
            "sortAscending" : " :  오름차순 정렬",
            "sortDescending" : " :  내림차순 정렬"
        }
    };
    $('#table').DataTable({
        columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
        },{
            targets: "datatable-nosearch",
			searchable: false,
        }],
        language: lang_kor
    });
});
function DeleteChannel(_id,_name) {
    $("#confirmation-title").empty();
    $("#confirm-content1").empty();
    $("#confirm-content2").empty();
    $("#confirmation-title").append(_name + ' 을 지우겠습니까?');
    var content1 = '<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>';
    content1 += '아니오';
    var content2 = '<button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" onclick="doDelete('+_id+')"><i class="fa fa-check"></i></button>';
    content2 += '예';
    $("#confirm-content1").append(content1);
    $("#confirm-content2").append(content2);
    $("#confirmation-modal").modal('show');
}
function doDelete(_id) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "DeleteDevice/"+_id,
        type: 'PATCH',
        data: {
            "_token": token,
        },
        success: function (data){
            if(data.result=="Success") {
                //location.reload();
                $("#modal-success-title").empty();
                $("#modal-success-title").append('삭제 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 삭제 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="location.reload();" data-dismiss="modal">확인</button>');
                $("#success-modal").modal('show');
            }
        },
        error: function() {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>삭제 실패 하였습니다.</p>');
            $("#alert-modal").modal('show');
        }
    });
}
function ShowApi(_api) {
    $("#myLargeModalLabel").empty();
    $("#myLargeModalLabel").append('ApiKey 및 이용안내');
    $("#modal-content1").empty();
    var field1 = 'POST http://data.plaive.10make.com/insert.php?api_key='+_api+'&field1={value1}';
    var field2 = 'POST http://data.plaive.10make.com/insert.php?api_key='+_api+'&field1={value1}&field2={value2}';
    var content = '<form>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">ApiKey</label>';
	content += '<div class="input-group mb-3">';
    content += '<input type="text" id="api_key" class="form-control" value="'+_api+'" readonly>';
    content += '<div class="input-group-append">';
    content += '<button class="btn btn-secondary" type="button" onclick="ApiCopy()">복사</button>';
    content += '</div>';
    content += '</div>';
	content += '</div>'; 
    content += '<div class="form-group">';
    content += '<label style="color:black;">field 하나 사용</label>';
    content += '<input class="form-control" type="text" value="'+field1+'" readonly>';
	content += '</div>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">field 두개 사용</label>';
    content += '<input class="form-control" type="text" value="'+field2+'" readonly>';
	content += '</div>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">ErrorCode 0000</label>';
    content += '<input class="form-control" type="text" value="데이터가 정상적으로 삽입되었습니다" readonly>';
	content += '</div>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">ErrorCode 1000</label>';
    content += '<input class="form-control" type="text" value="데이터 삽입 에러. 데이터 필드를 다시 한번 확인해 주세요" readonly>';
	content += '</div>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">ErrorCode 2000</label>';
    content += '<input class="form-control" type="text" value="Apikey 입력 에러. ApiKey 입력 확인" readonly>';
	content += '</div>';
    content += '<div class="form-group">';
    content += '<label style="color:black;">ErrorCode 3000</label>';
    content += '<input class="form-control" type="text" value="Apikey 인증 에러. Apikey를 확인해 주세요" readonly>';
	content += '</div>';
    content += '</form>';
    $("#modal-content1").append(content);
    $("#large-modal-button").empty();
    $("#large-modal-button").append('<button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
    $("#Large-modal").modal('show');
}
function ApiCopy() {
    var copyText = document.getElementById("api_key");
    copyText.select();
    document.execCommand("copy");
}
</script>
@endsection
@section("page_title")
<h1>채널 리스트</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-9 blog-post-single">
                <div style="height:10px;"></div>
                <div class="table-responsive text-center">
                <table class="table table-bordered stripe hover nowrap" id="table" style="width:100%;">
                        <thead>
                            <tr>
                                @if((new \Jenssegers\Agent\Agent())->isPhone())
                                <th class="text-center">이름</th>
                                <th class="text-center datatable-nosort datatable-nosearch" style="white-space:nowrap;">Action</th>
                                @else
                                <th class="text-center" >#</th>
                                <th class="text-center">이름</th>
                                <th class="text-center datatable-nosearch" style="white-space:nowrap;">생성일</th>
                                <th class="text-center datatable-nosort datatable-nosearch" style="white-space:nowrap;">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach($channels as $channel)
                        <tr class="item{{$channel->ChannelId}}">
                            @if((new \Jenssegers\Agent\Agent())->isPhone())
                            <?php
                                $url = 'ShowData/'.$channel->ChannelId;
                            ?>
                            <td style="vertical-align: middle;" onclick="location.href='{{ asset($url) }}'">{{str_limit($channel->ChannelName,14)}}</td>
                            <td style="vertical-align: middle;"> 
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;ApiKey</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-download"></i>&nbsp;&nbsp;다운로드</a>
                                        <?php
                                            $url = 'EditDevice/'.$channel->ChannelId.'/edit';
                                        ?>
                                        <a class="dropdown-item" href="{{ asset($url) }}"><i class="fa fa-edit"></i>&nbsp;&nbsp;수정</a>
                                        <a class="dropdown-item delete_button" href="javascript:void(0);" onclick="DeleteChannel({{ $channel->ChannelId }},'{{ str_limit($channel->ChannelName,14) }}')"><i class="fa fa-trash"></i>&nbsp;&nbsp;삭제</a>
                                    </div>
                                </div>
                            </td>
                            @else
                            <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <?php
                                $url = 'ShowData/'.$channel->ChannelId;
                            ?>
                            <td style="vertical-align: middle;" onclick="location.href='{{ asset($url) }}'">{{ str_limit($channel->ChannelName,24) }}</td>
                            <td style="vertical-align: middle;">{{ $channel->created_at }}</td>
                            <td style="vertical-align: middle;"> 
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="ShowApi('{{ $channel->ApiKey }}');"><i class="fa fa-eye"></i>&nbsp;&nbsp;ApiKey</a>
                                        <?php
                                            $url = 'DownloadData/'.$channel->ChannelId;
                                        ?>
                                        <a class="dropdown-item" href="{{ asset($url) }}"><i class="fa fa-download"></i>&nbsp;&nbsp;다운로드</a>
                                        <?php
                                            $url = 'EditDevice/'.$channel->ChannelId.'/edit';
                                        ?>
                                        <a class="dropdown-item" href="{{ asset($url) }}"><i class="fa fa-edit"></i>&nbsp;&nbsp;수정</a>
                                        <a class="dropdown-item delete_button" href="javascript:void(0);" onclick="DeleteChannel({{ $channel->ChannelId }},'{{ str_limit($channel->ChannelName,24) }}')"><i class="fa fa-trash"></i>&nbsp;&nbsp;삭제</a>
                                    </div>
                                </div>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-12 right-single">
                <h1>도움말</h1>
                <ul>
                    <li style="font-size:25px;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </li>
                    채널 ApiKey와 대략적인 데이터 넣는 법을 알려주는 아이콘
                    <li style="font-size:25px;">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </li>
                    채널에 대한 데이터를 다운 받는 아이콘
                    <li style="font-size:25px;">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </li>
                    등록한 채널에 대해 정보를 수정하는 아이콘
                    <li style="font-size:25px;">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </li>
                    채널을 삭제 하는 아이콘
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection