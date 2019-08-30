@extends('layouts.Master')
@section('javascript')
    <script>
        $(document).ready(function () {
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
    </script>
@endsection

@section('content')

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
    </style>

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
                                <th class="datatable-nosort datatable-nosearch"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($courseworks as $coursework)
                                @if ($coursework->ContentNumber != 0)
                                    @continue;
                                @endif
                                <tr class="tr-shadow">
                                    <td>
                                        <span class="block-email">{{ $coursework->ContentNumber }}</span>
                                    </td>
                                    <td>
                                        <div>{{ $coursework->Content }}</div>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end section -->
@stop

