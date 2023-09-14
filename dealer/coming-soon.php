<?php include 'includes/session.php'; ?>
<?php
if (isset($_SESSION['dlt'])) {
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
                        <div class="check"><i class="fa fa-cogs " aria-hidden="true" style="font-size: 80px;"></i></div>
                        <h1>Coming Soon !</h1>
                        <p>This feaure will be soon coming up on the dealers portal! </p>
                        <a href="category.php">Go back to Portal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'includes/scripts.php' ?>
</body>

</html>