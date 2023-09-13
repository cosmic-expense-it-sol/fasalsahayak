<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Users
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dealers</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
<div class='alert alert-danger alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
<h4><i class='icon fa fa-warning'></i> Error!</h4>
" . $_SESSION['error'] . "
</div>
";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
<h4><i class='icon fa fa-check'></i> Success!</h4>
" . $_SESSION['success'] . "
</div>
";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <!-- <th>Photo</th> -->
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Mail</th>
                                        <th>Phone</th>
                                      
                                        <th>DLR ID</th>
                              
                                        <th>Status</th>
                 
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                        $conn = $pdo->open();

                                        try {
                                            $stmt = $conn->prepare("SELECT * FROM dealer");
                                            $stmt->execute();
                                            foreach ($stmt as $row) {
                                                // getting the status into the pill;
                                                if ($row['status'] == 0) {
                                                    $status = '<span class="label label-warning">Pending Verification</span>';
                                                    $btn = "
                                                    <a class='btn btn-success btn-sm btn-flat' href='dealer_actions/verification.php?action=verify&id=" . $row['id'] . "'><i class='fa fa-edit'></i> Verify</a>
                                                    ";
                                                    $btn3 = "
                                                    <a class='btn btn-warning btn-sm btn-flat' href='dealer_actions/verification.php?action=reject&id=" . $row['id'] . "'><i class='fa fa-remove'></i> Reject</a>
                                                    ";
                                                } else if ($row['status'] == 1) {
                                                    $status = '<span class="label label-success">Activated</span>';
                                                 

                                                } else if ($row['status'] == 2) {
                                                    $status = '<span class="label label-danger">Rejected</span>';
                                                    $btn = "
                                                    <a class='btn btn-success btn-sm btn-flat' href='dealer_actions/verification.php?action=verify&id=" . $row['id'] . "'><i class='fa fa-edit'></i> Verify</a>
                                                    ";
                                                } else if ($row['status'] == 3) {
                                                    continue;
                                                } else {
                                                    $status = '<span class="label label-primary">Integrity Issue</span>';
                                                }
                                                $btn2 = "
                                                    <a class='btn btn-danger btn-sm btn-flat' href='dealer_actions/verification.php?action=delete&id=" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</a>
                                                    ";
                                                $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="' . $row['id'] . '"><i class="fa fa-check-square-o"></i></a></span>' : '';
                                                echo "
                                                <tr>
                                                <td>
                                                    " . $row['id'] . "
                                                </td>

                                                <td>
                                                " . $row['name'] . "
                                                </td>

                                                <td>
                                                " . $row['email'] . "
                                                </td>

                                                <td>
                                                " . $row['phone'] . "
                                                </td>

                                              
                                                <td>
                                                " . $row['dlr_id'] . "
                                                </td>

                                                <td>
                                                    " . $status . "
                                                </td>

                                            
                                                </tr>
                                                ";
                                            }
                                        } catch (PDOException $e) {
                                            echo $e->getMessage();
                                        }

                                        $pdo->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </section>

        </div>
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/users_modal.php'; ?>

    </div>
    <!-- ./wrapper -->

    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function() {

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#edit').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $(document).on('click', '.photo', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                getRow(id);
            });

            $(document).on('click', '.status', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                getRow(id);
            });

        });

        function getRow(id) {
            $.ajax({
                type: 'POST',
                url: 'users_row.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    $('.userid').val(response.id);
                    $('#edit_email').val(response.email);
                    $('#edit_password').val(response.password);
                    $('#edit_firstname').val(response.firstname);
                    $('#edit_lastname').val(response.lastname);
                    $('#edit_address').val(response.address);
                    $('#edit_contact').val(response.contact_info);
                    $('.fullname').html(response.firstname + ' ' + response.lastname);
                }
            });
        }
    </script>
</body>

</html>