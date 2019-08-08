@extends('layouts.master')

@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                    <thead>
                    <tr>
                    <th>초대자</th>
                    <th>클래스</th>
                    <th>상태</th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="tr-shadow">
                        @foreach($invitations as $invitation)
                            <tr class="tr-shadow">
                            <td>{{ $invitation->InviterId }}</td>
                                <td>
                                <span class="block-email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8be7e4f9e2cbeef3eae6fbe7eea5e8e4e6">{{ $invitation->ClassId }}</a></span>
                                </td>
                                <td>
                                    <span class="status--waiting">Waiting</span>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="수락">
                                    <i class="zmdi zmdi-mail-send"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="요청">
                                    <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="거절">
                                    <i class="zmdi zmdi-delete"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="더보기">
                                    <i class="zmdi zmdi-more"></i>
                                    </button>
                                    </div>
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


@endsection

