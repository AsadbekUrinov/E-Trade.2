<?php
if (Auth('admin')->User()->dashboard_style == "light") {
    $bg="light";
    $text = "dark";
} else {
    $bg="dark";
    $text = "light";
}

?>
@extends('layouts.app')
    @section('content')
        @include('admin.topmenu')
        @include('admin.sidebar')
        <div class="main-panel">
        <div class="content bg-{{$bg}}">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h2 class="text-{{$text}} pb-2">Welcome, {{ Auth('admin')->User()->firstName }} {{ Auth('admin')->User()->lastName }}!</h2>
                    <h5 id="ann" class="text-{{$text}} op-7 mb-4">{{$settings->update}}</h5>
                    
                </div>
                @if(Session::has('message'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
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
                <!-- Beginning of  Dashboard Stats  -->
                <div class="row row-card-no-pd bg-{{$bg}} shadow-lg">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-download text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Deposit</p>
                                            @foreach($total_deposited as $deposited)
                                            @if(!empty($deposited->count))
                                            {{$settings->currency}}{{$deposited->count}}
                                            @else
                                            {{$settings->currency}}0.00
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-download text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending Deposit(s)</p>
                                            @foreach($pending_deposited as $deposited)
                                            @if(!empty($deposited->count))
                                            {{$settings->currency}}{{$deposited->count}}
                                            @else
                                            {{$settings->currency}}0.00
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-arrows-1 text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Withdrawal</p>
                                            @foreach($total_withdrawn as $deposited)
                                            @if(!empty($deposited->count))
                                            {{$settings->currency}}{{$deposited->count}}
                                            @else
                                            {{$settings->currency}}0.00
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-arrow text-secondary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending Withdrawal</p>
                                            @foreach($pending_withdrawn as $deposited)
                                            @if(!empty($deposited->count))
                                            {{$settings->currency}}{{$deposited->count}}
                                            @else
                                            {{$settings->currency}}0.00
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-users text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Users</p>
                                            <h4 class="card-title text-{{$text}}">{{$user_count}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-remove-user text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Block Users</p>
                                            <h4 class="card-title text-{{$text}}">{{$blockeusers}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{$bg}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-user-2 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Active Users</p>
                                            <h4 class="card-title text-{{$text}}">{{$activeusers}}</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round bg-{{Auth('admin')->User()->dashboard_style}}">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-diagram text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Investment Plans</p>
                                            <h4 class="card-title text-{{$text}}">{{$plans}}</h4> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection