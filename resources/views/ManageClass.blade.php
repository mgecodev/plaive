@extends('layouts.Master')

@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 right-single">
                <div class="widget-categories">
                    <h3 class="widget-title">카테고리</h3>
                    <ul>
                        <li><a href="" id="showall-class" val="{{ $id }}">클래스 리스트</a></li>
                        <li><a href="" id="enroll-class" val="{{ $id }}">클래스 등록</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                @include('ShowAllClassAjax');
            </div>
        </div>
    </div>
</div>

@endsection
