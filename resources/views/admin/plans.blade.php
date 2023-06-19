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
						<h1 class="title1 text-{{$text}}">Available Plans</h1>
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
						<div class="mt-2 col-lg-12">
							<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#plansModal"><i class="fa fa-plus"></i> New plan</a> <br> <br>
						</div>
						@foreach($plans as $plan)
						<div class="col-lg-4 p-3 card bg-{{Auth('admin')->User()->dashboard_style}}">
							<div class="pricing-table purple border bg-{{Auth('admin')->User()->dashboard_style}} shadow-lg">
								<!-- Table Head -->
								<div class="pricing-label d-inline">Plan Name</div>
								<h2 class="text-{{$text}}">{{$plan->name}}</h2>
								<!-- Price -->
								<div class="price-tag">
									<span class="symbol text-{{$text}}">{{$settings->currency}}</span>
									<span class="amount text-{{$text}}">{{$plan->price}}</span>
								</div>
								<!-- Features -->
								<div class="pricing-features">
									<div class="feature text-{{$text}}">Minimum Possible Deposit:<span class="text-{{$text}}">{{$settings->currency}}{{$plan->min_price}}</span></div>
									<div class="feature text-{{$text}}">Maximum Possible Deposit:<span  class="text-{{$text}}">{{$settings->currency}}{{$plan->max_price}}</span></div>
									<div class="feature text-{{$text}}">Minimum Return:<span class="text-{{$text}}">{{$settings->currency}}{{$plan->minr}}</span></div>
									<div class="feature text-{{$text}}">Maximum Return:<span class="text-{{$text}}">{{$settings->currency}}{{$plan->maxr}}</span></div>
									<div class="feature text-{{$text}}">Gift Bonus:<span class="text-{{$text}}">{{$settings->currency}}{{$plan->gift}}</span></div>
									<div class="feature text-{{$text}}">Duration:<span class="text-{{$text}}">{{$plan->expiration}}</span></div>
								</div> <br>
								
								<!-- Button -->
								<div class="text-center">
									<a href="#" data-toggle="modal" data-target="#editplansModal{{$plan->id}}" class="btn btn-primary"><i class="text-white flaticon-pencil"></i></a> &nbsp; 
								<a href="{{ url('admin/dashboard/trashplan') }}/{{$plan->id}}" class="btn btn-danger"><i class="text-white fa fa-times"></i></a>
								</div>
								
							</div>
						  
							<!-- Edit plan modal -->
							<div id="editplansModal{{$plan->id}}" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content bg-{{Auth('admin')->User()->dashboard_style}}">
										<div class="modal-header ">
											<h4 class="modal-title text-{{$text}}">Update plan / package</h4>
											<button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form role="form" method="post" action="{{ route('updateplan') }}">
												<h5 class="text-{{$text}}">Plan Name</h5>   
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->name}}" type="text" name="name" required><br/>
												<h5 class="text-{{$text}}">Plan price</h5> 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->price}}" type="text" name="price" required><br/>
												<h5 class="text-{{$text}}">Plan Minimum Price</h5> 	 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->min_price}}" type="text" name="min_price" required><br/>
												<h5 class="text-{{$text}}">Plan Maximum Price</h5> 	 	 
												<input style="padding:5px;" class="form-control  text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->max_price}}" type="text" name="max_price" required><br/>
												<h5 class="text-{{$text}}"> Minimum Return</h5> 	 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->minr}}" placeholder="Enter minimum return" type="text" name="minr" required><br/>
												<h5 class="text-{{$text}}"> Maximum Return</h5> 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->maxr}}"  placeholder="Enter maximum return" type="text" name="maxr" required><br/>
												<h5 class="text-{{$text}}"> Gift Bonus</h5> 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->gift}}"  placeholder="Enter Additional Gift Bonus" type="text" name="gift" required><br/>
												<h5 class="text-{{$text}}">Top Up Interval</h5> 
												<select class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" name="t_interval">
													<option>{{$plan->increment_interval}}</option>
													<option>Monthly</option>
													<option>Weekly</option>
													<option>Daily</option>
													<option>Hourly</option>
												</select><br>
												<h5 class="text-{{$text}}">Top Up Type</h5> 
												<select class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" name="t_type">
													<option>{{$plan->increment_type}}</option>
													<option>Percentage</option>
													<option>Fixed</option>
												</select><br>
												<h5 class="text-{{$text}}">Top up Amount (in % or $ as specified above)</h5> 
												<input style="padding:5px;" class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" value="{{$plan->increment_amount}}" placeholder="top up amount" type="text" name="t_amount" required><br/>
												<h5 class="text-{{$text}}">Investment duration</h5> 
												<select class="form-control text-{{$text}} bg-{{Auth('admin')->User()->dashboard_style}}" name="expiration">
													<option>{{$plan->expiration}}</option>
													<option>One week</option>
													<option>One month</option>
													<option>Three months</option>
													<option>Six months</option>
													<option>One year</option>
												</select><br>
												<input type="hidden" name="id" value="{{ $plan->id }}">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="submit" class="btn btn-primary" value="Update">
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- /edit plans Modal -->
						</div>
						@endforeach
					</div>
				</div>
			</div>
		@include('admin.includes.modals')
	@endsection