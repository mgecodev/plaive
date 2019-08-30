<div class="pd-20 bg-white border-radius-4 box-shadow">
    <h5 class="weight-500 mb-20">{{ $class->ClassName }} 클래스입니다</h5>
    <div class="tab">
        <div class="row clearfix">
            <div class="col-md-3 col-sm-12">
                <ul class="nav flex-column vtabs nav-tabs customtab" role="tablist">
                    @if($type == 'Teacher')
                        <li class="nav-item">
                            <a class="nav-link {{ $board_flag == null ? 'active show' : '' }}" data-toggle="tab"
                               href="#home4" role="tab" aria-selected="true">학생
                                현황</a>
                            <a class="nav-link {{ $board_flag == 'invite' ? 'active show' : '' }}" data-toggle="tab" href="#invite4" role="tab" aria-selected="false">학생
                                초대하기</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"
                               href="#take-class" role="tab" aria-selected="false">수업 현황</a>
                        </li>
                    @elseif ($type == 'Student')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"
                               href="#take-class" role="tab" aria-selected="false">수업 듣기</a>
                        </li>

                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $board_flag == 'board' ? 'active show' : '' }}" data-toggle="tab"
                           href="#profile4" role="tab" aria-selected="false">게시물</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="tab-content">
                    @if ($type == 'Teacher')
                        <div class="tab-pane fade {{ $board_flag == null ? 'active show' : '' }}" id="home4"
                             role="tabpanel">
                            @include('TeacherRealTime')
                        </div>
                    @endif
                    <div class="tab-pane fade {{ $board_flag == 'board' ? 'active show' : '' }}" id="profile4"
                         role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered stripe hover nowrap" id="table"
                                           style="width:100%;">
                                        <thead>
                                        <tr>
                                            @if((new \Jenssegers\Agent\Agent())->isPhone())
                                            <th class="text-center">작성자</th>
                                            <th class="text-center">제목</th>
                                            @else
                                            <th class="text-center datatable-nosearch">#</th>
                                            <th class="text-center">작성자</th>
                                            <th class="text-center">제목</th>
                                            <th class="text-center datatable-nosearch" style="white-space:nowrap;">생성일
                                            </th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($boards as $board)
                                            <?php
                                            $url = 'ShowBoard/Class/' . $board->BoardId . '/' . $class_id;
                                            ?>
                                            <tr class="item{{$board->BoardId}}"
                                                onclick="location.href='{{ asset($url) }}'">
                                                @if((new \Jenssegers\Agent\Agent())->isPhone())
                                                <td style="vertical-align: middle;">{{ $board->WriterName }}</td>
                                                <td style="vertical-align: middle;">{{ str_limit($board->BoardTitle,24) }}</td>
                                                @else
                                                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                                <td style="vertical-align: middle;">{{ $board->WriterName }}</td>
                                                <td style="vertical-align: middle;">{{ str_limit($board->BoardTitle,40) }}</td>
                                                <td style="vertical-align: middle;">{{ $board->created_at }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <center>
                                        <?php
                                        $url = '/CreateBoard/Class/' . $class_id;
                                        ?>
                                        <a href="{{ asset($url) }}">
                                            <button class="btn btn-secondary">새 게시물</button>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($type == 'Teacher')
                    <div class="tab-pane fade {{ $board_flag == 'invite' ? 'active show' : '' }}" id="invite4" role="tabpanel">
                        <div class="pd-20">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered stripe hover nowrap" id="second_table"
                                       style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>이름</th>
                                        <th>메일</th>
                                        <th class="text-center datatable-nosearch datatable-nosort">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tot_viable_students as $tot_viable_student)
                                        <tr>
                                            <td>{{ $tot_viable_student->name }}</td>
                                            <td>{{ $tot_viable_student->email }}</td>
                                            <td>
                                                <button class="btn btn-primary" onclick="InviteAddition({{ $tot_viable_student->id }}, {{ $id }}, {{ $class_id }})">초대</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="take-class" role="tabpanel">
                            <div class="pd-20">
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered stripe hover nowrap" id="fourth_table"
                                           style="width:100%;">
                                        <thead>
                                        <tr>
                                            @if((new \Jenssegers\Agent\Agent())->isPhone())
                                            <th class="text-center">내용</th>
                                            @else
                                            <th class="text-center">주차</th>
                                            <th class="text-center">내용</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courseworks as $coursework)
                                            <tr onclick="goCourseStatus({{ $class_id }},{{ $coursework->CourseworkId }})">
                                                @if((new \Jenssegers\Agent\Agent())->isPhone())
                                                <th class="text-center">내용</th>
                                                @else
                                                <td>{{ $coursework->WeekNumber }}</td>
                                                <td>{{ $coursework->Content }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($type == 'Student')
                        <div class="tab-pane fade" id="take-class"
                             role="tabpanel">
                            <div class="pd-20">
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered stripe hover nowrap" id="third_table"
                                           style="width:100%;">
                                        <thead>
                                        <tr>
                                            <th class="text-center">주차</th>
                                            <th class="text-center">순서</th>
                                            <th class="text-center datatable-nosearch">커리큘럼 내용</th>
                                            <th>action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courseworks as $coursework)
                                            <tr>
                                                <td>{{ $coursework->WeekNumber }}</td>
                                                <td>{{ $coursework->ContentNumber }}</td>
                                                <td>{{ $coursework->Content }}</td>
                                                <td><input type="button" class="btn btn-primary" value="들어가기" onclick="window.location.href='/Class/{{ $class->ClassId.'/'.$coursework->CourseworkId }}/{{ $coursework->WeekNumber }}'"></input></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function InviteAddition(_inviteeid,_inviterid,_classid) {
        var ids = _inviteeid+','+_inviterid+','+_classid;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/Invite',
            data: {
                "ids": ids
            },
            success: function (data) {
                $("#modal-success-title").empty();
                $("#modal-success-title").append('초대 성공');
                $("#modal-content6").empty();
                $("#modal-content6").append('성공적으로 초대 되었습니다.');
                $("#modal-success-button").empty();
                $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="goPage('+_classid+',0)">확인</button>');
                $("#success-modal").modal('show');
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                $("#modal-content4").empty();
                $("#modal-content4").append('<p>초대 실패 하였습니다.</p>');
                $("#alert-modal").modal('show');
                //console.log(request + "/" + status + "/" + error);
            }
        })
    }
    function goPage(_classid,_type) {
        if(_type == 0) {
            location.href = "/Class/"+_classid+'/invite';
        } else {
            location.href = "/Class/"+_classid;
        }
    }
    function CancelInvite(_invitationid,_classid) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/ManageClass/DenyStudent/'+_invitationid,
            data: {
                "_method":'PATCH'
            },
            success: function (data) {
                if(data.result == "Success") {
                    $("#Large-modal").modal('hide');
                    $("#modal-success-title").empty();
                    $("#modal-success-title").append('취소 성공');
                    $("#modal-content6").empty();
                    $("#modal-content6").append('성공적으로 취소 되었습니다.');
                    $("#modal-success-button").empty();
                    $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="goPage('+_classid+',1)">확인</button>');
                    $("#success-modal").modal('show');
                } else {
                    $("#modal-content4").empty();
                    $("#modal-content4").append('<p>취소 실패 다시 시도해주세요</p>');
                    $("#alert-modal").modal('show');
                }
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                //console.log(request + "/" + status + "/" + error);
            }
        }) // End Ajax Request
    }
    function CancelClass(_userid,_classid,_invitationid) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/ManageClass/EmitStudent/'+_invitationid,
            data: {
                "_method":'PATCH',
                "_userid":_userid,
                "_classid":_classid
            },
            success: function (data) {
                if(data.result == "Success") {
                    $("#Large-modal").modal('hide');
                    $("#modal-success-title").empty();
                    $("#modal-success-title").append('방출 성공');
                    $("#modal-content6").empty();
                    $("#modal-content6").append('성공적으로 방출 되었습니다.');
                    $("#modal-success-button").empty();
                    $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="goPage('+_classid+',1)">확인</button>');
                    $("#success-modal").modal('show');
                } else {
                    $("#modal-content4").empty();
                    $("#modal-content4").append('<p>방출 실패 다시 시도해주세요</p>');
                    $("#alert-modal").modal('show');
                }
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                //console.log(request + "/" + status + "/" + error);
            }
        })
    }
    function ReInvite(_invitationid,_classid) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/ManageClass/ReInvite/'+_invitationid,
            data: {
                "_method":'PATCH'
            },
            success: function (data) {
                if(data.result == "Success") {
                    $("#Large-modal").modal('hide');
                    $("#modal-success-title").empty();
                    $("#modal-success-title").append('재초대 성공');
                    $("#modal-content6").empty();
                    $("#modal-content6").append('성공적으로 재초대 되었습니다.');
                    $("#modal-success-button").empty();
                    $("#modal-success-button").append(' <button type="button" class="btn btn-primary" onclick="goPage('+_classid+',1)">확인</button>');
                    $("#success-modal").modal('show');
                } else {
                    $("#modal-content4").empty();
                    $("#modal-content4").append('<p>재초대 실패 다시 시도해주세요</p>');
                    $("#alert-modal").modal('show');
                }
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.
                //console.log(request + "/" + status + "/" + error);
            }
        })
    }
    function goCourseStatus(_classid,_courseworkid) {
        var url = '/ShowStatus/'+_classid+'/'+_courseworkid;
        window.open(url,'_blank');
    }
</script>
