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
        <div class="main-panel bg-{{$bg}}">
			<div class="content bg-{{$bg}}">
				<div class="page-inner">
					<div class="mt-2 mb-4">
						<h1 class="title1 text-{{$text}}">Account Profile Information</h1>
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
					<div class="row profile">
						
                        <div class="p-2 col-md-8 offset-md-2">
                            <div class="card p-5 shadow-lg bg-{{$bg}}">

                                <form role="form" method="post"action="{{route('userprofile')}}">
                                    <h5 class="text-{{$text}}">Fullname</h5>
                                    <input type="text" name="name" value="{{Auth::user()->name }}" class="form-control bg-{{$bg}} text-{{$text}}"> <br>
                                    <h5 class="text-{{$text}}">Date of Birth</h5>
                                    <input type="date" name="dob" class="form-control bg-{{$bg}} text-{{$text}}" value="{{ Auth::user()->dob }}"> <br>
                                    <h5 class="text-{{$text}}">Phone Number</h5>
                                    <input type="text" name="phone"  class="form-control bg-{{$bg}} text-{{$text}}" value="{{ Auth::user()->phone }}"> <br>
                                    <h5 class="text-{{$text}}">Country</h5>
                                    <input type="text" value="{{Auth::user()->country }}" class="form-control bg-{{$bg}} text-{{$text}}" readonly> <br>
                                    <h5 class="text-{{$text}}">Email</h5>
                                    <input type="text" value="{{Auth::user()->email }}" class="form-control bg-{{$bg}} text-{{$text}}" readonly> <br>
                                    <h5 class="text-{{$text}}">Address</h5>
                                    <textarea class="form-control bg-{{$bg}} text-{{$text}}" placeholder="Full Address" name="address" row="3" value="{{ Auth::user()->address }}">{{ Auth::user()->address }}</textarea><br/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </form>
                                
                                
                                <div class="mt-3">
                                    <a href="{{ route('twofa') }}" class="btn btn-primary">{{ __('Manage Account Security') }}</a>
                                </div>
                            </div>
                        </div>
					</div>
				</div>	
			</div>
	@endsection