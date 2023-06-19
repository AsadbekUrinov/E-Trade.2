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
					<h1 class="title1 text-{{$text}}">Transactions on your account</h1>
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
					<div class="col text-center card p-4 bg-{{$bg}}">
					    
					        <nav>
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
		
								  <h4 class="pt-3 nav-item nav-link active " id="nav-home-tab" data-toggle="tab" href="#1" role="tab" aria-controls="nav-home" aria-selected="true"> Deposits</h4>
		
								  <h4 class="pt-3 nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#2" role="tab" aria-controls="nav-profile" aria-selected="false">Withdrawals</h4>
		
								  <h4 class="pt-3 nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#3" role="tab" aria-controls="nav-contact" aria-selected="false">Others</h4>
							    </div>
							</nav>
							
							<div class="px-3 py-3 tab-content px-sm-0" id="nav-tabContent">
		
								{{-- This is the first Tab content --}}
								<div class="tab-pane fade show active bg-{{$bg}} card p-3" id="1" role="tabpanel" aria-labelledby="nav-home-tab">
									<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
        							<table id="UserTable" class="UserTable table table-hover text-{{$text}}"> 
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
		
								{{-- This is the second Tab Content --}}
								<div class="tab-pane fade p-3 bg-{{$bg}}" id="2" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
        							<table id="UserTable" class="UserTable table table-hover text-{{$text}}"> 
        									<thead> 
        										<tr> 
        											<th>ID</th> 
        											<th>Amount requested</th>
        											<th>Amount + charges</th>
        											<th>Recieving mode</th>
        											<th>Status</th> 
        											<th>Date created</th>
        										</tr> 
        									</thead> 
        									<tbody> 
        										@foreach($withdrawals as $withdrawal)
        										<tr> 
        											<th scope="row">{{$withdrawal->id}}</th>
        											<td>{{$settings->currency}}{{$withdrawal->amount}}</td>
        											<td>{{$withdrawal->to_deduct}}</td> 
        											<td>{{$withdrawal->payment_mode}}</td> 
        											<td>{{$withdrawal->status}}</td> 
        											<td>{{\Carbon\Carbon::parse($withdrawal->created_at)->toDayDateTimeString()}}</td> 
        										</tr> 
        										@endforeach
        									</tbody> 
        								</table>
        							</div>
								</div>
		
								{{-- This is the Third Tab Content --}}
								<div class="tab-pane fade p-3 bg-{{$bg}}" id="3" role="tabpanel" aria-labelledby="nav-contact-tab">
									<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
        								<table id="UserTable" class="UserTable table table-hover text-{{$text}}"> 
        									<thead> 
        										<tr> 
        											<th>ID</th> 
        											<th>Amount</th>
        											<th>Type</th>
        											<th>Plan/Narration</th>
        											<th>Date created</th>
        										</tr> 
        									</thead> 
        									<tbody> 
        									@foreach($t_history as $history)
        										<tr> 
        											<th scope="row">{{$history->id}}</th>
        											<td>{{$settings->currency}}{{$history->amount}}</td> 
        											<td>{{$history->type}}</td> 
        											<td>{{$history->plan}}</td> 
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
				</div>
			</div>
			@include('user.modals')	
	@endsection
	