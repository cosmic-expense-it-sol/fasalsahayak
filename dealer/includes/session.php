<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['dlr']) || trim($_SESSION['dlr']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM dealer WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['dlr']]);
	$admin = $stmt->fetch();
	$pdo->close();

?>