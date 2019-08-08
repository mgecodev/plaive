@extends('layouts.Master')

@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 right-single">
                <div class="widget-search">
                    <div class="site-search-area">
                        <form method="get" id="site-searchform" action="#">
                            <div>
                                <input class="input-text form-control" name="search-k" id="search-k" placeholder="Search keywords..." type="text">
                                <input id="searchsubmit" value="Search" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-categories">
                    <h3 class="widget-title">Categories</h3>
                    <ul>
                        <li><a href="#">Political Science</a></li>
                        <li><a href="#">Business Leaders Guide</a></li>
                        <li><a href="#">Become a Product Manage</a></li>
                        <li><a href="#">Language Education</a></li>
                        <li><a href="#">Micro Biology</a></li>
                        <li><a href="#">Social Media Management</a></li>
                    </ul>
                </div>
                <div class="widget-tags">
                    <h3 class="widget-title">Search Tags</h3>
                    <ul class="tags">
                        <li><a href="#"><b>business</b></a></li>
                        <li><a href="#"><b>jquery</b></a></li>
                        <li><a href="#">corporate</a></li>
                        <li><a href="#">portfolio</a></li>
                        <li><a href="#">css3</a></li>
                        <li><a href="#"><b>theme</b></a></li>
                        <li><a href="#"><b>html5</b></a></li>
                        <li><a href="#"><b>mysql</b></a></li>
                        <li><a href="#">multipurpose</a></li>
                        <li><a href="#">responsive</a></li>
                        <li><a href="#">premium</a></li>
                        <li><a href="#">javascript</a></li>
                        <li><a href="#"><b>Best jQuery</b></a></li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-9">
                <div id="overviews" class="section wb">
                    <div class="container">
                        <div class="section-title row text-center">
                            <div class="col-md-8 offset-md-2">
                                <p class="lead">당신만의 수업을 만드세요.                                        
                            </div>
                        </div><!-- end title -->
            
                        <hr class="invis"> 

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

