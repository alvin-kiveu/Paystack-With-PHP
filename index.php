<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PAYSTACK</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form id="paymentForm">
    <div class="form-submit">
      <button type="submit" onclick="payWithPaystack()"> Pay </button>
    </div>
  </form>
  <script src="https://js.paystack.co/v1/inline.js"></script>

  <?php
  include 'configs.php';
  $email = "kiveualvin46@gmail.com";
  $amount = 20;
  $currency = "KES";
  ?>

  <script type="text/javascript">
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {
      e.preventDefault();
      let handler = PaystackPop.setup({
        key: '<?php echo $PublicKey; ?>', // Replace with your public key
        email: '<?php echo $email; ?>',
        amount: <?php echo $amount; ?> * 100,
        currency: '<?php echo $currency; ?>', // Use GHS for Ghana Cedis or USD for US Dollars or KES for Kenya Shillings
        ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        // label: "Optional string that replaces customer email"
        onClose: function() {
          alert('Transaction was not completed, window closed.');
        },
        callback: function(response) {
          let message = 'Payment complete! Reference: ' + response.reference;
          alert(message);
          window.location.href = "http://localhost/PayStack-With-PHP/verify_transaction.php?reference=" + response.reference;
        }
      });

      handler.openIframe();
    }
  </script>

  <script src="https://js.paystack.co/v1/inline.js"></script>
</body>

</html>