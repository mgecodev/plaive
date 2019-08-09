@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    var lang_kor = {
        "decimal" : "",
        "emptyTable" : "데이터가 없습니다.",
        "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
        "infoEmpty" : "0명",
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
</script>
@endsection
@section("page_title")
<h1>채널 리스트<span class="m_1">Lorem Ipsum dolroin gravida nibh vel velit.</span></h1>
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
                            <td style="vertical-align: middle;">{{str_limit($channel->ChannelName,14)}}</td>
                            <td style="vertical-align: middle;"> 
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;ApiKey</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-download"></i>&nbsp;&nbsp;다운로드</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-edit"></i>&nbsp;&nbsp;수정</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;삭제</a>
                                    </div>
                                </div>
                            </td>
                            @else
                            <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td style="vertical-align: middle;">{{ str_limit($channel->ChannelName,30) }}</td>
                            <td style="vertical-align: middle;">{{ $channel->created_at }}</td>
                            <td style="vertical-align: middle;"> 
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&nbsp;&nbsp;ApiKey</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-download"></i>&nbsp;&nbsp;다운로드</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-edit"></i>&nbsp;&nbsp;수정</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash"></i>&nbsp;&nbsp;삭제</a>
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