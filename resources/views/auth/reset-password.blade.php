@include('home.assetss')

<body class="d-flex flex-column h-100 auth-page">
    <!-- ======= Reset Password ======= -->
    <section class="auth">
        <div class="container">
            <div class="row justify-content-center user-auth">
                <div class="col-12 col-md-8 col-sm-10 col-xl-6 ">
                    <div class="text-center">
                        @if(Session::has('message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        @endif

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        @endif   
                    </div>
                         
                    <div class="card ">
                        <h1 class="mt-3 text-center">Create new password</h1>
                        <form method="POST" action="{{ route('password.update') }}" class="mt-5 card__form">
                            {{csrf_field()}} 
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} ">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <label for="email">Email address</label>
                                
                                <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" name ="email" value="{{ $email or old('email') }}"  id="email" placeholder="name@example.com" required>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <label for="password">Password</label>
                                <input type="password" class="form-control"name="password" id="password" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                                <label for="password-confirm">Password Confirmation</label>
                                <input type="password" class="form-control"name="password_confirmation" id="password-confirm" placeholder="Enter Password" required>
                            </div>
                            
                            <div class="form-group">
                                <button class="mt-4 btn btn-primary" type="submit">Reset Password</button>
                            </div>
    
                            <div class="text-center">
                                <hr>
                                <small class="text-center ">&copy; Copyright  {{date('Y')}} &nbsp; {{$settings->site_name}} &nbsp; All Rights Reserved.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</body>
</html>
