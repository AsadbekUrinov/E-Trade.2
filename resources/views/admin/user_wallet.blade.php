<?php
if (Auth('admin')->User()->dashboard_style == "light") {
    $text = "dark";
    $bg="light";
} else {
    $text = "light";
    $bg="dark";
}
?>
@extends('layouts.app')
    @section('content')
        @include('admin.topmenu')
        @include('admin.sidebar')
        <div class="main-panel">
			<div class="content bg-{{Auth('admin')->User()->dashboard_style}}">
				<div class="page-inner">
					<div class="mt-2 mb-4">
					<h1 class="title1 text-{{$text}}"> {{$user}} Wallet Details</h1>
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
					<div class="mb-5 row">
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
                                                    <p class="card-category">Deposited</p>
                                                    @foreach($deposited as $deposited)
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
                                                    <i class="flaticon-coins text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Profit</p>
                                                    <h4 class="card-title text-{{$text}}">{{$settings->currency}}{{ number_format($roi, 2, '.', ',')}}</h4>
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
                                                    <i class="fa fa-gift text-danger"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Bonus</p>
                                                    <h4 class="card-title text-{{$text}}">{{$settings->currency}} {{ number_format($bonus, 2, '.', ',')}}</h4>
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
                                                    <i class="fa fa-retweet text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Ref. Bonus</p>
                                                    <h4 class="card-title text-{{$text}}">{{$settings->currency}}{{ number_format($ref_bonus, 2, '.', ',')}}</h4>
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
                                                    <i class="flaticon-coins text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">Balance</p>
                                                    <h4 class="card-title text-{{$text}}">{{$settings->currency}}{{ number_format($account_bal, 2, '.', ',')}}</h4> <br>
                                                </div>
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