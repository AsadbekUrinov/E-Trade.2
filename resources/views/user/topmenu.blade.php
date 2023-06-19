<?php
if (Auth::user()->dashboard_style == "light") {
    $bgmenu="blue";
    $bg="light";
    $text = "dark";
} else {
    $bgmenu="dark";
    $bg="dark";
    $text = "light";
}

?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="{{$bgmenu}}">
        <a href="/" class="logo" style="font-size: 27px; color:#fff;">
            {{$settings->site_name}}
        </a>
        <button class="ml-auto navbar-toggler sidenav-toggler" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="{{$bgmenu}}">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item hidden-caret">
                    <form action="javascript:void(0)" method="post" id="styleform" class="form-inline">
                        <div class="form-group">
                            <label class="style_switch">
                                <input name="style" id="style" type="checkbox" value="true" class="modes">
                                <span class="slider round"></span>
                            </label>
                        </div> 
                        @if(Auth::user()->dashboard_style =='dark')
                        <script>document.getElementById("style").checked= true;</script>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </li>
                @if($settings->google_translate =='on')
                <li class="nav-item hidden-caret">
                    <div id="google_translate_element"></div>
                </li>
                @endif
                
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        
                        
                        <li>
                            <a class="see-all" href="{{ url('dashboard/notification') }}">See all notifications<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
                @if($settings->enable_kyc =="yes")
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i><strong style="font-size:8px;">KYC</strong>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="mb-1 title">KYC verification</span>
                            @if(Auth::user()->account_verify=='yes')	
                            <span class="subtitle op-8">
                             <a href="#" class="p-0 col-12" ><i class="glyphicon glyphicon-ok"></i> KYC status: Account verified</a>
                            </span>
                            @else
                           <span class="subtitle op-8"><a>KYC status: {{Auth::user()->account_verify}}</a></span>
                            @endif
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="m-0 row">
                                @if(Auth::user()->account_verify !='yes')
                                <a href="{{route('account.verify')}}" class="btn btn-success">Verify Account </a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <a class="dropdown-item" href="{{ url('dashboard/changepassword') }}">Change Password</a>
                                <a class="dropdown-item" href="{{ url('dashboard/profile') }}">Account Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                    </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form> 
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
<script type="text/javascript">
    $("#styleform").on('change',function(){
    $.ajax({
        url: "{{url('/dashboard/changetheme')}}",
        type: 'POST',
        data:$("#styleform").serialize(),
        success: function (data) {
            location.reload(true);
        },
        error: function (data) {
            console.log('Something went wrong');
        },

    });
});
</script>