@extends('layouts.master')

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
                    <h1>수업을 개설합니다</h1>
                    
                    <?php
                        $cnt = $courses_info->count();
                        $i = 0;    
                    ?>
                    
                    @if ($cnt%2 == 0) 
                        @foreach($courses_info as $course_info)

                            @if ($i = 0) <div class="row">
                            @endif
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="course-item">
                                        <div class="image-blog">
                                            <img src="images/blog_1.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="course-br">
                                            <div class="course-title">
                                                <h2><a href="#" title="">{{!! $course_info->title !!}}</a></h2>
                                            </div>
                                            <div class="course-desc">
                                                <p>{{!! $course_info->period !!}}</p>
                                            </div>
                                            <div class="course-rating">
                                                {{!! $course_info->stars !!}}
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="course-meta-bot">
                                            <ul>
                                                <li><i class="fa fa-calendar" aria-hidden="true"></i>{{!! $course_info->period !!}}</li>
                                                <li><i class="fa fa-users" aria-hidden="true"></i>{{!! $course_info->num_of_students !!}}</li>
                                                <li><i class="fa fa-book" aria-hidden="true"></i>{{!! $course_info->num_of_books !!}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            @if ($i == 1) 
                                </div>
                                <hr class="hr3">
                                <?php 
                                    $i = 0;
                                    continue;
                                ?>
                            @endif
                            <?php $i += 1;?> 
                        @endforeach    

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
    
                                <form action="/SaveCourseInfo" method="POST" name="openClassForm" id="openClassForm">
    
                                    @csrf
                                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php auth()->user(); ?>">
                                    <div class="row row-fluid">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="강의 제목">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="num_of_books" id="num_of_books" class="form-control" placeholder="교과서 수">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="stars" id="stars" class="form-control" placeholder="별점">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" name="period" id="period" class="form-control" placeholder="기간">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <textarea class="form-control" name="description" id="description" rows="6" placeholder="수업에 대한 설명을 추가해주세요"></textarea>
                                        </div>
                                        <div class="text-center pd">
                                            <input type="submit" value="Open Class" name="submit" id="openClassForm" class="btn btn-light btn-radius btn-brd grd1 btn-block"/>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end col -->
    
                            <div class="col-lg-6 col-md-6 col-12">
                            </div><!-- end col -->
                        </div><!-- end row --> 
                    
                    
                    @else 
                        @foreach($courses_info as $course_info)

                            @if ($i = 0) <div class="row">
                            @endif
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="course-item">
                                        <div class="image-blog">
                                            <img src="images/blog_1.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="course-br">
                                            <div class="course-title">
                                                <h2><a href="#" title="">{{!! $course_info->title !!}}</a></h2>
                                            </div>
                                            <div class="course-desc">
                                                <p>{{!! $course_info->period !!}}</p>
                                            </div>
                                            <div class="course-rating">
                                                {{!! $course_info->stars !!}}
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half"></i>
                                            </div>
                                        </div>
                                        <div class="course-meta-bot">
                                            <ul>
                                                <li><i class="fa fa-calendar" aria-hidden="true"></i>{{!! $course_info->period !!}}</li>
                                                <li><i class="fa fa-users" aria-hidden="true"></i>{{!! $course_info->num_of_students !!}}</li>
                                                <li><i class="fa fa-book" aria-hidden="true"></i>{{!! $course_info->num_of_books !!}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            @if ($i == 1) 
                                </div>
                                <hr class="hr3">
                                <?php 
                                    $i = 0;
                                    continue;
                                ?>
                            @endif
                            
                            <?php $i += 1;?> 
                      
                       
                        @endforeach

                        <div class="col-lg-6 col-md-6 col-12">
    
                            <form action="/SaveCourseInfo" method="POST" name="openClassForm" id="openClassForm">

                                @csrf
                                <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php auth()->user(); ?>">
                                <div class="row row-fluid">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="title" id="title" class="form-control" placeholder="강의 제목">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="num_of_books" id="num_of_books" class="form-control" placeholder="교과서 수">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="stars" id="stars" class="form-control" placeholder="별점">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="period" id="period" class="form-control" placeholder="기간">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="form-control" name="description" id="description" rows="6" placeholder="수업에 대한 설명을 추가해주세요"></textarea>
                                    </div>
                                    <div class="text-center pd">
                                        <input type="submit" value="Open Class" name="submit" id="openClassForm" class="btn btn-light btn-radius btn-brd grd1 btn-block"/>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end col -->
                    </div>
                    

                    @endif
                    
                </div>
            </div>
        </div>
    </div>


@endsection

