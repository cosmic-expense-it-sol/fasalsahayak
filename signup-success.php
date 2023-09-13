<?php include 'includes/session.php'; ?>
<?php
if (isset($_SESSION['user'])) {
    header('location: cart_view.php');
}
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition register-page">

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="payment">
                    <div class="content">
                        <div class="check"><i class="fa fa-check " aria-hidden="true" style="font-size: 80px;"></i></div>
                        <h1>Signup Success !</h1>
                        <p>You have succesfully onboarded the FasalSahayak App, now you can login to order your assorted products.! </p>
                        <a href="login.php">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'includes/scripts.php' ?>
</body>

</html>