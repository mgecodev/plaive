@extends('layouts.Master')
@section("page_title")
<h1>나의 클래스 리스트</h1>
@endsection
@section('content')

    <style>

    .custom-background {

        background: white !important;
    }

    </style>

    <div class="row">
        <div class="col-lg-2 custom-background">
        </div>
        <div class="col-lg-8 custom-background">
            <div id="courses" class="section wb">
                <div class="container">
                    <div class="row">
                        @foreach($my_classes as $my_class)
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="course-item">
                                    <div class="image-blog">
                                        @if($my_class->ClassImage  == null)
                                        <img src="/images/blog_1.jpg" alt="" class="img-fluid" style="max-height:200px;min-height:200px;">
                                        @else
                                        <img src={{ $my_class->ClassImage }} alt="" class="img-fluid" style="max-height:200px;min-height:200px;">
                                        @endif
                                    </div>
                                    <div class="course-br">
                                        <div class="course-title">
                                            <h2><a href="/Class/{{ $my_class->ClassId }}" title="">{{ str_limit($my_class->ClassName,24) }}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end container -->
            </div><!-- end section -->
        </div>
        <div class="col-lg-2 custom-background">
        </div>
    </div><!-- end row -->
    <script>
    $(document).ready( function () {
        var message = "<?php echo $message;?>";
        console.log(message);
        if(message == "Fail") {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>강좌에서 방출되거나 등록되지 않은 강좌입니다.</p>');
            $("#alert-modal-button").empty();
            $("#alert-modal-button").append('<button type="button" class="btn btn-light" style="padding:0.375rem 0.75rem;" onclick="reloadClass()"> OK</button>');
            $("#alert-modal").modal('show');
        } else if(message == "Delete") {
            $("#modal-content4").empty();
            $("#modal-content4").append('<p>삭제된 강좌입니다.</p>');
            $("#alert-modal-button").empty();
            $("#alert-modal-button").append('<button type="button" class="btn btn-light" style="padding:0.375rem 0.75rem;" onclick="reloadClass()"> OK</button>');
            $("#alert-modal").modal('show');
        }
    });
    function reloadClass() {
        location.href = "/MyClass";
    }
    </script>
@endsection

