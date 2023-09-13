<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['login'])){
		
		$dlr = $_POST['dlr'];
		$password = $_POST['password'];

		try{

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM dealer WHERE dlr_id = :dlr");
			$stmt->execute(['dlr'=>$dlr]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				if($row['status']==1){
					if(password_verify($password, $row['password'])){
							$_SESSION['dealer'] = $row['id'];
					}
					else{
						$_SESSION['error'] = 'Incorrect Password';
					}
				}
				else{
					// $_SESSION['error'] = 'Dealer under Verification.';
					header('location: signup-dealer-warning.php');
					exit();
				}
			}
			else{
				$_SESSION['error'] = 'DLR ID not found';
			}
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input login credentails first';
	}

	$pdo->close();

	header('location: login-dealer.php');

?>