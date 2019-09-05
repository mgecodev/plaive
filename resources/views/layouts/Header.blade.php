<?php
$home_active = '';
$class_active = '';
$my_active = '';
$board_active = '';
$host_explode = explode($_SERVER['HTTP_HOST'], url()->full());
$route_name = $host_explode[1];
$detail_host = explode('/', $host_explode[1]);

if ($route_name == '/' || $route_name == '/home') {
    $home_active = 'active';
} else if ($route_name == '/ManageClass' || $route_name == '/OpenClass' || $route_name == '/ClassBoard' || $route_name == '/ManageCourse') {
    $class_active = 'active';
} else if ($route_name == '/ManageDevice' || $route_name == '/CreateDevice') {
    $my_active = 'active';
} else if ($route_name == '/MainBoard') {
    $board_active = 'active';
} else if (count($detail_host) > 1) {
    if ($detail_host[1] == 'EditDevice' || $detail_host[1] == 'ShowData') {
        $my_active = 'active';
    } else if ($detail_host[1] == 'ShowBoard') {
        if ($detail_host[2] == 'All') {
            $board_active = 'active';
        } else {
            $class_active = 'active';
        }
    } else if ($detail_host[1] == 'Class') {
        $class_active = 'active';
    } else if ($detail_host[1] == 'EnrollCourseDetail') {
        $class_active = 'active';
    } else if ($detail_host[1] == 'EditBoard') {
        if ($detail_host[2] == 'Class') {
            $class_active = 'active';
        } else if ($detail_host[2] == 'All') {
            $board_active = 'active';
        }
    } else if ($detail_host[1] == 'ReadCourseDetail') {
        $class_active = 'active';
    }
}
?>

<style>
    .top-navbar, .navbar-light {
        background-color: #3c3c3b !important;
    }

    .top-navbar .navbar-light .navbar-nav .nav-item.active .nav-link {
        color: #28b8ce !important;
    }

    .fontsize-header {
        font-size: 20px !important;
    }
</style>

<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ asset('/home') }}">
                <img src="{{ asset('images/logo.png') }}" alt=""/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-host">
                <ul class="navbar-nav ml-auto">

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item {{ $home_active }}"><a class="nav-link fontsize-header"
                                                                       href="{{ asset('/home') }}">홈</a></li>
                            <li class="nav-item {{ $board_active }}"><a class="nav-link fontsize-header"
                                                                        href="{{ asset('/MainBoard') }}">소식</a></li>
                            <li class="nav-item dropdown {{ $my_active }}">
                                <a class="nav-link dropdown-toggle fontsize-header" href="#" id="dropdown-a"
                                   data-toggle="dropdown">나의 데이터</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                    <a class="dropdown-item" href="{{ asset('/CreateDevice') }}">디바이스 등록</a>
                                    <a class="dropdown-item" href="{{ asset('/ManageDevice') }}">디바이스 리스트</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item {{ $home_active }}"><a class="nav-link fontsize-header" href="#"
                                                                       data-toggle="modal" data-target="#login">홈</a></li>
                            <li class="nav-item {{ $board_active }}"><a class="nav-link fontsize-header" href="#"
                                                                        data-toggle="modal" data-target="#login">소식</a></li>
                        @endauth
                    @endif

                    @if (isset($type) && $type == 'Teacher')
                        <li class="nav-item dropdown {{ $class_active }}">
                            <a class="nav-link dropdown-toggle fontsize-header" href="#" id="dropdown-a"
                               data-toggle="dropdown">클래스</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="{{ asset('/ManageClass') }}">클래스 관리</a>
                                <a class="dropdown-item" href="{{ asset('/ManageCourse') }}">강좌 관리</a>
                            </div>
                        </li>
                    @elseif (isset($type) && $type == 'Student')
                        <li class="nav-item dropdown {{ $class_active }}">
                            <a class="nav-link dropdown-toggle fontsize-header" href="#" id="dropdown-a"
                               data-toggle="dropdown">클래스</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="{{ asset('/MyClass') }}">나의 클래스</a>
                                <a class="dropdown-item" href="{{ asset('/CheckInvitation') }}">알람 확인하기</a>
                            </div>
                        </li>
                    @else
                    @endif


                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fontsize-header" href="#" id="dropdown-a"
                                   data-toggle="dropdown">
                                    @if ($type != NULL && $name != NULL)
                                        {{ $name." ".$type }}
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                    <a class="dropdown-item" href="{{ route('logout') }}">로그아웃</a>
                                </div>
                            </li>
                            <div class="user-notification">
                                <div class="dropdown">
                                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        <span class="badge notification-active"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="notification-list mx-h-350 customscroll">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed...</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="vendors/images/img.jpg" alt="">
                                                        <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed...</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="vendors/images/img.jpg" alt="">
                                                        <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed...</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <li class="nav-item"><a class="nav-link fontsize-header" href="#" data-toggle="modal"
                                                    data-target="#login">로그인/회원가입</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
