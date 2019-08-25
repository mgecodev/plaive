<div class="pd-20 bg-white border-radius-4 box-shadow">
    <h5 class="weight-500 mb-20">{{ $class_id }} 클래스입니다</h5>
    <div class="tab">
        <div class="row clearfix">
            <div class="col-md-3 col-sm-12">
                <ul class="nav flex-column vtabs nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $board_flag == null ? 'active show' : '' }}" data-toggle="tab" href="#home4" role="tab" aria-selected="true">학생
                            현황</a>
                        <a class="nav-link" data-toggle="tab" href="#invite4" role="tab" aria-selected="false">학생
                            초대하기</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $board_flag == 'board' ? 'active show' : '' }}" data-toggle="tab" href="#profile4" role="tab" aria-selected="false">게시물</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="tab-content">
                    <div class="tab-pane fade {{ $board_flag == null ? 'active show' : '' }}" id="home4" role="tabpanel">
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
                                <table class="table table-bordered stripe hover nowrap" id="first_table" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>이름</th>
                                        <th>메일</th>
                                        <th>상태</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tot_invited_students as $tot_invited_student)
                                        <tr>
                                            <td>{{ $tot_invited_student->name }}</td>
                                            <td>{{ $tot_invited_student->email }}</td>
                                            <td>
                                                @if ($tot_invited_student->Accepted == 1)
                                                    <span class="badge badge-success">Accepted</span>
                                                @elseif ($tot_invited_student->Accepted == 0)
                                                    <span class="badge badge-primary">Pending</span>
                                                @endif
                                            </td>
                                            <td scope="row"><input class="btn btn-info" type="reset" value="취소"></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ $board_flag == 'board' ? 'active show' : '' }}" id="profile4" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered stripe hover nowrap" id="table"
                                           style="width:100%;">
                                        <thead>
                                        <tr>
                                            <th class="text-center datatable-nosearch" >#</th>
                                            <th class="text-center">작성자</th>
                                            <th class="text-center">제목</th>
                                            <th class="text-center datatable-nosearch" style="white-space:nowrap;">생성일</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($boards as $board)
                                        <?php
                                            $url = 'ShowBoard/Class/'.$board->BoardId.'/'.$class_id;
                                        ?>
                                        <tr class="item{{$board->BoardId}}" onclick="location.href='{{ asset($url) }}'">
                                            <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle;">{{ $board->WriterName }}</td>
                                            <td style="vertical-align: middle;">{{ str_limit($board->BoardTitle,40) }}</td>
                                            <td style="vertical-align: middle;">{{ $board->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <center>
                                        <?php
                                            $url = '/CreateBoard/Class/'.$class_id;
                                        ?>
                                        <a href="{{ asset($url) }}"><button class="btn btn-secondary">새 게시물</button></a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="invite4" role="tabpanel">
                        <div class="pd-20">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered stripe hover nowrap" id="second_table" style="width:100%;">
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
                                                <input type="submit" val="{{ $tot_viable_student->id.','.$id.','.$class_id }}" name="{{ $id }}"
                                                       class="btn btn-primary submit2" value="초대하기"></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.submit2').click(function (e) {

        var ids = $(this).attr('val');
        // var teacher_id = $(this).attr('val2');

        // alert(student_id);

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

                // $('#invite4').html(data)
                $("input:text").val("되돌리기")
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                //console.log(request + "/" + status + "/" + error);
            }
        }) // End Ajax Request
    });
</script>
