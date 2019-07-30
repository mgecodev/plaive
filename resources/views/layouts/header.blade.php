<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbars-host">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="index.html">소식</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">클래스</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">나의 데이터</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-a">
                        <a class="dropdown-item" href="course-grid-2.html">디바이스 등록</a>
                        <a class="dropdown-item" href="course-grid-3.html">미세먼지</a>
                        <a class="dropdown-item" href="course-grid-4.html">자율주행자동차</a>
                    </div>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">로그아웃</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#login">로그인/회원가입</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">로그인</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">회원가입</a></li>
                        @endif --}}
                    @endauth
                @endif
            </ul>
            {{-- <ul class="nav navbar-nav navbar-right">
                <li><a class="hover-btn-new log orange" href="#" data-toggle="modal" data-target="#login"><span>로그인/회원가입</span></a></li>
            </ul> --}}
        </div>
    </div>
</nav>
