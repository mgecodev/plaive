<div class="pd-20 bg-white border-radius-4 box-shadow">
    <h5 class="weight-500 mb-20">{{ $class_id }} 클래스입니다</h5>
    <div class="tab">
        <div class="row clearfix">
            <div class="col-md-3 col-sm-12">
                <ul class="nav flex-column vtabs nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#home4" role="tab" aria-selected="true">학생
                            현황</a>
                        <a class="nav-link" data-toggle="tab" href="#invite4" role="tab" aria-selected="false">학생
                            초대하기</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile4" role="tab" aria-selected="false">게시물</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="home4" role="tabpanel">
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
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">이름</th>
                                    <th scope="col">메일</th>
                                    <th scope="col">상태</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tot_invited_students as $tot_invited_student)
                                    <tr>
                                        <th scope="row">{{ $tot_invited_student->name }}</th>
                                        <th scope="row">{{ $tot_invited_student->email }}</th>
                                        <th scope="row">
                                            @if ($tot_invited_student->Accepted == 1)
                                                <span class="badge badge-success">Accepted</span>
                                            @elseif ($tot_invited_student->Accepted == 0)
                                                <span class="badge badge-primary">Pending</span>
                                            @endif
                                        </th>
                                        <th scope="row"><input class="btn btn-info" type="reset" value="취소"></th>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile4" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive text-center">
                                    <table class="table table-bordered stripe hover nowrap" id="table"
                                           style="width:100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1"
                                                colspan="1" aria-label="Name">Name
                                            </th>
                                            <th class="sorting" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                aria-label="Age: activate to sort column ascending">Age
                                            </th>
                                            <th class="sorting" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                aria-label="Office: activate to sort column ascending">
                                                Office
                                            </th>
                                            <th class="sorting" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                aria-label="Address: activate to sort column ascending">
                                                Address
                                            </th>
                                            <th class="datatable-nosort sorting_disabled" rowspan="1"
                                                colspan="1" aria-label="Action">Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr role="row" class="odd">
                                            <td class="table-plus sorting_1" tabindex="0">Andrea J. Cagle
                                            </td>
                                            <td>30</td>
                                            <td>Gemini</td>
                                            <td>1280 Prospect Valley Road Long Beach, CA 90802</td>

                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-outline-primary dropdown-toggle"
                                                       href="#" role="button" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa fa-eye"></i> View</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa fa-pencil"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="fa fa-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="invite4" role="tabpanel">
                        <div class="pd-20">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered stripe hover nowrap" id="table" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col">이름</th>
                                        <th scope="col">메일</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tot_viable_students as $tot_viable_student)
                                        <tr>
                                            <th scope="row">{{ $tot_viable_student->name }}</th>
                                            <th scope="row">{{ $tot_viable_student->email }}</th>
                                            <th scope="row">
                                                <input type="submit" val="{{ $tot_viable_student->id.','.$id.','.$class_id }}" name="{{ $id }}"
                                                       class="btn btn-primary submit2" value="초대하기"></button>
                                            </th>
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
