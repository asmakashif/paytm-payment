<?php
require_once "config.php";
$result = getTransactionToken();
?>
<html>
   <head>
      <title>Paytm Blink Checkout - PHP</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <script type="application/javascript" crossorigin="anonymous" src="<?php echo PAYTM_ENVIRONMENT; ?>/merchantpgpui/checkoutjs/merchants/<?php echo PAYTM_MID; ?>.js"></script>
   </head>
   <body>
      <div class="container text-center">
      	<div class="shadow p-3 mb-5 bg-white rounded">
      		<h2>Paytm Blink Checkout - PHP</h2>
         	<h4>Make Payment</h4>
        	<p>You are making payment of ₹1</p>
	        <div class="btn-area">
	            <button type="button" id="blinkCheckoutPayment" name="submit" class="btn btn-primary">Pay Now</button>
	        </div>
      	</div>
      </div>
      <script>
      	
         document.getElementById("blinkCheckoutPayment").addEventListener("click", function(){
         		openBlinkCheckoutPopup('<?php echo $result['orderId']?>','<?php echo $result['txnToken']?>','<?php echo $result['amount']?>');
         	}
         );
         
        function openBlinkCheckoutPopup(orderId, txnToken, amount)
         {
         	// console.log(orderId, txnToken, amount);
         	var config = {
         		"root": "",
         		"flow": "DEFAULT",
         		"data": {
         			"orderId": orderId, 
         			"token": txnToken, 
         			"tokenType": "TXN_TOKEN",
         			"amount": amount 
				 },
         		"handler": {
         		"notifyMerchant": function(eventName,data){
         			console.log("notifyMerchant handler function called");
         			console.log("eventName => ",eventName);
         			console.log("data => ",data);
         			location.reload();
         		} 
         		}
         	};
         	 if(window.Paytm && window.Paytm.CheckoutJS){
         			// initialze configuration using init method 
         			window.Paytm.CheckoutJS.init(config).then(function onSuccess() {
         				// after successfully updating configuration, invoke checkoutjs
         				window.Paytm.CheckoutJS.invoke();
         			}).catch(function onError(error){
         				console.log("error => ",error);
         			});
         	}
        }
      </script>
   </body>
</html>