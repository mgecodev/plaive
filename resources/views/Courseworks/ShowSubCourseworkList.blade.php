@extends('layouts.Master')
@section('javascript')
    <script type="text/javascript">

        var checked_array = Array();
        var obj = new Object();

        $(document).ready(function () {

            $('#save').click(function (e) {

                e.preventDefault();
                var _classid = $(this).attr('classid');
                var _courseworkid = $(this).attr('courseworkid');


                if (!Object.size(obj)) {

                    alert("수업을 진행해 주세요");
                } else {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: "/saveMyFootprint",
                        data: {
                            "obj": obj,
                            "_courseworkid": _courseworkid,
                            "_classid": _classid
                        },
                        success: function (data) {
                            // alert('In Ajax');
                            $("#success-modal").modal('show');
                            $("#modal-success-title").empty();
                            $("#modal-success-title").append('성공적으로 등록 되었습니다.');
                            $("#modal-content6").empty();
                        }
                    });
                }


            });

            var lang_kor = {
                "decimal": "",
                "emptyTable": "데이터가 없습니다.",
                "info": "_START_ - _END_ (총 _TOTAL_ 개)",
                "infoEmpty": "0개",
                "infoFiltered": "(전체 _MAX_ 개 중 검색결과)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "_MENU_ 개씩 보기",
                "loadingRecords": "로딩중...",
                "processing": "처리중...",
                "search": "검색 : ",
                "zeroRecords": "검색된 데이터가 없습니다.",
                "paginate": {
                    "first": "첫 페이지",
                    "last": "마지막 페이지",
                    "next": "다음",
                    "previous": "이전"
                },
                "searchPlaceholder": "검색어",
                "aria": {
                    "sortAscending": " :  오름차순 정렬",
                    "sortDescending": " :  내림차순 정렬"
                }
            };
            $('#coursework_table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor
            });
        });

        Object.size = function (obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };

        function filterToggle(element, _subcourseworkid) {

            if (element.checked) {

                obj[_subcourseworkid] = 1;
                console.log(Object.size(obj));
            } else {
                obj[_subcourseworkid] = 0;
                console.log(Object.size(obj));
            }
        }

    </script>

    <style>
        .hover-btn-new::before {
            height: 100%;
            left: 0;
            top: 0;
            width: 100%;
        }

        .hover-btn-new::after {
            background: #eea412 !important;
            height: 100%;
            left: 0;
            top: 0;
            width: 100%;
        }

        .hover-btn-new span {
            position: relative;
            z-index: 2;
        }

        .hover-btn-new:hover:after {
            height: 0;
            left: 50%;
            top: 50%;
            width: 0;
        }

        .checks {
            position: relative;
        }

        .checks input[type="checkbox"] { /* 실제 체크박스는 화면에서 숨김 */
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0
        }

        .checks input[type="checkbox"] + label {
            display: inline-block;
            position: relative;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .checks input[type="checkbox"] + label:before { /* 가짜 체크박스 */
            content: ' ';
            display: inline-block;
            width: 21px; /* 체크박스의 너비를 지정 */
            height: 21px; /* 체크박스의 높이를 지정 */
            line-height: 21px; /* 세로정렬을 위해 높이값과 일치 */
            margin: -2px 8px 0 0;
            text-align: center;
            vertical-align: middle;
            background: #fafafa;
            border: 1px solid #cacece;
            border-radius: 3px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        }

        .checks input[type="checkbox"] + label:active:before, .checks input[type="checkbox"]:checked + label:active:before {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .checks input[type="checkbox"]:checked + label:before { /* 체크박스를 체크했을때 */
            content: '\2714'; /* 체크표시 유니코드 사용 */
            color: #99a1a7;
            text-shadow: 1px 1px #fff;
            background: #e9ecee;
            border-color: #adb8c0;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05), inset 15px 10px -12px rgba(255, 255, 255, 0.1);
        }


    </style>

@endsection
@section("page_title")
    <h1>세부 강좌</h1>
@endsection
@section('content')

    <div id="courses" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered stripe hover nowrap" id="coursework_table"
                               style="width:100%;">
                            <thead>
                            <tr>
                                <th>클래스</th>
                                <th>내용</th>
                                <th class="datatable-nosort datatable-nosearch">
                                    <div class="checks"><input type="checkbox"
                                                               id="check_all"> <label
                                            for="check_all"></label></div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($subcourseworks as $subcoursework)
                                <tr class="tr-shadow">
                                    <td>
                                        <span class="block-email">{{ $subcoursework->ContentNumber }}</span>
                                    </td>
                                    <td>
                                        <div>{{ $subcoursework->Content }}</div>
                                    </td>
                                    <td>
                                        <div class="checks"><input type="checkbox"
                                                                   id="{{ $subcoursework->SubCourseworkId }}"
                                                                   onchange="filterToggle(this, {{ $subcoursework->SubCourseworkId }})"
                                            @if ($subcoursework->getStudentRecord()->where('AccountId', $id)->where('ClassId', $class_id)->where('CourseworkId', $coursework_id)->where('SubCourseworkId', $subcoursework->SubCourseworkId)->first()['Done'] == 1)
                                                <?php echo "checked";?>
                                                @endif
                                            >
                                            <label for="{{ $subcoursework->SubCourseworkId }}"></label></div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <input class="btn btn-primary" type="button" onClick="location.href='/Class/{{ $class_id }}'" value="이전으로">
                        <input class="btn btn-primary" type="button" id="save" courseworkid="{{ $coursework_id }}"
                               classid="{{ $class_id }}" value="저장">
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div><!-- end container -->
        </div><!-- end section -->



@endsection



