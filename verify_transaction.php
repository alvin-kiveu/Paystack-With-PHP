<?php
include 'configs.php';
if (isset($_GET['reference'])) {
  $referenceId = $_GET['reference'];
  if ($referenceId == '') {
    header("Location: index.php");
  } else {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$referenceId",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $SecretKey",
        "Cache-Control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $data = json_decode($response);
      if ($data->status == true) {
      echo $transaction_message = $data->message;
      echo "<br>";
      echo  $paid_reference = $data->data->reference;
      echo "<br>";
      echo  $message = $data->data->message;
      echo "<br>";
      echo  $gateway_response = $data->data->gateway_response;
      echo "<br>";
      echo  $receipt_number = $data->data->receipt_number;
      echo "<br>";
      } else {
        // echo $response;
        echo $transaction_message = $data->message;
      }
      
    }
  }
} else {
  header("Location: index.php");
}
