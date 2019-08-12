@extends('layouts.Master')
@section('page_title')
<h1>강좌 생성</h1>
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
                <div id="courses">
                    <div class="container">
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-12">

                                <div class="row">
                                    <div class="big-tagline">
                                        <h2><strong>로고 </strong>고품질의 메이커 컨텐츠를 이용해보세요.</h2>
                                        <p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                            <a href="#" class="hover-btn-new"><span>커리큘럼 선택하기</span></a>
                                           
                                    </div>
                                </div>
                                <hr class="invis"> 
                                <div class="row">
                                    <div class="big-tagline">
                                        <h2><strong>로고 </strong>직접 수업을 개설해 보세요.</h2>
                                        <p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                            <a href="/Invite" class="hover-btn-new"><span>클래스 개설하기</span></a>
                                            
                                    </div>
                                </div>
                                
                            </div><!-- end col -->
                        </div><!-- end row -->			
                        
                        <hr class="hr3"> 
                    
                    </div><!-- end container -->
                </div><!-- end section -->
            </div>
        </div>
    </div>
</div>


@endsection

