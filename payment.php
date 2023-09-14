<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
require("razorpay/Razorpay.php");
require("config.php");

use Razorpay\Api\Api;
$keyId = "rzp_test_FawICCD3WUCKgN";
$keySecret = "jrl0l9oZBCLIUmVxsH5MX3Yy";
$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM `temp` WHERE `key`='total';");
$stmt->execute();
foreach ($stmt as $row) {
	$tp = $row['value']*100;

}
$pdo->close();
$api = new Api($keyId, $keySecret);
$orderData = [
	'amount'          => $tp, // 39900 rupees in paise
	'currency'        => 'INR'
];
$orderData = $api->order->create($orderData);

?>
<h2>TOTAL PAYMENT - <?php echo $tp/100;?></h2>
<button id="rzp-button1" class="btn btn-primary mt-2" style="margin-left:100px;">Pay Here</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "<?php echo $keyId ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $orderData['amount'] ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Fasal Sahayak Payment Portal",
        "description": "Fasal Sahayak E-com Services Payment",
        "image": "https://cdn.vectorstock.com/i/preview-1x/35/38/crop-protection-or-insurance-icon-logo-vector-39513538.jpg",
        "order_id": "<?php echo $orderData['id'] ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1

        "callback_url": "sales.php",
        "prefill": {
            "name": "",
            "email": "",
            "contact": ""
        },
        "theme": {
            "color": "#A6A6A6"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function(response) {
        window.location.href = "pay_failed.php";
    });
    document.getElementById('rzp-button1').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
</script>