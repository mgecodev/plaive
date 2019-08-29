<div id="courses">
    <div class="container">
        <div class="row">
            @if ($courses == NULL)
                <div>empty</div>
            @else
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                            @if($course->CourseImage == null)
                                <img src="/images/blog_1.jpg" alt="" class="img-fluid" style="max-height:200px;min-height:200px;">
                            @else
                                <img src="{{ $course->CourseImage }}" alt="" class="img-fluid" style="max-height:200px;min-height:200px;">
                            @endif
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2><a href="#" title="">{{ str_limit($course->Title, 24) }}</a></h2>
                                </div>
                                <div class="course-desc">
                                    <p>{{ str_limit($course->Comment, 30) }}</p>
                                </div>
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> {{ $course->NumOfStudent }}
                                        학생들
                                    </li>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $course->HourCount }} 시수</li>
                                    <li><i class="fa fa-book" aria-hidden="true"></i> {{ $course->WeekCount }} 주수</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->
                    {{-- <hr class="hr3">  --}}
                @endforeach
            @endif
        </div><!-- end row -->

    </div><!-- end container -->
</div><!-- end section -->

<script>

</script>
