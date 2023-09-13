<?php include 'includes/session.php'; ?>
<?php
if (isset($_SESSION['user'])) {
  header('location: cart_view.php');
}

?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition register-page">
  <div class="register-box">
    <?php
    if (isset($_SESSION['error'])) {
      echo "
          <div class='callout callout-danger text-center'>
            <p>" . $_SESSION['error'] . "</p> 
          </div>
        ";
      unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
      echo "
          <div class='callout callout-success text-center'>
            <p>" . $_SESSION['success'] . "</p> 
          </div>
        ";
      unset($_SESSION['success']);
    }
    ?>
    <div class="register-box-body">
      <p class="login-box-msg"><marquee behavior="" direction="">Sahayk Dealer Request</marquee></p>

      <form action="register-dealer.php" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="name" placeholder="NAME (as per PAN)" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="mail" placeholder="MAIL (linked with AADHAR)" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="tel" class="form-control" name="phone" placeholder="PHONE  (linked with AADHAR)"  required>
          <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="number" class="form-control" name="adhar" placeholder="AADHAR CARD NO."  required>
          <span class="glyphicon glyphicon-folder-open form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="pan" placeholder="PAN CARD NO."  required>
          <span class="glyphicon glyphicon-file form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password"  required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="dlr" placeholder="DLR ID"  required>
          <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
          <p class="text-warning">DLR ID can be found on your Govt. approved license for Agricultural Commodity Trade.</p>
        </div>


        <hr>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Sign Up</button>
          </div>
        </div>
      </form>
      <br>
      <a href="login-dealer.php">Already have a Dealing Account? </a><br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
    </div>
  </div>

  <?php include 'includes/scripts.php' ?>
</body>

</html>