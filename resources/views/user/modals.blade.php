
			
			
			<!-- Deposit Modal -->
			<div id="depositModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
  
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header bg-{{$bg}}">
					  <h4 class="modal-title text-{{$text}}">Make new deposit</h4>
					  <button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body bg-{{$bg}}">
						  <form style="padding:3px;" role="form" method="post" action="{{route('newdeposit')}}">
								 <input style="padding:5px;" class="form-control text-{{$text}} bg-{{$bg}}" placeholder="Enter amount here" type="text" name="amount" required><br/>
								 
								 <input type="hidden" name="_token" value="{{ csrf_token() }}">
								 <input type="submit" class="btn btn-{{$text}}" value="Continue">
						 </form>
					</div>
				  </div>
				</div>
			  </div>
			  <!-- /deposit Modal -->
			
			
			<!-- Delete Subscription Modal -->
			<div id="delsubmodal" class="modal fade" role="dialog">
				<div class="modal-dialog">
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header bg-{{$bg}}">
					  <h4 class="modal-title text-{{$text}}">Delete MT4 Details</h4>
					  <button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body bg-{{$bg}} p-3">
						<h5 class="text-{{$text}}">Your subscription has already started, send an Email to {{$settings->contact_email}} to have your MT4 Details Deleted.</h5>
					</div>
				  </div>
				</div>
			  </div>
			  <!-- /deposit Modal -->
			
		


					  <!-- Withdrawal Modal -->
		  <div id="withdrawalModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header bg-{{$bg}}">
				  <h4 class="modal-title text-{{$text}}">Payment will be sent to your recieving address.</h4>
				  <button type="button" class="text-white close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body bg-dark">
					  <form style="padding:3px;" role="form" method="post" action="{{route('withdrawal')}}">
							 <input style="padding:5px;" class="form-control bg-{{$bg}} text-{{$text}}" placeholder="Enter amount here" type="text" name="amount" required><br/>
							 
							 <input type="hidden" name="_token" value="{{ csrf_token() }}">
							 <input type="submit" class="btn btn-{{$text}}" value="Submit">
					 </form>
				</div>
			  </div>
			</div>
		  </div>
		  <!-- /Withdrawals Modal -->

		

			

		<!-- Subscription Payment modal -->
			<div class="modal fade" id="SubpayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-{{$bg}}">
					
						<h4 class="modal-title text-{{$text}}">Subscription Payment</h4>
						<button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
			      </div>

				<form role="form" method="post" action="{{route('newdeposit')}}" id="priceform">
				<div class="modal-body bg-{{$bg}}">
					
					<h5 class="text-{{$text}}">Duration</h5>
						<select class="form-control bg-{{$bg}} text-{{$text}}" onchange="calcAmount(this)" name="duration" class="duration" id="duratn">
							<option value="default">Select duration</option>
							<option>Monthly</option>
							<option>Quaterly</option>
							<option>Yearly</option>
						</select><br>
						<h5 class="text-{{$text}}">Amount to Pay</h5>
						<input class="form-control subamount bg-{{$bg}} text-{{$text}}" type="text" id="amount" disabled><br/>
						<input id="amountpay" type="hidden" name="amount">
						<input type="hidden" value="Subscription Trading" name="pay_type">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
				</div>
				<div class="modal-footer bg-{{$bg}}">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Pay Now</button>
				</div>
				</div>
				</form>

				<script type="text/javascript">
				function calcAmount(sub) {
					if(sub.value=="Quaterly"){
						var amount = document.getElementById('amount');
						var amountpay = document.getElementById('amountpay');
						amount.value = '<?php echo $settings->currency.$settings->quarterlyfee; ?>';
						amountpay.value = '<?php echo $settings->quarterlyfee; ?>';
					}if(sub.value=="Yearly"){
						var amount = document.getElementById('amount');
						var amountpay = document.getElementById('amountpay');
						amount.value = '<?php echo $settings->currency.$settings->yearlyfee; ?>';
						amountpay.value = '<?php echo $settings->yearlyfee; ?>';
					}if(sub.value=="Monthly"){
						var amount = document.getElementById('amount');
						var amountpay = document.getElementById('amountpay');
						amount.value = '<?php echo $settings->currency.$settings->monthlyfee; ?>';
						amountpay.value = '<?php echo $settings->monthlyfee; ?>';
					}
				}
				</script>
			</div>
			</div>
			<!-- Subscription Payment modal -->
			
			
		<!-- Submit MT4 MODAL modal -->
			<div id="submitmt4modal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header bg-{{$bg}}">
						<h4 class="modal-title text-{{$text}}">Submit your MT4 Login Details</h4>
						<button type="button" class="close text-{{$text}}" data-dismiss="modal">&times;</button>
			      </div>
			     	<div class="modal-body bg-{{$bg}}">
              			<form role="form" method="post" action="{{route('savemt4details')}}">
							  
							  <h5 class="text-{{$text}} ">MT4 ID*:</h5>
							<input class="form-control bg-{{$bg}} text-{{$text}}"  type="text" name="userid" required><br/>
							<h5 class="text-{{$text}} ">MT4 Password*:</h5>
							<input style="padding:5px;" class="form-control bg-{{$bg}} text-{{$text}}"  type="text" name="pswrd" required><br/>
							<h5 class="text-{{$text}} ">Account Type:</h5>
							<input  class="form-control bg-{{$bg}} text-{{$text}}" Placeholder="E.g. Standard" type="text" name="acntype" required><br/>	
							<h5 class="text-{{$text}} ">Currency*:</h5>
							<input  class="form-control bg-{{$bg}} text-{{$text}}" Placeholder="E.g. USD" type="text" name="currency" required><br/>
							<h5 class="text-{{$text}} ">Leverage*:</h5>
							<input  class="form-control bg-{{$bg}} text-{{$text}}" Placeholder="E.g. 1:500"  type="text" name="leverage" required><br/>
							<h5 class="text-{{$text}} ">Server*:</h5>
							<input  class="form-control bg-{{$bg}} text-{{$text}}" Placeholder="E.g. HantecGlobal-live"  type="text" name="server" required><br/>
							<h5 class="text-{{$text}} ">Subscription Duration:</h5>
							<select class="form-control bg-{{$bg}} text-{{$text}}" name="duration" class="duration">
								<option value="default">Select duration</option>
								<option>Monthly</option>
								<option>Quaterly</option>
								<option>Yearly</option>
							</select><br>

					   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
					   		<input type="submit" class="btn btn-primary" value="Submit">
					   </form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- /plans Modal -->
