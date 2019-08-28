@extends('layouts.Master')

@section('content')
<style>

    .big-tagline a.hover-btn-new::before,
    .big-tagline a.hover-btn-new::after {
        background: #fff;
        content: '';
        position: absolute;
        z-index: 1;
        color: #28b8ce !important;
    }

    .hover-btn-new::before {
        height: 100%;
        left: 0;
        top: 0;
        width: 100%;
    }
    .hover-btn-new::after, .carousel-control-prev, .carousel-control-next {
        background: #28b8ce !important;
        /*color: #28b8ce !important;*/
    }

    body.host_version .stat-wrap, body.host_version .dmtop:hover, body.host_version .cac:hover, body.host_version .features-right li:hover i, body.host_version .features-left li:hover i, body.host_version .divider-bar, body.host_version .owl-next:hover i, body.host_version .owl-prev:hover i, body.host_version .icon-wrapper:hover i:hover, body.host_version .grd1:hover, body.host_version .grd1:focus {
        background-position: 100px;
        color: #ffffff !important;
        background: #28b8ce;
    }

    .container {
        max-width: 1220px !important;
        width: 100%;
    }
</style>
<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div id="home" class="first-section" style="background-image:url('images/slider-01.jpg');">
                <div class="dtab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-right">
                                <div class="big-tagline">
                                    <h2><strong>플라이브 </strong> 교육 관리 플랫폼</h2>
                                    <p class="lead">플라이브와 함께 클래스를 개설하고 학생과 수업을 진행해 보세요. </p>
                                        <a href="#" class="hover-btn-new"><span>Contact Us</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="hover-btn-new"><span>Read More</span></a>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div>
            </div><!-- end section -->
        </div>
        <div class="carousel-item">
            <div id="home" class="first-section" style="background-image:url('images/slider-02.jpg');">
                <div class="dtab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-left">
                                <div class="big-tagline">
                                    <h2 data-animation="animated zoomInRight">무엇을 <strong>배우고 싶으세요?</strong></h2>
                                    <p class="lead" data-animation="animated fadeInLeft">플라이브와 함께 AI 챗봇을 만들어보세요. </p>
                                        <a href="#" class="hover-btn-new"><span>Contact Us</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="hover-btn-new"><span>Read More</span></a>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div>
            </div><!-- end section -->
        </div>
        <div class="carousel-item">
            <div id="home" class="first-section" style="background-image:url('images/slider-03.jpg');">
                <div class="dtab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-center">
                                <div class="big-tagline">
                                    <h2 data-animation="animated zoomInRight"><strong>동영상 컨텐츠</strong> 와 연계된 플라이브만의 다양한 키트</h2>
                                    <p class="lead" data-animation="animated fadeInLeft">미세먼지 키트와 자율주행 키트는 아이들의 상상력을 자극합니다.</p>
                                        <a href="#" class="hover-btn-new"><span>Contact Us</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="hover-btn-new"><span>Read More</span></a>
                                </div>
                            </div>
                        </div><!-- end row -->
                    </div><!-- end container -->
                </div>
            </div><!-- end section -->
        </div>
        <!-- Left Control -->
        @if(!(new \Jenssegers\Agent\Agent())->isPhone())
        <a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        @endif
        <!-- Right Control -->
        @if(!(new \Jenssegers\Agent\Agent())->isPhone())
        <a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        @endif
    </div>
</div>

