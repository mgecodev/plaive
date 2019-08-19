@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    LoadPage();
});
function SaveBoard() {
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
<h1>새 소식 작성</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <form action="/CreateBoard/All" method="post" novalidate="novalidate" id="BoardForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label style="color:black;font-size:1rem;">새 소식 제목</label>
                <input class="form-control" name="BoardTitle" id="board_title" type="text" placeholder="새 소식 제목">
            </div>
            <label style="color:black;font-size:1rem;">새 소식 내용</label>
            <textarea name="board_editor" id="board_editor" class="ck-editor__editable_inline" style="width:100%;height:500px;"></textarea>
            <div style="height:10px;"></div>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">첨부 파일</label>
                <input type="file" class="form-control" id="multiFiles" name="files[]" multiple="multiple" />            
            </div>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">상단 고정 여부</label>
                <select class="form-control" name="TopFix">
                    <option value="N" selected>아니오</option>
                    <option value="Y">예</option>
                </select>
            </div>
        </form>
        <div style="height:30px;"></div>
        <div class="row">
            <div class="col-6">
                <button id="submit-button" onclick="SaveBoard()" class="btn btn-lg btn-info btn-block">
                    <i class="fa fa-save fa-lg"></i>&nbsp;
                    <span id="payment-button-amount">작성</span>
                </button>
            </div>
            <div class="col-6">
                <a href="{{ asset('/MainBoard') }}">
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