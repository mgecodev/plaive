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
            $('#table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor
            });
            $('#first_table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor
            });
            var second_table = $('#second_table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor
            });
            $('#second_table').on("click", "button", function(){
                second_table.row($(this).parents('tr')).remove().draw(false);
            });
            $('#third_table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor
            });
            $('#fourth_table').DataTable({
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }, {
                    targets: "datatable-nosearch",
                    searchable: false,
                }],
                language: lang_kor,
                aaSorting: []
            });
        });
    </script>
@endsection
@section("page_title")
<h1>{{ $class->ClassName.' 클래스' }}</h1>
@endsection
@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 right-single">
                    @include('StudentManagementAjax')
                </div>
            </div>
        </div>
    </div>
@endsection
