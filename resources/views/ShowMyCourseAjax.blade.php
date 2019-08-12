<div id="courses">
        <div class="container">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                                <img src="/images/blog_1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                <h2><a href="#" title="">{{ $course->Title }}</a></h2>
                                </div>
                                <div class="course-desc">
                                <p>{{ $course->Comment }}</p>
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
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $course->NumOfStudent }} 학생들</li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> {{ $course->HourCount }} 시수</li>
                                    <li><i class="fa fa-book" aria-hidden="true"></i> {{ $course->WeekCount }} 주수</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->
                    {{-- <hr class="hr3">  --}}
                @endforeach
            </div><!-- end row --> 
        
        </div><!-- end container -->
    </div><!-- end section -->