  <!--<script
    src="https://www.paypal.com/sdk/js?client-id=AUYgYtfIfzQu8UOha9kVtTSywlP31WO4vPbo23S5C1WeVmLEL-GtAfbyDfRgAHDhrxtENp-cy49cLyAI">
  </script>
  
  <script>paypal.Buttons().render('body');</script>-->

 <div id="paypal-button-container"></div>
  
  
  <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: {{$amount}}
          }
        }]
      });
    }
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
        // Call your server to save the transaction
        return fetch("paypalverify/{{$amount}}", {
          method: 'post',
          headers: {
            'content-type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          body: JSON.stringify({
            orderID: data.orderID
          })
        });
      });
    }
  }).render('#paypal-button-container');
</script>