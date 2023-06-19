@include('home.assetss')

<body class="d-flex flex-column h-100 auth-page">
    <!-- ======= Loginup Section ======= -->
    <section class="auth">
        <div class="container">
            <div class="row justify-content-center user-auth">
                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6 ">
                    <div class="text-center">
                        @if(Session::has('message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
                        <h1 class="mt-3 text-center">Password Reset</h1>
                        <form method="POST" action="{{ route('password.email') }}" class="mt-5 card__form">
                            {{csrf_field()}} 
                            
                            <div class="form-group ">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <small>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</small> <br>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" name ="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required>
                            </div>

                            <div class="form-group">
                                <button class="mt-4 btn btn-primary" type="submit" >Email Password Reset Link</button>
                            </div>
                            <div class="mb-3 text-center">
                                <small class="mb-2 text-center "> <a href="{{route('login')}}">Repeat Login.</a> </small>
                            </div>

                            <div class="text-center">
                                <hr>
                                <small class="text-center ">&copy; Copyright  {{date('Y')}} &nbsp; {{$settings->site_name}} <br> All Rights Reserved.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</body>
</html>