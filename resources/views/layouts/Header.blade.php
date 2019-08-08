<?php
$home_active = '';
$class_active = '';
$my_active = '';
$host_explode = explode($_SERVER['HTTP_HOST'], url()->full());
$route_name = $host_explode[1];
if($route_name == '/' || $route_name == '/home') {
    $home_active = 'active';
} else if($route_name == '/ManageClass' || $route_name == '/OpenClass' || $route_name == '/ClassBoard') {
    $class_active = 'active';
} else if($route_name == '/My') {
    $my_active = 'active';
}
?>
<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ asset('/home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-host">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ $home_active }}"><a class="nav-link" href="{{ asset('/home') }}">소식</a></li>

                    @if ($type == 'Teacher')
                        <li class="nav-item dropdown {{ $class_active }}">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">클래스</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="{{ asset('/ManageClass') }}">클래스 관리</a>
                                <a class="dropdown-item" href="{{ asset('/OpenClass') }}">수업 만들기</a>
                                <a class="dropdown-item" href="{{ asset('/ClassBoard') }}">게시판</a>
                            </div>
                        </li>
                    @else 
                        <li class="nav-item dropdown {{ $class_active }}">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">클래스</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="{{ asset('/ManageClass') }}">수업 입장</a>
                                <a class="dropdown-item" href="{{ asset('/OpenClass') }}">나의 강좌</a>
                                <a class="dropdown-item" href="{{ asset('/CheckInvitation') }}">초대 확인하기</a>
                                <a class="dropdown-item" href="{{ asset('/ClassBoard') }}">게시판</a>
                            </div>
                        </li>
                    @endif
                    
                    <li class="nav-item dropdown {{ $my_active }}">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">나의 데이터</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                        <a class="dropdown-item" href="{{ asset('/ManageDevice') }}">디바이스 등록</a>
                            <a class="dropdown-item" href="course-grid-3.html">미세먼지</a>
                            <a class="dropdown-item" href="course-grid-4.html">자율주행자동차</a>
                        </div>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">
                                    @if ($type != NULL && $name != NULL) 
                                        {{ $name." ".$type }}
                                    @endif 
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                    <a a class="dropdown-item" href="{{ route('logout') }}">로그아웃</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#login">로그인/회원가입</a></li>   
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>