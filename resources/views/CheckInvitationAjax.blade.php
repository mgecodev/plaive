<div id="accept-invitation" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>초대자</th>
                        <th>클래스</th>
                        <th>상태</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($invitations as $invitation)
                        <tr class="tr-shadow">
                            <td>{{ $invitation->InviterId }}</td>
                            <td>
                                <span class="block-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8be7e4f9e2cbeef3eae6fbe7eea5e8e4e6">{{ $invitation->ClassId }}</a></span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-warning">Waiting</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary accept1" val="{{ $invitation->InvitationId }}">수락</button>
                                <button type="button" class="btn btn-danger decline1">거절</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
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
