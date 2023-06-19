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
                            A new verification link has been sent to the email address you provided during registration.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif   
                    </div>
                        
                    <div class="card ">
                        <form method="POST" action="{{ route('verification.send') }}" class="mt-5 card__form">
                            @csrf
                            <div>
                                <button type="submit" class="mt-4 btn btn-primary">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>
            
                        <form method="POST" action="{{ route('logout') }}" class="mt-5 card__form">
                            @csrf
                            <button type="submit" class="mt-4 btn btn-primary">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
</body>
</html>