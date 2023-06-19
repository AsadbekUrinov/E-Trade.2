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
			<div class="content bg-{{Auth('admin')->User()->dashboard_style}} ">
				<div class="page-inner">
					<div class="mt-2 mb-4">
					<h1 class="title1 text-{{$text}}">Manage clients deposits</h1>
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
						<div class="col-12">
							<small class="text-{{$text}}">if you can't see the image, try switching your uploaded location to another option from your admin settings page.</small>
						</div>
						<div class="col-12 card shadow p-4 bg-{{Auth('admin')->User()->dashboard_style}}">
							<div class="table-responsive" data-example-id="hoverable-table"> 
								<table id="ShipTable" class="table table-hover text-{{$text}}"> 
									<thead> 
										<tr> 
											<th>ID</th> 
											<th>Client name</th>
											<th>Client email</th>
											<th>Amount</th>
											<th>Payment mode</th>
											<th>Plan</th>
											<th>Status</th> 
											<th>Date created</th>
											<th>Option</th>
										</tr> 
									</thead> 
									<tbody> 
										@foreach($deposits as $deposit)
										<tr> 
											<th scope="row">{{$deposit->id}}</th>
											<td>{{$deposit->duser->name}}</td>
											<td>{{$deposit->duser->email}}</td> 
											<td>{{$settings->currency}}{{$deposit->amount}}</td> 
											<td>{{$deposit->payment_mode}}</td>
											@if(isset($deposit->dplan->name)) 
											<td>{{$deposit->dplan->name}}</td>
											@else
											<td>Account funds</td>
											@endif
											<td>{{$deposit->status}}</td> 
											<td>{{\Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString()}}</td> 
											<td> 
											<a href="#" class="btn btn-{{$text}} btn-sm m-1" data-toggle="modal" data-target="#popModal{{$deposit->id}}" title="View payment proof">
												<i class="fa fa-eye"></i>
												</a>
												
												<a href="{{ url('admin/dashboard/deldeposit') }}/{{$deposit->id}}" class="m-1 btn btn-danger btn-sm">Delete</a>
												@if($deposit->status =="Processed") 
												<a class="btn btn-success btn-sm" href="#">Processed</a>
												@else
												<a class="btn btn-primary btn-sm" href="{{ url('admin/dashboard/pdeposit') }}/{{$deposit->id}}">Process</a>
												@endif
											
											</td> 
										</tr> 
										
											<!-- POP Modal -->
									<div id="popModal{{$deposit->id}}" class="modal fade" role="dialog">
									<div class="modal-dialog">
		
										<!-- Modal content-->
										<div class="modal-content">
										<div class="modal-header bg-{{Auth('admin')->User()->dashboard_style}}">
											<h4 class="modal-title text-{{$text}}">{{$deposit->duser->name}} proof of payment</h4>
											<button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body bg-{{Auth('admin')->User()->dashboard_style}}">
											@if ($deposit->payment_mode == "Credit Card" || $deposit->payment_mode == "Paystack" || $deposit->payment_mode == "Express Deposit" || $deposit->payment_mode == "CoinPayments")
												<h4 class="text-{{$text}}">This Payment was either made with credit/debit card, admin topup or automatic crypto payment hence no proof of payment provided</h4>
											@else
												@if ($settings->location == "Email")
												<h3 class="text-{{$text}}">Check your email with the deposit that has an attachment name of 
													<span class="text-danger">{{$deposit->proof}}</span></h3>
												@elseif($settings->location == "Local")
													<img src="{{ asset('storage/app/public/photos/'.$deposit->proof)}}" alt="Payment proof" title="" class="img-fluid" />
												@else
												@php
												$ppath = 'storage/'. $deposit->proof;
												if (Storage::disk('s3')->exists($ppath)) {
													$passurl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
													$passfile = Storage::disk('s3')->get($ppath);
													$psrc = $passurl.$passfile;
												}else {
													$psrc = "";
												}
												@endphp
												<img src="{{$psrc}}" alt="Proof of Payment" title="" class="img-fluid" />	
												
												@endif
											@endif
											      
										</div>
										</div>
									</div>
									</div>
									<!-- /POP Modal -->
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