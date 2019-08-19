@extends('layouts.Master')
@section('page_title')
<h1>강좌 관리</h1>
@endsection
@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 right-single">
                <div class="widget-categories">
                    <h3 class="widget-title">카테고리</h3>
                    <ul>
                        <li><a href="" id="showall" val="{{ $id }}">전체 강좌 리스트</a></li>
                        <li><a href="" id="mycourse" val="{{ $id }}">나의 강좌 리스트</a></li>
                        <li><a href="" id="enroll" val="{{ $id }}">강좌 등록</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                @include('ShowAllCourseAjax')
            </div>
        </div>
    </div>
</div>


@endsection

