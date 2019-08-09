@extends('layouts.Master')
@section('javascript')
<script>
var count = 1;
var check = new Array();
$(document).ready( function () {
});
function checkField1() {     
    if(document.getElementById("field1_check").checked){
        count = 1;
    } else{
        if(count==1){
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field1은 존재 해야합니다</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field1_check").checked = true;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field2~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field1_check").checked = true;
        }
    }
}
function checkField2() {
    if(document.getElementById("field2_check").checked){
        if(count==1){
            document.getElementById("field2_name").disabled = false;
            count = 2;
        }else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field2_check").checked = false;   
        }
    } else{
        if(count==2){
            document.getElementById("field2_name").disabled = true;
            document.getElementById("field2_name").value = "";
            count=1;
        }else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field3~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field2_check").checked = true;
        }
    }
}
function checkField3(){
    if(document.getElementById("field3_check").checked){
        if(count==2){
            document.getElementById("field3_name").disabled = false;
            count = 3;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field3_check").checked = false;   
        }
    } else{
        if(count==3){
            document.getElementById("field3_name").disabled = true;
            document.getElementById("field3_name").value = "";
            count=2;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field4~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field3_check").checked = true;  
        }
    }
}
function checkField4(){
    if(document.getElementById("field4_check").checked){
        if(count==3){
            document.getElementById("field4_name").disabled = false;
            count = 4;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field4_check").checked = false;   
        }
    }else{
        if(count==4){
            document.getElementById("field4_name").disabled = true;
            document.getElementById("field4_name").value = "";
            count=3;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field5~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field4_check").checked = true;
        }
    }
}  
function checkField5() {
    if(document.getElementById("field5_check").checked){
        if(count==4){
            document.getElementById("field5_name").disabled = false;
            count = 5;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field5_check").checked = false;   
        }
    } else{
        if(count==5){
            document.getElementById("field5_name").disabled = true;
            document.getElementById("field5_name").value = "";
            count=4;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field6~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field5_check").checked = true;
        }
    }
} 
function checkField6(){
    if(document.getElementById("field6_check").checked){
        if(count==5){
            document.getElementById("field6_name").disabled = false;
            count = 6;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field6_check").checked = false;   
        }
    } else{
        if(count==6){
            document.getElementById("field6_name").disabled = true;
            document.getElementById("field6_name").value = "";
            count=5;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field7~Field8을 먼저 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field6_check").checked = true;
        }
    }
} 
function checkField7(){
    if(document.getElementById("field7_check").checked){
        if(count==6){
            document.getElementById("field7_name").disabled = false;
            count = 7;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field7_check").checked = false;   
        }
    } else{
        if(count==7){
            document.getElementById("field7_name").disabled = true;
            document.getElementById("field7_name").value = "";
            count=6;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field8을 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field7_check").checked = true;
        }
    }
}
function checkField8(){
    if(document.getElementById("field8_check").checked){
        if(count==7){
            document.getElementById("field8_name").disabled = false;
            count = 8;
        } else{
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 채워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field8_check").checked = false;   
        }
    } else{
        if(count==8) {
            document.getElementById("field8_name").disabled = true;
            document.getElementById("field8_name").value = "";
            count=7;
        } else {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>Field를 순서대로 지워주세요</p>');
            $("#alert-modal").modal('show');
            document.getElementById("field8_check").checked = true;
        }
    }
}
function ChannelSubmit() {
    var name = $("#channel-name").val();
    var field1 = $("#field1_name").val();
    var field2 = $("#field2_name").val();
    var field3 = $("#field3_name").val();
    var field4 = $("#field4_name").val();
    var field5 = $("#field5_name").val();
    var field6 = $("#field6_name").val();
    var field7 = $("#field7_name").val();
    var field8 = $("#field8_name").val();

    if(name == "") {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>채널 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field1=="" && document.getElementById("field1_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field1 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field2=="" && document.getElementById("field2_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field2 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field3=="" && document.getElementById("field3_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field3 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field4=="" && document.getElementById("field4_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field4 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field5=="" && document.getElementById("field5_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field5 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field6=="" && document.getElementById("field6_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field6 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field7=="" && document.getElementById("field7_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field7 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else if(field8=="" && document.getElementById("field8_check").checked) {
        $("#modal-content4").empty();
        $("#modal-content4").append('<p>Field8 이름을 적어주세요</p>');
        $("#alert-modal").modal('show');
    } else {
        $("#field_count").val(count);
        $("#DeviceForm").submit();
    }
    
}
</script>
@endsection
@section('page_title')
<h1>채널 생성</h1>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-9 blog-post-single">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pay Invoice</h3>
                        </div>
                        <hr>
                        <form action="/CreateDevice" method="post" novalidate="novalidate" id="DeviceForm">
                            @csrf
                            <input type="hidden" id="field_count" name="FieldCount" value="" />
                            <div class="form-group">
                                <label for="channel-name" class="control-label mb-1">채널 이름</label>
                                <input id="channel-name" name="ChannelName" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field1_name" class="control-label mb-1">Field1</label>&nbsp;
                                        <input type="checkbox" onclick="checkField1()" id="field1_check" checked>
                                        <input id="field1_name" name="Field1Name" type="text" class="form-control cc-exp" value="" placeholder="Field1 이름" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field2_name" class="control-label mb-1">Field2</label>&nbsp;
                                        <input type="checkbox" onclick="checkField2()" id="field2_check" />
                                        <input id="field2_name" name="Field2Name" type="text" class="form-control cc-exp" value="" placeholder="Field2 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field3_name" class="control-label mb-1">Field3</label>&nbsp;
                                        <input type="checkbox" onclick="checkField3()" id="field3_check" />
                                        <input id="field3_name" name="Field3Name" type="text" class="form-control cc-exp" value="" placeholder="Field3 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field4_name" class="control-label mb-1">Field4</label>&nbsp;
                                        <input type="checkbox" onclick="checkField4()" id="field4_check">
                                        <input id="field4_name" name="Field4Name" type="text" class="form-control cc-exp" value="" placeholder="Field4 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field5_name" class="control-label mb-1">Field5</label>&nbsp;
                                        <input type="checkbox" onclick="checkField5()" id="field5_check">
                                        <input id="field5_name" name="Field5Name" type="text" class="form-control cc-exp" value="" placeholder="Field5 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field6_name" class="control-label mb-1">Field6</label>&nbsp;
                                        <input type="checkbox" onclick="checkField6()" id="field6_check">
                                        <input id="field6_name" name="Field6Name" type="text" class="form-control cc-exp" value="" placeholder="Field6 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field7_name" class="control-label mb-1">Field7</label>&nbsp;
                                        <input type="checkbox" onclick="checkField7()" id="field7_check">
                                        <input id="field7_name" name="Field7Name" type="text" class="form-control cc-exp" value="" placeholder="Field7 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field8_name" class="control-label mb-1">Field8</label>&nbsp;
                                        <input type="checkbox" onclick="checkField8()" id="field8_check">
                                        <input id="field8_name" name="Field8Name" type="text" class="form-control cc-exp" value="" placeholder="Field8 이름" required disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div>
                            <button id="payment-button" onclick="ChannelSubmit()" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-save fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">생성</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-3 col-12 right-single">
            </div>
        </div><!-- end row -->
    </div>
</div>
@endsection