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
    $('#board_table').DataTable({
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
<h1>소식 리스트</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="table-responsive text-center">
            <table class="table table-bordered stripe hover nowrap" id="board_table" style="width:100%;">
                <thead>
                    <tr>
                        @if((new \Jenssegers\Agent\Agent())->isPhone())
                        <th class="text-center">작성자</th>
                        <th class="text-center">제목</th>
                        @else
                        <th class="text-center datatable-nosearch" >#</th>
                        <th class="text-center">작성자</th>
                        <th class="text-center">제목</th>
                        <th class="text-center datatable-nosearch" style="white-space:nowrap;">생성일</th>
                        @endif
                    </tr>
                </thead>
                @foreach($boards as $board)
                <?php
                    $url = 'ShowBoard/All/'.$board->BoardId;
                ?>
                <tr class="item{{$board->BoardId}}" onclick="location.href='{{ asset($url) }}'">
                    @if((new \Jenssegers\Agent\Agent())->isPhone())
                    <td style="vertical-align: middle;">{{ $board->WriterName }}</td>
                    <td style="vertical-align: middle;">{{ str_limit($board->BoardTitle,24) }}</td>
                    @else
                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                    <td style="vertical-align: middle;">{{ $board->WriterName }}</td>
                    <td style="vertical-align: middle;">{{ str_limit($board->BoardTitle,50) }}</td>
                    <td style="vertical-align: middle;">{{ $board->created_at }}</td>
                    @endif
    
                </tr>
                @endforeach
            </table>
            <center>
                @if ($type == 'Admin')
                <a href="{{ asset('/CreateBoard/All') }}"><button class="btn btn-secondary">새 게시물</button></a>
                @endif
            </center>
        </div>
    </div>
</div>
@endsection