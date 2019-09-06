<style>
    .btn-custom {
        font-family: 'KoPub Dotum' !important;
        color: #fff;
        background-color: #f56767 !important;
        border-color: #f56767;
        /*padding: 0px 0px !important;*/
        margin-top: 0px !important;
    }

    .badge-custom {
        font-size:16px;
        /*top:50%;*/

        font-family: 'KoPub Dotum' !important;
        color: #fff;
        padding: 12px 12px !important;
        background-color: #41ccba;
    }

</style>

<div class="row clearfix progress-box">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-blue text-white">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
                <div class="project-info-right">
                <span
                    class="no text-blue weight-500 font-24">{{ count($tot_invited_students) }}</span>
                    <p class="weight-400 font-18">총 초대한 학생 수</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-light-green text-white">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                </div>
                <div class="project-info-right">
                <span
                    class="no text-light-green weight-500 font-24">{{ count($tot_accepted_students) }}</span>
                    <p class="weight-400 font-18">초대 수락 학생 수</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
            <div class="project-info clearfix">
                <div class="project-info-left">
                    <div class="icon box-shadow bg-light-orange text-white">
                        <i class="fa fa-list-alt"></i>
                    </div>
                </div>
                <div class="project-info-right">
                <span
                    class="no text-light-orange weight-500 font-24">{{ count($tot_invited_students) - count($tot_accepted_students) }}</span>
                    <p class="weight-400 font-18">남은 학생</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="pd-20">
        <div class="table-responsive text-center">
            <table class="table table-bordered stripe hover nowrap" id="first_table"
                   style="width:100%;">
                <thead>
                <tr>
                    <th>이름</th>
                    <th>메일</th>
                    <th class="datatable-nosort datatable-nosearch">상태</th>
                    <th class="datatable-nosort datatable-nosearch">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tot_invited_students as $tot_invited_student)
                    <tr>
                        <td>{{ $tot_invited_student->name }}</td>
                        <td>{{ $tot_invited_student->email }}</td>
                        <td>
                            @if ($tot_invited_student->Accepted == 1)
                                <span class="badge badge-custom">승인</span>
                            @elseif ($tot_invited_student->Accepted == 0)
                                <span class="badge badge-primary">대기</span>
                            @elseif ($tot_invited_student->Accepted == 2)
                                <span class="badge badge-danger">거절</span>
                            @endif
                        </td>
                        <td>
                            @if ($tot_invited_student->Accepted == 0)
                            <button class="btn btn-custom" onclick="CancelInvite({{ $tot_invited_student->InvitationId }},{{ $class_id }})">취소</button>
                            @elseif ($tot_invited_student->Accepted == 1)
                            <button class="btn btn-custom" onclick="CancelClass({{ $tot_invited_student->id}} , {{ $class_id }}, {{ $tot_invited_student->InvitationId }})">방출</button>
                            @elseif ($tot_invited_student->Accepted == 2)
                            <button class="btn btn-info" onclick="ReInvite({{ $tot_invited_student->InvitationId }}, {{ $class_id }})">재초대</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script>
var accept_count = <?php echo count($tot_accepted_students);?>;
var deny_count = <?php echo count($tot_denied_students);?>;
var class_id = "<?php echo $class_id;?>";
var user_type = "<?php echo $type;?>";
$(document).ready( function () {
    if(user_type == "Teacher") {
        setInterval(function() {
            var change = 0;
            console.log(accept_count);
            console.log(deny_count);
            $.ajax({
                type : "GET",
                url : "/CheckInvitation/teacher/realtime",
                data: {
                    "accept_count" : accept_count,
                    "deny_count" : deny_count,
                    "class_id" : class_id
                },
                success:function(data) {
                    if(data.result == 'Fail') {
                        change = 1;
                    }
                    if(change == 0) {
                        $('#home4').html(data);
                    }
                }
            });
        },3000);
    }
});
</script>
