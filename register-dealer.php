<?php


error_reporting(E_ALL);
include 'includes/session.php';


$name = $_POST['name'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$adhar = $_POST['adhar'];
$pan = $_POST['pan'];
$password = $_POST['password'];
$dlr = $_POST['dlr'];


if (strlen($phone)!=10) {
	$_SESSION['error'] = 'Phone number must be exact 10 characters!';
	header('location: signup-dealer.php');
	exit();
} 
else if (strlen($adhar)!=12) {
	$_SESSION['error'] = 'AADHAR number must be exact 12 characters!';
	header('location: signup-dealer.php');
	exit();
} 
else if (strlen($pan)!=10) {
	$_SESSION['error'] = 'PAN number must be exact 10 characters!';
	header('location: signup-dealer.php');
	exit();
} 
else if (strlen($dlr)!=6) {
	$_SESSION['error'] = 'DLR ID must be exact 06 characters!';
	header('location: signup-dealer.php');
	exit();
} 
else {
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM dealer WHERE email=:email");
	$stmt->execute(['email' => $email]);
	$row = $stmt->fetch();
	if ($row['numrows'] > 0) {
		$_SESSION['error'] = 'Email already taken';
		header('location: signup-dealer.php');
	} else {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $conn->prepare("INSERT INTO dealer (name,email,phone,adhar,pan,dlr_id,password) VALUES (:name,:email,:phone,:adhar,:pan,:dlr,:password)");
		$stmt->execute([
			'name' => $name,
			'email' => $mail,
			'phone' => $phone,
			'adhar' => $adhar,
			'pan' => $pan,
			'password' => $password,
			'dlr' => $dlr
		]);
		$userid = $conn->lastInsertId();
		
		header('location: signup-dealer-success.php');

	}
}
$pdo->close();