<div id="overviews" class="section wb">
    <div class="container">
        <div class="section-title row text-center">
            <div class="col-md-8 offset-md-2">
                <h3>About</h3>
                <p class="lead">아이들이 메이커 수업을 가장 쉽고 즐겁게 시작하는 곳, 플라이브입니다</p>
            </div>
        </div><!-- end title -->
        <div class="row align-items-center">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="message-box">
{{--                    <h4>2018 BEST SmartEDU education school</h4>--}}
                    <h3 style="text-align: center;">컴퓨터 사고력을</h3>
                    <h3 style="text-align: center;">즐겁게 습득하는 방법,</h3>
                    <h3 style="text-align: center;">직접 만들며 배우는</h3>
                    <h3 style="text-align: center;"><b>메이커교육</b>입니다.</h3>
                    <br>
                    <p style="text-align:center;">미래 인재에게는 손으로 직접 만들며 아이디어를 실현해 보는 메이커 교육이 필요합니다. 메이커 교육은 시챙착오를 통해 창의적으로 문제를 해결할 수 있는 능력을 배양합니다.</p>
{{--                    <a href="#" class="hover-btn-new cyan"><span>Learn More</span></a>--}}
                </div><!-- end messagebox -->
            </div><!-- end col -->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="message-box">
                    <h3 style="text-align:center;">수업에 적용 가능한</h3>
                    <h3 style="text-align: center;">단계별 커리큘럼과</h3>
                    <h3 style="text-align: center;">무료 동영상 강좌,</h3>
                    <h3 style="text-align: center;">빠른 피드백을 제공합니다.</h3>
                    <br>
                    <p style="text-align:center;">수준 별 커리큘럼을 추천하고 무료로 동영상 강좌를 제공합니다. 선생님과의 상호 학습과 프로젝트 기반의 수업은 학생이 빠르게 실력을 향상시킬 수 있게 도와줍니다.</p>
{{--                    <a href="#" class="hover-btn-new cyan"><span>Learn More</span></a>--}}
                </div><!-- end messagebox -->
            </div><!-- end col -->
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="message-box">
                    <h3 style="text-align:center;">융합형 인재양성을 위한</h3>
                    <h3 style="text-align:center;">IoT, Big Data, AI</h3>
                    <h3 style="text-align:center;">이 모든 교육을</h3>
                    <h3 style="text-align:center;"><b>플라이브</b>에서 시작합니다.</h3>
                    <br>
                    <p style="text-align:center;">자신의 분야에 IoT, Big data, AI를 접목해 발전시켜 나가는 융합적 사고를 기릅니다. 인터넷을 통해 데이터를 수집, 축적, 분석하는 가장 쉽고 재미있는 IoT수업을 제공합니다.</p>
{{--                    <a href="#" class="hover-btn-new cyan"><span>Learn More</span></a>--}}
                </div><!-- end messagebox -->
            </div><!-- end col -->
        </div>
    </div><!-- end container -->
</div><!-- end section -->

