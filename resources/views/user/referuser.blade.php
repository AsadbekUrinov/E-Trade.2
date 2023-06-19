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
@extends('layouts.app')
    @section('content')
        @include('user.topmenu')
        @include('user.sidebar')
        @inject('uc', 'App\Http\Controllers\UsersController')
        <?php
        $array = \App\Models\User::all();
        $usr = Auth::user()->id;
        ?>
        <div class="main-panel bg-{{$bg}}">
            <div class="content bg-{{$bg}}">
                <div class="page-inner">
                    <div class="mt-2 mb-4">
                        <h1 class="title1 text-{{$text}}">Refer users to {{$settings->site_name}} community</h1>
                    </div>
                    @if(Session::has('message'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i> {{Session::get('message')}}
                            </div>
                        </div>
                    </div>
                    @endif
        
                    @if(count($errors) > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable" role="alert" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                @foreach ($errors->all() as $error)
                                <i class="fa fa-warning"></i> {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-12 text-center card bg-{{$bg}} shadow-lg p-3 text-{{$text}}">
                            <strong>You can refer users by sharing your referral link:</strong><br>
                            <h4 style="color:green;"> {{Auth::user()->ref_link}}</h4> <br>
                            <h3 class="title1">
                            <small>Your sponsor</small><br>
                            <i class="fa fa-user fa-2x"></i><br>
                            <small>{{$uc->getUserParent($usr)}}</small>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col card p-3 shadow-lg bg-{{$bg}}">
                            <h2 class="title1 text-{{$text}}">Your Referrals.</h2>
                            <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
                                <table class="table UserTable table-hover text-{{$text}}"> 
                                    <thead> 
                                        <tr> 
                                            <th>Client name</th>
                                            <th>Ref. level</th>
                                            <th>Parent</th>
                                            <th>Client status</th>
                                            <th>Date registered</th>
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        {!! $uc->getdownlines($array,$usr) !!}
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection