@extends('layouts.Master')

@section('content')

<div id="overviews" class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 right-single">
                <div class="widget-categories">
                    <h3 class="widget-title">카테고리</h3>
                    <ul>
                        <li><a href="" id="showall" val="{{ $id }}">클래스 리스트</a></li>
                        <li><a href="" id="enroll" val="{{ $id }}">클래스 등록</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                                <img src="images/blog_1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2><a href="#" title="">Engineering</a></h2>
                                </div>
                                <div class="course-desc">
                                    <p>Lorem ipsum door sit amet, fugiat deicata avise id cum, no quo maiorum intel ogrets geuiat operts elicata libere avisse id cumlegebat, liber regione eu sit.... </p>
                                </div>
                                <div class="course-rating">
                                    4.5
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                </div>
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 6 Month</li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> 56 Student</li>
                                    <li><i class="fa fa-book" aria-hidden="true"></i> 7 Books</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                                <img src="images/blog_2.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2><a href="#" title="">Hotel Management</a></h2>
                                </div>
                                <div class="blog-desc">
                                    <p>Lorem ipsum door sit amet, fugiat deicata avise id cum, no quo maiorum intel ogrets geuiat operts elicata libere avisse id cumlegebat, liber regione eu sit.... </p>
                                </div>
                                <div class="course-rating">
                                    4.5
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                </div>
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 6 Month</li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> 56 Student</li>
                                    <li><i class="fa fa-book" aria-hidden="true"></i> 7 Books</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div>
    </div>
</div>

@endsection
