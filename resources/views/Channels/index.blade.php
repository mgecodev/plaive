@extends('layouts.master')

@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <center>
            <h1>내 채널 리스트</h1>
            <button class="btn btn-primary">채널 생성</button>
        </center>
        <div style="height:10px;"></div>
        <div class="table-responsive text-center">
			<table class="display" id="table" style="width:100%;">
				<thead>
					<tr>
						<th class="text-center" >#</th>
                        <th class="text-center">이름</th>
                        @if((new \Jenssegers\Agent\Agent())->isDesktop())
                        <th class="text-center" style="white-space:nowrap;">설명</th>
                        @endif
                        <th class="text-center" style="white-space:nowrap;">수정</th>
                        <th class="text-center" style="white-space:nowrap;">삭제</th>
                        <th class="text-center">ApiKey</th>
					</tr>
				</thead>
				@foreach($channels as $channel)
                <tr class="item{{$channel->ChannelId}}">
                    <td>{{$channel->ChannelId}}</td>
                    <td>{{$channel->ChannelName}}</td>
                    @if((new \Jenssegers\Agent\Agent())->isDesktop())
                    <td><textarea rows="1" style="width:100%;" readonly>{!! $channel->ChannelDescription !!}</textarea></td>
                    @endif
                    <td> 
                        <button class="delete-modal btn btn-primary" data-info="">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td>
                        <button class="delete-modal btn btn-danger" data-info="">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td> 
                        <button class="delete-modal btn btn-info" data-info="">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
				</tr>
				@endforeach
			</table>
        </div>
    </div>
</div>
@endsection