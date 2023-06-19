@include('home.assetss')

<body class="d-flex flex-column h-100 auth-page">
    <!-- ======= Loginup Section ======= -->
    <section class="auth">
        <div class="container">
            <div class="row justify-content-center user-auth">
                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6 ">
                    <div class="mb-4 text-center">
                       
                        <a href="{{url('/')}}" >{{$settings->site_name}}</a>
                            @if(Session::has('status'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                             @endif
                             @if ($errors->any())
                                <div class="alert alert-danger">
                                    <button type="button" class="text-white close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                   
                                </div>
                            @endif
                    </div>
                    
                    <div class="card ">
                        <h1 class="mt-3 text-center"> User Login</h1>
                        <form method="POST" action="{{ route('login') }}" class="mt-5 card__form">
                           @csrf
                            <div class="form-group ">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name ="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>
                            
                            <div class="form-group">
                                <button class="mt-4 btn btn-primary" type="submit">Login</button>
                            </div>
    
                            <div class="mb-3 text-center">
                                <small class="mb-2 text-center ">Forget your Password <a href="{{ route('password.request') }}" class="ml-1 link">Reset.</a> </small>
                                <small class="text-center ">Dont have an Account yet? <a href="{{route('register')}}" class="ml-1 link">Sign up.</a> </small>
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