{{--<section class="section lb page-section">--}}
{{--    <div class="container">--}}
{{--         <div class="section-title row text-center">--}}
{{--            <div class="col-md-8 offset-md-2">--}}
{{--                <h3>Our history</h3>--}}
{{--                <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>--}}
{{--            </div>--}}
{{--        </div><!-- end title -->--}}
{{--        <div class="timeline">--}}
{{--            <div class="timeline__wrap">--}}
{{--                <div class="timeline__items">--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-01">--}}
{{--                            <h2>2018</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-02">--}}
{{--                            <h2>2015</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-03">--}}
{{--                            <h2>2014</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-04">--}}
{{--                            <h2>2012</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-01">--}}
{{--                            <h2>2010</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-02">--}}
{{--                            <h2>2007</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-03">--}}
{{--                            <h2>2004</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="timeline__item">--}}
{{--                        <div class="timeline__content img-bg-04">--}}
{{--                            <h2>2002</h2>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dignissim neque condimentum lacus dapibus. Lorem--}}
{{--                                ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<div class="section cl">
    <div class="container">
        <div class="row text-left stat-wrap">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-study"></i></span>
                <p class="stat_count">250</p>
                <h3>학생 수</h3>
            </div><!-- end col -->

            <div class="col-md-4 col-sm-4 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-online"></i></span>
                <p class="stat_count">24</p>
                <h3>클래스 수</h3>
            </div><!-- end col -->

            <div class="col-md-4 col-sm-4 col-xs-12">
                <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-years"></i></span>
                <p class="stat_count">45</p>
                <h3>커리큘럼 수</h3>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->

{{--<div id="plan" class="section lb">--}}
{{--    <div class="container">--}}
{{--        <div class="section-title text-center">--}}
{{--            <h3>Choose Your Plan</h3>--}}
{{--            <p>Lorem ipsum dolor sit aet, consectetur adipisicing lit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>--}}
{{--        </div><!-- end title -->--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-6 offset-md-3">--}}
{{--                <div class="message-box">--}}
{{--                    <ul class="nav nav-pills nav-stacked" id="myTabs">--}}
{{--                        <li><a class="active" href="#tab1" data-toggle="pill">Monthly Subscription</a></li>--}}
{{--                        <li><a href="#tab2" data-toggle="pill">Yearly Subscription</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div><!-- end col -->--}}
{{--        </div>--}}

{{--        <hr class="invis">--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="tab-content">--}}
{{--                    <div class="tab-pane active fade show" id="tab1">--}}
{{--                        <div class="row text-center">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$45</h2>--}}
{{--                                        <h3>per month</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$59</h2>--}}
{{--                                        <h3>per month</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>150</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>65GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>60</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>30</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$85</h2>--}}
{{--                                        <h3>per month</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end row -->--}}
{{--                    </div><!-- end pane -->--}}

{{--                    <div class="tab-pane fade" id="tab2">--}}
{{--                        <div class="row text-center">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$477</h2>--}}
{{--                                        <h3>Year</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$485</h2>--}}
{{--                                        <h3>Year</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>150</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>65GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>60</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>30</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-4">--}}
{{--                                <div class="pricing-table pricing-table-highlighted">--}}
{{--                                    <div class="pricing-table-header grd1">--}}
{{--                                        <h2>$500</h2>--}}
{{--                                        <h3>Year</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-space"></div>--}}
{{--                                    <div class="pricing-table-features">--}}
{{--                                        <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>--}}
{{--                                        <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>--}}
{{--                                        <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>--}}
{{--                                        <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>--}}
{{--                                        <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="pricing-table-sign-up">--}}
{{--                                        <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- end row -->--}}
{{--                    </div><!-- end pane -->--}}
{{--                </div><!-- end content -->--}}
{{--            </div><!-- end col -->--}}
{{--        </div><!-- end row -->--}}
{{--    </div><!-- end container -->--}}
{{--</div><!-- end section -->--}}

<div id="testimonials" class="parallax section db parallax-off" style="background-image:url('images/parallax_04.jpg');">
    <div class="container">
{{--        <div class="section-title text-center">--}}
{{--            <h3>Testimonials</h3>--}}
{{--            <p>Lorem ipsum dolor sit aet, consectetur adipisicing lit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>--}}
{{--        </div><!-- end title -->--}}

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="testi-carousel owl-carousel owl-theme">
                    <div class="testimonial clearfix">
                        <div class="testi-meta">
{{--                            <img src="images/testi_01.png" alt="" class="img-fluid">--}}
{{--                            <h4>James Fernando </h4>--}}
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> 기록을 남길 수 있어서 좋았어요</h3>
                            <p class="lead">다른 수업과는 달리 내가 수업에서 한 활동들에 대한 기록들이 잘 정리되어 있어 결과를 한 눈에 보기 편했습니다.</p>
                            <h4>장길준 (소마중 3학년)</h4>

                        </div>
                        <!-- end testi-meta -->
                    </div>
                    <!-- end testimonial -->

                    <div class="testimonial clearfix">
                        <div class="testi-meta">
                            <img src="images/testi_02.png" alt="" class="img-fluid">
                            <h4>Jacques Philips </h4>
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                            <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                        </div>
                        <!-- end testi-meta -->
                    </div>
                    <!-- end testimonial -->

                    <div class="testimonial clearfix">
                        <div class="testi-meta">
                            <img src="images/testi_03.png" alt="" class="img-fluid ">
                            <h4>Venanda Mercy </h4>
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                            <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                        </div>
                        <!-- end testi-meta -->
                    </div>
                    <!-- end testimonial -->
                    <div class="testimonial clearfix">
                        <div class="testi-meta">
                            <img src="images/testi_01.png" alt="" class="img-fluid">
                            <h4>James Fernando </h4>
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                            <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                        </div>
                        <!-- end testi-meta -->
                    </div>
                    <!-- end testimonial -->

                    <div class="testimonial clearfix">
                        <div class="testi-meta">
                            <img src="images/testi_02.png" alt="" class="img-fluid">
                            <h4>Jacques Philips </h4>
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                            <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                        </div>
                        <!-- end testi-meta -->
                    </div>
                    <!-- end testimonial -->

                    <div class="testimonial clearfix">
                        <div class="testi-meta">
                            <img src="images/testi_03.png" alt="" class="img-fluid">
                            <h4>Venanda Mercy </h4>
                        </div>
                        <div class="desc">
                            <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                            <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                        </div>
                        <!-- end testi-meta -->
                    </div><!-- end testimonial -->
                </div><!-- end carousel -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->

<div class="parallax section dbcolor">
    <div class="container">
        <div class="row logos">
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_01.png" alt="" class="img-repsonsive"></a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_02.png" alt="" class="img-repsonsive"></a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_03.png" alt="" class="img-repsonsive"></a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_04.png" alt="" class="img-repsonsive"></a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_05.png" alt="" class="img-repsonsive"></a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                <a href="#"><img src="images/logo_06.png" alt="" class="img-repsonsive"></a>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->
@stop
