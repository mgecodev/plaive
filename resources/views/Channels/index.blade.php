@extends('layouts.Master')
@section('javascript')
<script>
$(document).ready( function () {
    $('#table').DataTable();
    var table_filter = $('#table_filter').children();
    var filter_label = $(table_filter[0]).children();
    var label_input = $(filter_label[0]).attr('class','table_search');

});
</script>
@endsection
@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-9 blog-post-single">
                <center>
                    <h1>내 채널 리스트</h1>
                </center>
                <div style="height:10px;"></div>
                <div class="table-responsive text-center">
                <table class="table table-striped table-bordered" id="table" style="width:100%;">
                        <thead>
                            <tr>
                                @if((new \Jenssegers\Agent\Agent())->isPhone())
                                <th class="text-center">이름</th>
                                <th class="text-center" style="white-space:nowrap;">Action</th>
                                @else
                                <th class="text-center" >#</th>
                                <th class="text-center">이름</th>
                                <th class="text-center" style="white-space:nowrap;">생성일</th>
                                <th class="text-center" style="white-space:nowrap;">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @foreach($channels as $channel)
                        <tr class="item{{$channel->ChannelId}}">
                            @if((new \Jenssegers\Agent\Agent())->isPhone())
                            <td style="vertical-align: middle;">{{str_limit($channel->ChannelName,10)}}</td>
                            <td style="vertical-align: middle;"> 
                                <button class="btn btn-primary" data-info="">
                                    <i class="fa fa-edit fa-sm" aria-hidden="true"></i>
                                </button>&nbsp;
                                <button class="delete-modal btn btn-danger" data-info="">
                                    <i class="fa fa-trash fa-sm" aria-hidden="true"></i>
                                </button>
                                <button class="delete-modal btn btn-info" data-info="">
                                    <i class="fa fa-info fa-sm" aria-hidden="true"></i>
                                </button>&nbsp;
                                <button class="delete-modal btn btn-info" data-info="">
                                    <i class="fa fa-download fa-sm" aria-hidden="true"></i>
                                </button>
                            </td>
                            @else
                            <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td style="vertical-align: middle;">{{ str_limit($channel->ChannelName,25) }}</td>
                            <td style="vertical-align: middle;">{{ $channel->created_at }}</td>
                            <td style="vertical-align: middle;"> 
                                <button class="btn btn-primary" data-info="">
                                    <i class="fa fa-edit fa-lg" aria-hidden="true"></i>
                                </button>&nbsp;
                                <button class="delete-modal btn btn-danger" data-info="">
                                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                </button>&nbsp;
                                <button class="delete-modal btn btn-info" data-info="">
                                    <i class="fa fa-info fa-lg" aria-hidden="true"></i>
                                </button>&nbsp;
                                <button class="delete-modal btn btn-info" data-info="">
                                    <i class="fa fa-download fa-lg" aria-hidden="true"></i>
                                </button>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-12 right-single">
                <h1>도움말</h1>
                <ul>
                    <li style="font-size:25px;">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </li>
                    등록한 채널에 대해 정보를 수정하는 아이콘
                    <li style="font-size:25px;">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                    </li>
                    채널을 삭제 하는 아이콘
                    <li style="font-size:25px;">
                            <i class="fa fa-info" aria-hidden="true"></i>
                    </li>
                    채널 ApiKey와 대략적인 데이터 넣는 법을 알려주는 아이콘
                    <li style="font-size:25px;">
                            <i class="fa fa-download" aria-hidden="true"></i>
                    </li>
                    채널에 대한 데이터를 다운 받는 아이콘
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection