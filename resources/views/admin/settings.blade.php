<?php
if (Auth('admin')->User()->dashboard_style == "light") {
    $text = "dark";
} else {
    $text = "light";
}
?>
@extends('layouts.app')
    @section('content')
        @include('admin.topmenu')
        @include('admin.sidebar')
        <div class="main-panel bg-{{Auth('admin')->User()->dashboard_style}}">
			<div class="content bg-{{Auth('admin')->User()->dashboard_style}}">
				<div class="page-inner">
					<div class="mt-2 mb-4">
						<h1 class="title1 text-{{$text}}">System Settings</h1>
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
					<div class="row mb-5">
						<div class="col card p-3 bg-{{Auth('admin')->User()->dashboard_style}}">
							<nav>
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
		
								  <a class="nav-item nav-link active pt-3 " id="nav-home-tab" data-toggle="tab" href="#1" role="tab" aria-controls="nav-home" aria-selected="true"> Website Information</a>
		
								  <a class="nav-item nav-link pt-3" id="nav-profile-tab" data-toggle="tab" href="#2" role="tab" aria-controls="nav-profile" aria-selected="false">Website Settings/Preference</a>
		
								  <a class="nav-item nav-link pt-3" id="nav-about-tab" data-toggle="tab" href="#4" role="tab" aria-controls="nav-about" aria-selected="false">Bonus/Ref. commission</a>
		
								  <a class="nav-item nav-link pt-3" id="nav-contact-tab" data-toggle="tab" href="#5" role="tab" aria-controls="nav-contact" aria-selected="false">Payment/Settings</a>
		
								  <a class="nav-item nav-link pt-3" id="nav-about-tab" data-toggle="tab" href="#6" role="tab" aria-controls="nav-about" aria-selected="false">Subscription Fees</a>
		
								  {{-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#7" role="tab" aria-controls="nav-contact" aria-selected="false">Investment</a> --}}
		
								  {{-- <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#8" role="tab" aria-controls="nav-about" aria-selected="false">Live Trading</a> --}}
		
								</div>
							</nav>
		
		
							<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		
								{{-- This is the first Tab content --}}
								<div class="tab-pane fade show active bg-{{Auth('admin')->User()->dashboard_style}} card p-3" id="1" role="tabpanel" aria-labelledby="nav-home-tab">
									@include('admin.includes.webinfo')
								</div>
		
								{{-- This is the second Tab Content --}}
								<div class="tab-pane fade p-3 bg-{{Auth('admin')->User()->dashboard_style}}" id="2" role="tabpanel" aria-labelledby="nav-profile-tab">
									@include('admin.includes.websettings')
								</div>
		
								{{-- This is the Fouth Tab Content --}}
								<div class="tab-pane fade p-3 bg-{{Auth('admin')->User()->dashboard_style}}" id="4" role="tabpanel" aria-labelledby="nav-about-tab">
									@include('admin.includes.bonus')
								</div>
		
								{{-- This is the Fifth Tab Content --}}
								<div class="tab-pane fade p-3 bg-{{Auth('admin')->User()->dashboard_style}}" id="5" role="tabpanel" aria-labelledby="nav-about-tab">
									@include('admin.includes.payments')
								</div>
		
								{{-- This is the Sixth Tab Content --}}
								<div class="tab-pane fade p-4 bg-{{Auth('admin')->User()->dashboard_style}}" id="6" role="tabpanel" aria-labelledby="nav-about-tab">
									@include('admin.includes.subscript')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('admin.includes.modals')
    @endsection