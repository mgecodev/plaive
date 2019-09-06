<!-- ALL JS FILES -->
<script src="/js/all.js"></script>

@if (session('status'))
    @if(Request::path() !== 'home')
        <script type="text/javascript">
            $(function () {
                $('#login').modal('show');
                $('.nav-tabs a[href="#RequestPassword"]').tab('show');
            });
        </script>
    @endif
@endif

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header tit-up">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Customer Login</h4>
            </div>
            <div class="modal-body customer-box">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li><a class="active" href="#Login" data-toggle="tab">로그인</a></li>
                    <li><a href="#Registration" data-toggle="tab">회원가입</a></li>
                    <li><a href="#RequestPassword" data-toggle="tab">{{ __('비밀번호 찾기') }}</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="Login">
                        <form method="POST" role="form" class="form-horizontal" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="E-mail" id="email1" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="password" id="password1" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-light btn-radius btn-brd grd1">
                                        {{ __('로그인') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        {{-- <a class="for-pwd" href="{{ route('password.request') }}">
                                            {{ __('비밀번호를 잊어버리셨나요?') }}
                                        </a> --}}
                                        ​
                                        {{-- <a class="for-pwd" href="#RequestPassword" data-toggle="tab">
                                            {{ __('비밀번호를 잊어버리셨나요?') }}
                                        </a> --}}
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="Registration">
                        <form method="POST" role="form" class="form-horizontal" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="name" id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="email" id="email2" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="password" id="password2" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input placeholder="password-confirm" id="password-confirm2" type="password"
                                           class="form-control" name="password_confirmation" required
                                           autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <select id="AccountType" class="form-control"  name="AccountTypeId" value="select" required>
                                        <option value="" selected disabled hidden>Select</option>
                                        <option value="1">Student</option>
                                        <option value="2">Teacher</option>
                                        <option value="3">Parent</option>
                                        <option value="4">Government</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-10">
                                    <button type="submit" class="btn btn-light btn-radius btn-brd grd1">
                                        {{ __('확인') }}
                                    </button>
                                    <button type="button" class="btn btn-light btn-radius btn-brd grd1"
                                            data-dismiss="modal">
                                        {{ __('취소') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="RequestPassword">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert" id="sentemail">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="e-mail address" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-10">
                                    <div class="col-md-6 offset-md-4">
                                        <button id="reset" type="submit" class="btn btn-light btn-radius btn-brd grd1">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
