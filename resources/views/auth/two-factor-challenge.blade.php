@include('home.assetss')

<body class="d-flex flex-column h-100 auth-page">
    <!-- ======= Loginup Section ======= -->
    <div x-data="{ recovery: false }">
        
        <section class="auth">
            <div class="container">
                <div class="row justify-content-center user-auth">
                    <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6 ">
                        <div class="mb-4 text-center">
                            <a href="{{url('/')}}" ><img class="auth__logo img-fluid" 
                                src="{{ $settings->site_address}}/cloud/app/images/{{$settings->logo}}" alt="{{$settings->site_name}}"> 
                            </a>
                        </div>
                        
                        <div class="card ">
                            <div class="mb-4 text-center">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="mb-4 text-sm text-center text-dark" x-show="! recovery">
                                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                                </div>
                        
                                <div class="mb-4 text-sm text-center text-dark" x-show="recovery">
                                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                                </div>
                            </div>
                            <form method="POST" action="{{ route('two-factor.login') }}" class="mt-5 card__form">
                                @csrf
                
                                <div class="mt-4" x-show="! recovery">
                                    <label for="code">{{ __('Code') }}</label>
                                    <input id="code" type="text" inputmode="numeric" class="form-control" name="code" autofocus x-ref="code" autocomplete="one-time-code">
                                </div>
                
                                <div class="mt-4" x-show="recovery">
                                    <label for="recovery_code" >{{ __('Recovery Code') }}</label>
                                    <input id="recovery_code" class="block w-full mt-1 form-control" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code">
                                </div>
                
                                <div class="flex items-center justify-end mt-4 text-center">

                                    <button type="button" class="text-sm text-gray-600 underline cursor-pointer hover:text-gray-900"
                                                    x-show="! recovery"
                                                    x-on:click="
                                                        recovery = true;
                                                        $nextTick(() => { $refs.recovery_code.focus() })
                                                    ">
                                        {{ __('Use a recovery code') }}
                                    </button>
                
                                    <button type="button" class="mt-4 btn btn-primary"
                                                    x-show="recovery"
                                                    x-on:click="
                                                        recovery = false;
                                                        $nextTick(() => { $refs.code.focus() })
                                                    ">
                                        {{ __('Use an authentication code') }}
                                    </button>
                
                                    <x-jet-button class="mt-4 btn btn-primary">
                                        {{ __('Log in') }}
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </section>
        
    </div>
    </body>
</html>
