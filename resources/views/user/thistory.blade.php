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
						<h1 class="title1 text-{{$text}}">Your ROI history</h1>
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
					<div class="row mb-5">
						<div class="col text-center card shadow-lg bg-{{$bg}} p-3">
							<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
								<table id="UserTable" class="UserTable table table-hover text-{{$text}}"> 
									<thead> 
										<tr> 
											<th>ID</th> 
											<th>Plan</th>
											<th>Amount</th>
											<th>Type</th>
											<th>Date created</th>
										</tr> 
									</thead> 
									<tbody> 
									@foreach($t_history as $history)
										<tr> 
											<th scope="row">{{$history->id}}</th>
											<td>{{$history->plan}}</td> 
											<td>{{$settings->currency}}{{$history->amount}}</td> 
											<td>{{$history->type}}</td> 
											<td>{{\Carbon\Carbon::parse($history->created_at)->toDayDateTimeString()}}</td> 
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