@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    LoadPage();
});
function DeleteFile(_id,_name) {
    $("#confirmation-title").empty();
    $("#confirm-content1").empty();
    $("#confirm-content2").empty();
    $("#confirmation-title").append(_name + ' 을 지우겠습니까?');
    var content1 = '<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>';
    content1 += '아니오';
    var content2 = '<button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" onclick="fileDelete('+_id+')"><i class="fa fa-check"></i></button>';
    content2 += '예';
    $("#confirm-content1").append(content1);
    $("#confirm-content2").append(content2);
    $("#confirmation-modal").modal('show');
}
function fileDelete(_id){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/DeleteBoardFile/"+_id,
        type: 'PATCH',
        data: {
            "_token": token,
        },
        success: function (data){
            console.log(data);
            if(data.result=="Success") {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('삭제 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 삭제 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>');
                $("#success-modal").modal('show');
                $("#file_list").empty();
                data.files.forEach(function(file){
                    var content = '<li>';
                    content += '<i class="fa fa-times" onclick="DeleteFile('+file.FileId+','+"'"+file.OriginalFilename+"'"+')"></i>&nbsp;&nbsp;';
                    content += '<span>'+file.OriginalFilename+'</span>';
                    content += '<li>';
                    $("#file_list").append(content);
                })
            }
        },
        error: function() {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>삭제 실패 하였습니다.</p>');
            $("#alert-modal").modal('show');
        }
    });
}
function UpdateBoard() {
    $("#submit-button").prop("disabled", true);
    var file_size = 0;
	var total_size = 0;
	var file_flag = 0;
	var max_filesize  = 100 * 1024 * 1024;
	var max_postsize  = 200 * 1024 * 1024;
    var ins = document.getElementById('multiFiles').files.length;

	for (var i = 0; i < ins; i++) {
		//data.append("files[]", document.getElementById('multiFiles').files[i]);
		var file = document.getElementById('multiFiles');
		// 브라우저 확인
		var agent = navigator.userAgent.toLowerCase();
		if((navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1)) {
			// 익스플로러일 경우
			var oas = new ActiveXObject("Scripting.FileSystemObject");
			file_size = oas.getFile( file.value ).size;
		} else {
			// 익스플로러가 아닐경우
			file_size = file.files[i].size;
		}
		if(file_size > max_filesize) {
			file_flag = 1;
			break;
		} else {
			total_size = total_size + file_size;
		}
	}
    if(file_flag == 0) {
		if(total_size <= max_postsize) {
			// Get form
			var form = $('#BoardForm')[0];
			// Create an FormData object
			var data = new FormData(form);

			var board_content = CKEDITOR.instances.board_editor.getData();
            var board_title = $('#board_title').val();

            if(board_title == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>제목을 입력하여 주세요.</p>');
                $("#alert-modal").modal('show');
                $("#submit-button").prop("disabled", false);
            } else if(board_content == "") {
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>내용을 입력하여 주세요.</p>');
                $("#alert-modal").modal('show');
                $("#submit-button").prop("disabled", false);
            } else {
                $("#BoardForm").submit();
            }
		} else {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>파일의 전체 첨부용량은 200M를 초과할 수 없습니다.</p>');
            $("#alert-modal").modal('show');
            $("#submit-button").prop("disabled", false);
		}
	} else {
		$("#modal-content4").empty();
        $("#modal-content4").append('<p>파일 하나의 첨부용량이 100M를 초과할 수 없습니다.</p>');
        $("#alert-modal").modal('show');
        $("#submit-button").prop("disabled", false);
	}
}
function LoadPage() { 
    CKEDITOR.replace('board_editor'); 
    CKEDITOR.config.height= 400;
}
</script>
@endsection
@section("page_title")
@if($board_type == 'All')
    <h1>소식 수정</h1>
@elseif($board_type == 'Class')
    <h1>게시물 수정</h1>
@endif
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
            @if($class==null)
                <form action="/UpdateBoard/All/{{ $board->BoardId}}" method="post" novalidate="novalidate" id="BoardForm" enctype="multipart/form-data">
            @else
                <form action="/UpdateBoard/Class/{{ $board->BoardId}}/{{ $class }}" method="post" novalidate="novalidate" id="BoardForm" enctype="multipart/form-data">
            @endif
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label style="color:black;font-size:1rem;">소식 제목</label>
                <input class="form-control" name="BoardTitle" id="board_title" type="text" value="{{ $board->BoardTitle }}">
            </div>
            <label style="color:black;font-size:1rem;">소식 내용</label>
            <textarea name="board_editor" id="board_editor" class="ck-editor__editable_inline" style="width:100%;height:500px;">{{ $board->BoardContent }}</textarea>
            <div style="height:10px;"></div>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">기존 파일</label>
                <ul id="file_list">
                @foreach($files as $file)
                    <li>
                        <i class="fa fa-times" onclick="DeleteFile('{{ $file->FileId }}','{{ $file->OriginalFilename }}')"></i>&nbsp;&nbsp; 
                        <span>{{ $file->OriginalFilename }}</span>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">파일 추가</label>
                <input type="file" class="form-control" id="multiFiles" name="files[]" multiple="multiple" />            
            </div>
            @if($type == "Teacher" || $type=="Admin")
            <div class="form-group">
                <label style="color:black;font-size:1rem;">상단 고정 여부</label>
                <select class="form-control" name="TopFix">
                    <option value="N" {{ $board->TopFix == 'N' ? 'selected' : '' }}>아니오</option>
                    <option value="Y" {{ $board->TopFix == 'Y' ? 'selected' : '' }}>예</option>
                </select>
            </div>
            @endif
        </form>
        <div style="height:30px;"></div>
        <div class="row">
            <div class="col-md-6">
                <button id="submit-button" onclick="UpdateBoard()" class="btn btn-lg btn-info btn-block">
                    <i class="fa fa-save fa-lg"></i>&nbsp;
                    <span id="payment-button-amount">저장</span>
                </button>
            </div>
            <?php
                if($board_type == "Class") {
                    $url="ShowBoard/".$board_type."/".$board->BoardId."/".$class;
                } else if($board_type == "All") {
                    $url="ShowBoard/".$board_type."/".$board->BoardId;
                }
            ?>
            <div class="col-md-6">
                <a href="{{ asset($url) }}">
                    <button id="payment-button" class="btn btn-lg btn-danger btn-block">
                        <i class="fa fa-times fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">취소</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection