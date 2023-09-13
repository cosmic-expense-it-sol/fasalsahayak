<?php


include 'includes/session.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$phone = $_POST['phone'];

$_SESSION['firstname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;

if(!ctype_alpha($firstname) || !ctype_alpha($lastname)){
	$_SESSION['error'] = 'Last and first names must be alphabetic';
	header('location: signup.php');
	exit();
}
else if ($password != $repassword) {
	$_SESSION['error'] = 'Passwords did not match';
	header('location: signup.php');
	exit();
}
else{
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
$stmt->execute(['email' => $email]);
$row = $stmt->fetch();
if ($row['numrows'] > 0) {
	$_SESSION['error'] = 'Email already taken';
	header('location: signup.php');
} 
else{

$now = date('Y-m-d');
$password = password_hash($password, PASSWORD_DEFAULT);

//generate code
$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = substr(str_shuffle($set), 0, 12);

$stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, created_on,contact_info) VALUES (:email, :password, :firstname, :lastname, :code, :now,:phone)");
$stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'code' => $code, 'now' => $now, 'phone'=>$phone]);
$userid = $conn->lastInsertId();
header('location: signup.php');
}
}
$pdo->close();