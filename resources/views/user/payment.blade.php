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
@section('styles')
    @parent
	<link rel="stylesheet" href="{{asset('dash/css/stripeglobal.css')}}">
	<link rel="stylesheet" href="{{asset('dash/css/stripenormalize.css')}}">
@endsection

    @section('content')
        @include('user.topmenu')
        @include('user.sidebar')
        <div class="main-panel bg-{{$bg}}">
			<div class="content bg-{{$bg}}">
				<div class="page-inner">
					<div class="mt-2 mb-4">
						<h1 class="title1 text-{{$text}}">Make Payment</h1>
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
								<div class="alert alert-danger alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									@foreach ($errors->all() as $error)
									<i class="fa fa-warning"></i> {{ $error }}
									@endforeach
								</div>
							</div>
						</div>
                	@endif
					<div class="row">
						<div class="col card bg-{{$bg}} shadow-lg p-4">
							@if($title=="Complete Payment")
								<div class="p-5 text-center alert-success">
									<h4 class="text-{{$text}}">You are to send <strong>{{$amount}} {{$coin}}</strong> to the address below or scan the QR code to complete payment.</h4>
									<h4 class="text-{{$text}}"><strong>{{$p_address}}</strong></h4><br>
									<img width="220" height="220" alt="Payment QR code" src="{{$p_qrcode}}">
								</div>
							@elseif($title == "Pay with card")
								<form action="charge" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										data-key="{{$settings->s_p_k}}"
										data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
										data-name="{{$settings->site_name}}"
										data-description="Account fund"
										data-amount="{{$t_p}}"
										data-locale="auto">
									</script>
								</form>
							@else
							<div class="mb-3 text-{{$text}}">
								<h4>You are to make payment of <strong>{{$settings->currency}}{{$amount}}</strong> using your preferred mode of payment below. Screenshot the proof of payment</h4>
								<?php 
									$pmodes = str_split($settings->payment_mode);
								?>
							</div>
							<div class="row">
								@foreach($pmodes as $pmode)
									@if($pmode==1)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4>
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#bank">
													<strong>Bank deposit/transfer </strong>
													<img src="{{ asset('home/images/bank-transfer.png')}}" width="70px;" height="40px;"> 
													</a>
												</h4>
												<div id="bank" class="panel-collapse collapse">
													<div class="">
														<h4 class="text-{{$text}}"><strong>Bank name:</strong> {{$settings->bank_name}}.</h4>
														<h4 class="text-{{$text}}"><strong>Account name:</strong> {{$settings->account_name}}.</h4>
														<h4 class="text-{{$text}}"><strong>Account number:</strong> {{$settings->account_number}}.</h4>
													</div>
												</div>	
											</div>
										</div>
									</div>
									@endif
									@if($pmode==2)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4>
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#btc">
													<strong>Bitcoin</strong>
													<img src="{{ asset('home/images/btc.png')}}" width="40px;" height="40px;">
													</a>
												</h4>
												<div id="btc" class="panel-collapse collapse">
													<div class="">
														<h4 class="text-{{$text}}">
														<strong>BTC Address:</strong> {{$settings->btc_address}}
														
														<br/><br/>
														@if($settings->withdrawal_option != "manual")
														<a href="{{ url('dashboard/cpay') }}/{{$amount}}/BTC/{{ Auth::user()->id }}/new" class="btn btn-{{$text}}">Automatic payment method</a>
														@endif
														</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($pmode==3)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4>
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#eth">
													<strong>Ethereum</strong>
													<img src="{{ asset('home/images/eth.png')}}" width="40px;" height="40px;">
													</a>
												</h4>
												<div id="eth" class="panel-collapse collapse">
													<div class="">
														<h4 class="text-{{$text}}">
														<strong>ETH Address:</strong> {{$settings->eth_address}}
														
														<br/><br/>
														@if($settings->withdrawal_option != "manual")
														<a href="{{ url('dashboard/cpay') }}/{{$amount}}/ETH/{{ Auth::user()->id }}/new" class="btn btn-{{$text}}">Automatic payment method</a>
														@endif
														</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($pmode==4)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4>
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#ltc">
													<strong>Litecoin</strong>
													<img src="{{ asset('home/images/ltc.png')}}" width="40px;" height="40px;">
													</a>
												</h4>
												<div id="ltc" class="panel-collapse collapse">
													<div class="">
														<h4 class="text-{{$text}}">
														<strong>LTC Address:</strong> {{$settings->ltc_address}}
														<br/><br/>
														@if($settings->withdrawal_option != "manual")
														<a href="{{ url('dashboard/cpay') }}/{{$amount}}/LTC/{{ Auth::user()->id }}/new" class="btn btn-{{$text}}">Automatic payment method</a>
														@endif
														</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($pmode==5)
									<div class="col-lg-8">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4 class="text-{{$text}}">
													<a style="text-decoration:none;"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#stripe">
													<strong>Credit card 
													<img src="{{ asset('home/images/c3.jpg')}}" width="70px;" height="40px;"> 
													<img src="{{ asset('home/images/c2.jpg')}}" width="70px;" height="40px;">
													</strong>
													</a>
												</h4>
										 		<div id="stripe" class="panel-collapse collapse">
													<div class="pt-2">
														{{-- <a href="{{url('/dashboard/stripepay/')}}/{{$amount}}" class="btn btn-{{$text}}" >Checkout</a>
														<h3>{{$intent}}</h3> --}}
														<form id="payment-form" class="sr-payment-form">
															@csrf
															<div class="sr-combo-inputs-row">
															  <div class="sr-input sr-card-element" id="card-element"></div>
															</div>
															<div class="sr-field-error" id="card-errors" role="alert"></div>

															<button id="submit">
															  <div class="hidden spinner" id="spinner"></div>
															  <span id="button-text" id="paybutton" class="">Pay</span><span id="order-amount"></span>
															  <small id="load" class="hidden">Loading, please wait</small>
															</button>
														  </form>
														  <div class="">
															<div class="hidden row" id="stripesuccess">
																<div class="col-lg-12">
																	<span>Payment Completed, redirecting.....</span>
																</div>
															</div>
															<form id="selectform" method="GET" action="javascript:void(0)">
																@csrf
																<input type="hidden" name="amount" value="{{$amount}}">
																<input type="hidden" name="pay_type" value="{{$pay_type}}">
																<input type="hidden" name="plan_id" value="{{$plan_id}}">
															</form>
															{{-- <pre>
															  <code></code>
															</pre> --}}
														  </div>
														  <script type="text/javascript">
	
															var stripe = Stripe("<?php echo $settings->s_p_k; ?>");
															var elements = stripe.elements();
															var style = {
																base: {
																	color: "#32325d",
																}
															};
													
															var card = elements.create("card", { style: style });
															card.mount("#card-element");

															card.on('change', function(event) {
															var displayError = document.getElementById('card-errors');
															if (event.error) {
																displayError.textContent = event.error.message;
															} else {
																displayError.textContent = '';
															}
															});
															
															var form = document.getElementById('payment-form');

															form.addEventListener('submit', function(ev) {
															ev.preventDefault();
															$('#load').removeClass("hidden");
															$('#submit').attr('disbaled', true);
															$('#paybutton').addClass("hidden");
															// If the client secret was rendered server-side as a data-secret attribute
															// on the <form> element, you can retrieve it here by calling `form.dataset.secret`
															var clientSecret = "<?php echo $intent; ?>";
															stripe.confirmCardPayment(clientSecret, {
																payment_method: {
																	card: card,
																	billing_details: {
																		name: "{{Auth::user()->name}}"
																	}
																}
															}).then(function(result) {
																if (result.error) {
																alert('There was an error processing your payment, Please try deposit again from deposit page');
																console.log(result.error.message);
																} else {
																// The payment has been processed!
																if (result.paymentIntent.status === 'succeeded') {
																	
																	$.ajax({
																		url: "{{url('/dashboard/submit-stripe-payment')}}",
																		type: 'GET',
																		data:$('#selectform').serialize(),
																		success: function (data) {
																			//location.reload(true);
																			$('#stripesuccess').removeClass("hidden");
																			window.location.replace("{{route('accounthistory')}}");
																		},
																		error: function (data) {
																			alert('Error Submiting Payment Data');
																			console.log(data);
																		},

																		// frm.submit(function (e) {}
																	});
																	// Show a success message to your customer
																	// There's a risk of the customer closing the window before callback
																	// execution. Set up a webhook or plugin to listen for the
																	// payment_intent.succeeded event that handles any business critical
																	// post-payment actions.
																	}
																}
															});
															});
														</script>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($pmode==6)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4 class="text-{{$text}}">
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#paypal">
													<strong>PayPal</strong> <img src="{{ asset('home/images/pp.png')}}" width="40px;" height="40px;">
													</a>
												</h4>
												<div id="paypal" class="panel-collapse collapse">
													<h4 class="text-{{$text}}">
														@include('includes.paypal')
													</h4>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($pmode==7)
									<div class="col-lg-4">
										<div class="card bg-{{$bg}} shadow text-{{$text}}">
											<div class="card-body">
												<h4 class="text-{{$text}}">
													<a style="text-decoration:none;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#paystack">
													<strong>Paystack</strong> <img src="{{ asset('home/images/paystack.png')}}" width="100px;">
													</a>
												</h4>
												<?php $payamount = $amount * 100  ?>
												<div id="paystack" class="pt-3 panel-collapse collapse">
													<form method="POST" action="{{ route('pay.paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
														<input type="hidden" name="email" value="{{auth::user()->email}}">
														<input type="hidden" name="amount" value="{{$payamount}}">
														<input type="hidden" name="currency" value="NGN">
														<input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > 
														<input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 
														<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
														<p>
														<button class="py-2 btn btn-primary" type="submit" value="Pay Now!">
														<i class="fa fa-credit-card fa-lg"></i> Pay with Card
														</button>
														</p>
													</form>
												</div>
											</div>
										</div>
									</div>
									@endif
								@endforeach
							</div> <br> <br>
							{{-- <div class=" shadow bg-{{$bg}} p-3">
								<h4>Contact management at <strong>{{$settings->contact_email}}</strong> for other payment methods.</h4>
							</div>	 --}}
							<div>
								<form method="post" action="{{action('App\Http\Controllers\SomeController@savedeposit')}}" enctype="multipart/form-data">
										<h5 class="text-{{$text}}">Upload Payment proof after payment. (Ignore if paid with card).</h5>
										<input type="file" name="proof" class="form-control col-lg-4 bg-{{$bg}} text-{{$text}}">
									<br>
									
									<h5 class="text-{{$text}}">Payment Mode Used:</h5>
									<select name="payment_mode" class="form-control col-lg-4 bg-{{$bg}} text-{{$text}}" required>
										<option>Bank transfer</option>
										<option>Ethereum</option>
										<option>Bitcoin</option>
										<option>Litecoin</option>
									</select>
									<br> <br>
									<div >
										<input type="submit" class="btn btn-{{$text}}" value="Submit payment">
									</div> 
									<input type="hidden" name="amount" value="{{$amount}}">
									<input type="hidden" name="pay_type" value="{{$pay_type}}">
									<input type="hidden" name="plan_id" value="{{$plan_id}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</div>
							@endif
						</div>
					</div>







				</div>
			</div>
    @endsection
