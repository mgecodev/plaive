<div id="accept-invitation" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive text-center">
                    <table class="table table-bordered stripe hover nowrap" id="invite_table" style="width:100%;">
                        <thead>
                        <tr>
                            <th>클래스</th>
                            <th class="datatable-nosort datatable-nosearch"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($invitations as $invitation)
                            <tr class="tr-shadow">
                                <td>
                                    <span class="block-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8be7e4f9e2cbeef3eae6fbe7eea5e8e4e6">{{ $invitation->ClassName }}</a></span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary accept1" val="{{ $invitation->InvitationId }}">수락</button>
                                    <button type="button" class="btn btn-danger decline1" val="{{ $invitation->InvitationId }}">거절</button>
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

<script>
    var count = <?php echo count($invitations);?>;
    $(document).ready( function () {
        var lang_kor = {
            "decimal" : "",
            "emptyTable" : "데이터가 없습니다.",
            "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
            "infoEmpty" : "0개",
            "infoFiltered" : "(전체 _MAX_ 개 중 검색결과)",
            "infoPostFix" : "",
            "thousands" : ",",
            "lengthMenu" : "_MENU_ 개씩 보기",
            "loadingRecords" : "로딩중...",
            "processing" : "처리중...",
            "search" : "검색 : ",
            "zeroRecords" : "검색된 데이터가 없습니다.",
            "paginate" : {
                "first" : "첫 페이지",
                "last" : "마지막 페이지",
                "next" : "다음",
                "previous" : "이전"
            },
            "searchPlaceholder": "검색어",
            "aria" : {
                "sortAscending" : " :  오름차순 정렬",
                "sortDescending" : " :  내림차순 정렬"
            }
        };
        $('#invite_table').DataTable({
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            },{
                targets: "datatable-nosearch",
                searchable: false,
            }],
            language: lang_kor
        });
        setInterval(function() {
            var change = 0;
            $.ajax({
            	type : "GET",
            	url : "/CheckInvitation/student/realtime",
            	data: {
                    "_count" : count
                },
            	success:function(data) {
                    if(data.result == 'Fail') {
                        change = 1;
                    }
                    if(change == 0) {
                        $('#accept-invitation').html(data);
                    } 
            	}
            });
        },3000);
    });
    $(".accept1").click(function() {

        var invitation_id = $(this).attr("val");    // get invitation id

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/AcceptInvitation',
            data: {
                "invitation_id": invitation_id
            },
            success: function (data) {

                $('#accept-invitation').html(data)
                // $("input:text").val("되돌리기")
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                //console.log(request + "/" + status + "/" + error);
            }
        }) // End Ajax Request

    });

    $('.decline1').click(function() {

        var invitation_id = $(this).attr("val");    // get invitation id

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/DenyInvitation',
            data: {
                "invitation_id": invitation_id
            },
            success: function (data) {

                $('#accept-invitation').html(data)
                // $("input:text").val("되돌리기")
            },
            error: function (request, status, error) {
                // 에러 출력을 활성화 하려면 아래 주석을 해제한다.

                //console.log(request + "/" + status + "/" + error);
            }
        }) // End Ajax Request
    });

</script>
