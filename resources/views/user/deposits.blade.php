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
					<h1 class="title1 text-{{$text}}">Your deposits</h1>
					</div>
					@if(Session::has('message'))
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-success alert-dismissable">
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
					<div class="row py-3 mb-4">
						<div class="col">
							<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#depositModal"><i class="fa fa-plus"></i> New deposit</a>
						</div>
					</div>
					<div class="row mb-5">
					<div class="col text-center card p-4 bg-{{$bg}}">
							<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
							<table  class="UserTable table table-hover text-{{$text}}"> 
									<thead> 
										<tr> 
											<th>ID</th> 
											<th>Amount</th>
											<th>Payment mode</th>
											<th>Status</th> 
											<th>Date created</th>
										</tr> 
									</thead> 
									<tbody> 
										@foreach($deposits as $deposit)
										<tr> 
											<th scope="row">{{$deposit->id}}</th>
											<td>{{$settings->currency}}{{$deposit->amount}}</td> 
											<td>{{$deposit->payment_mode}}</td> 
											<td>{{$deposit->status}}</td> 
											<td>{{\Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString()}}</td> 
										</tr> 
										@endforeach
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('user.modals')	
	@endsection
	