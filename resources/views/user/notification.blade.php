<?php
	if (Auth::user()->dashboard_style == "light") {
		$bg="light";
		$text = "dark";
	} else {
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
					<h1 class="title1 text-{{$text}}">Notification</h1>
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
						<div class="col card bg-{{$bg}} shadow-lg">
							<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
								<table class="table table-hover  text-{{$text}}"> 
									<thead> 
										<tr> 
											<th>Message</th>
											<th>Recieve Date</th>
											<th>Option</th>
										</tr> 
									</thead> 
									<tbody> 
										@foreach($Notif as $notification)
										<tr> 
											<td> <a href="#" data-toggle="modal" data-target="#message{{$notification->id}}" class=" "> {{ substr($notification->message,0,85)}} </a> </td> 
											<td> {{\Carbon\Carbon::parse($notification->created_at)->toDayDateTimeString()}}</td> 
											<td> <a href="{{ url('dashboard/delnotif') }}/{{$notification->id}}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a> 
											</td>
										</tr> 
		
										<div id="message{{$notification->id}}" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
													<div class="modal-header .modal-dialog-centered bg-{{$bg}}">
														<button type="button" class="close  text-{{$text}}" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body bg-{{$bg}}">
														<div class="font-italic">
															<p class="text-{{$text}}">{{$notification->message}}</p>
														</div>
													</div>
													</div>
												</div>
												</div>
										@endforeach
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
				
    @endsection