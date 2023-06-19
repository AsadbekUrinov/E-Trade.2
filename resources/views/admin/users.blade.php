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
        <div class="main-panel">
			<div class="content bg-{{Auth('admin')->User()->dashboard_style}}">
				<div class="page-inner">
					<div class="mt-2 mb-4">
					<h1 class="title1 text-{{$text}}">{{$settings->site_name}} users list</h1>
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
					<div class="row">
						<div class="col">
							<a href="#" data-toggle="modal" data-target="#sendmailModal" class="btn btn-primary btn-lg" style="margin:10px;">Message all</a>
							@if($settings->enable_kyc =="yes")
							<a href="{{ url('admin/dashboard/kyc') }}" class="btn btn-warning btn-lg">KYC</a>
							@endif 
							
						</div>
					</div>
					<div class="mb-5 row">
						<div class="col shadow card p-4 bg-{{Auth('admin')->User()->dashboard_style}}">
							<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
								
								<table id="ShipTable" class="table table-hover text-{{$text}}"> 
									<thead> 
										<tr> 
											<th>ID</th> 
											<th>Balance</th> 
											<th>Client Name</th> 
											<th>Email</th> 
											<th>Phone</th>
											<th>Inv. plan</th>
											<th>Status</th>
											<th>Date registered</th> 
											<th>Action</th> 
										</tr> 
									</thead> 
									<tbody> 
										@foreach($users as $list)
										<tr> 
											<th scope="row">{{$list->id}}</th>
											<td>{{$settings->currency}}{{$list->account_bal}}</td> 
											<td>{{$list->name}}</td> 
											<td>{{$list->email}}</td> 
											<td>{{$list->phone}}</td>
											<td><a class="m-1 btn btn-warning btn-sm" href="{{ url('admin/dashboard/user-plans') }}/{{$list->id}}">Inv. plans</a></td>
											<td>{{$list->status}}</td> 
											<td>{{\Carbon\Carbon::parse($list->created_at)->toDayDateTimeString()}}</td> 
											<td>
												<div class="dropdown">
													<a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Actions
													</a>
												<div class="dropdown-menu bg-{{Auth('admin')->User()->dashboard_style}}" aria-labelledby="dropdownMenuLink">
													<a class="m-1 btn btn-info btn-sm" href="{{ url('admin/dashboard/user-wallet') }}/{{$list->id}}">See Wallet</a>

													@if($list->status==NULL || $list->status=='blocked')
													<a class="m-1 btn btn-primary btn-sm" href="{{ url('admin/dashboard/uunblock') }}/{{$list->id}}">Unblock</a> 
													@else
													<a class="m-1 btn btn-danger btn-sm" href="{{ url('admin/dashboard/uublock') }}/{{$list->id}}">Block</a>
													@endif
													@if($list->trade_mode=='on')
													<a class="m-1 btn btn-danger btn-sm" href="{{ url('admin/dashboard/usertrademode') }}/{{$list->id}}/off">Turn off trade</a> 
													@else
													<a class="m-1 btn btn-primary btn-sm" href="{{ url('admin/dashboard/usertrademode') }}/{{$list->id}}/on">Turn on trade</a>
													@endif
														<a href="#"  data-toggle="modal" data-target="#topupModal{{$list->id}}" class="m-1 btn btn-dark btn-sm">Credit/Debit</a>
														<a href="#" data-toggle="modal" data-target="#resetpswdModal{{$list->id}}"  class="m-1 btn btn-warning btn-sm">Reset Password</a>
														<a href="#" data-toggle="modal" data-target="#clearacctModal{{$list->id}}" class="m-1 btn btn-warning btn-sm">Clear Account</a>
														<a href="#" data-toggle="modal" data-target="#TradingModal{{$list->id}}" class="m-1 btn btn-secondary btn-sm">Add Trading History</a>
														<a href="#" data-toggle="modal" data-target="#deleteModal{{$list->id}}" class="m-1 btn btn-danger btn-sm">Delete</a>
														<a href="#" data-toggle="modal" data-target="#edituser{{$list->id}}" class="m-1 btn btn-secondary btn-sm">Edit</a>
														<a href="#" data-toggle="modal" data-target="#sendmailtooneuserModal{{$list->id}}" class="m-1 btn btn-info btn-sm">Send Message</a>
														<a href="#" data-toggle="modal" data-target="#switchuserModal{{$list->id}}"  class="m-2 btn btn-success btn-sm">Get access</a>
													</div>
												</div>
											</td> 
										</tr> 
										@include('admin.users_actions')
										@endforeach
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		@include('admin.includes.modals')
    @endsection
				