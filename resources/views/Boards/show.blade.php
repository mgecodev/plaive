@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    LoadPage();
});
function LoadPage() { 
    CKEDITOR.replace('board_editor'); 
    CKEDITOR.config.height= 400;
}
function DeleteBoard(_id){
    $("#confirmation-title").empty();
    $("#confirm-content1").empty();
    $("#confirm-content2").empty();
    $("#confirmation-title").append('게시물을 지우겠습니까?');
    var content1 = '<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>';
    content1 += '아니오';
    var content2 = '<button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" data-dismiss="modal" onclick="boardDelete('+_id+')"><i class="fa fa-check"></i></button>';
    content2 += '예';
    $("#confirm-content1").append(content1);
    $("#confirm-content2").append(content2);
    $("#confirmation-modal").modal('show');
}
function boardDelete(_id){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/DeleteBoard/All/"+_id,
        type: 'PATCH',
        data: {
            "_token": token,
        },
        success: function (data){
            if(data.result=="Success") {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('삭제 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 삭제 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append('<button type="button" class="btn btn-primary" onclick="SuccessDelete();" data-dismiss="modal">확인</button>');
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
function SuccessDelete(){
    location.href= "{{ asset('/MainBoard') }}";
}
</script>
@endsection
@section("page_title")
<h1>소식</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <form>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">제목</label>
                <input class="form-control" name="BoardTitle" id="board_title" type="text" value="{{ $board->BoardTitle }}" readonly>
            </div>
            <label style="color:black;font-size:1rem;">내용</label>
            <textarea name="board_editor" id="board_editor" class="ck-editor__editable_inline" style="width:100%;height:500px;" readonly="readonly" disabled>{{ $board->BoardContent }}</textarea>
            <div style="height:15px;"></div>
            <div class="form-group">
                <label style="color:black;font-size:1rem;">첨부 파일</label>
                <ul>
            @foreach($files as $file)
            <?php
                $url = 'DownloadFile/'.$file->FileId;
            ?>
                <li>     
                <a href="{{ asset($url) }}">{{ $file->OriginalFilename }}</a>
                </li>
            @endforeach
                </ul>
            </div>
        </form>
        @if($id == $board->WriterNo && $type == $board->WriterType && $name == $board->WriterName)
        <div style="height:30px;"></div>
        <div class="row">
            <div class="col-md-4">
                <?php
                    $url = 'EditBoard/All/'.$board->BoardId.'/edit';
                ?>
                <a href="{{ asset($url) }}">
                    <button id="submit-button" onclick="locat()" class="btn btn-lg btn-info btn-block">
                        <i class="fa fa-edit fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">수정하기</span>
                    </button>
                </a>
            </div>
            <div class="col-md-4">
                <a href="javascript:void(0);" onclick="DeleteBoard({{ $board->BoardId }})">
                    <button id="payment-button" class="btn btn-lg btn-danger btn-block">
                        <i class="fa fa-trash fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">삭제</span>
                    </button>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ asset('/MainBoard') }}">
                    <button id="payment-button" class="btn btn-lg btn-secondary btn-block">
                        <i class="fa fa-arrow-left fa-lg"></i>&nbsp;
                        <span id="payment-button-amount">목록으로</span>
                    </button>
                </a>
            </div>
        </div>
        @else
        <div style="height:20px;"></div>
        <a href="{{ asset('/MainBoard') }}">
            <button id="payment-button" class="btn btn-lg btn-secondary btn-block">
                <i class="fa fa-arrow-left fa-lg"></i>&nbsp;
                <span id="payment-button-amount">목록으로</span>
            </button>
        </a>
        @endif
    </div>
</div>
@endsection