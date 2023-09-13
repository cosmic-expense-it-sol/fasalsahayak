<?php 
include 'includes/session.php'; 
include '../../includes/conn.php';

error_reporting(E_ALL);
if (isset($_GET['action']) && isset($_GET['id'])){

    $action = $_GET['action'];
    $id = $_GET['id'];

    if($action == 'verify'){

        $conn = $pdo->open();
        $stmt = $conn->prepare("UPDATE dealer SET status = '1' WHERE id=:id ");
        $stmt->execute(['id' => $id]);
        $pdo->close();
        $_SESSION['error']='verify';
        header('location: ../verification-dealer.php');
    }

    if($action == 'delete'){

        $conn = $pdo->open();
        $stmt = $conn->prepare("UPDATE dealer SET status = '3' WHERE id=:id ");
        $stmt->execute(['id' => $id]);
        $pdo->close();
        header('location: ../verification-dealer.php');
    }

    if($action == 'reject'){

        $conn = $pdo->open();
        $stmt = $conn->prepare("UPDATE dealer SET status = '2' WHERE id=:id ");
        $stmt->execute(['id' => $id]);
        $pdo->close();
        header('location: ../verification-dealer.php');
    }

    if($action == 'debarr'){

        $conn = $pdo->open();
        $stmt = $conn->prepare("UPDATE dealer SET status = '4' WHERE id=:id ");
        $stmt->execute(['id' => $id]);
        $pdo->close();
        header('location: ../verification-dealer.php');
    }

}
else{
    echo "PURGED LINK FOUND";
}