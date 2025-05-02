<?php include 'session.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        #sidebar { position:relative; margin-top:-20px; }
        #content { position:relative; margin-left:210px; }
        @media screen and (max-width: 600px) {
            #content { position:relative; margin-left:auto; margin-right:auto; }
        }
    </style>
</head>
<body style="color:black">
    <?php
    include 'conn.php';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    ?>
        <div id="header">
            <?php $active="add_bloodbank"; include 'header.php'; ?>
        </div>
        <div id="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>
        <div id="content">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 lg-12 sm-12">
                            <h1 class="page-title">Add Blood Bank</h1>
                        </div>
                    </div>
                    <hr>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $bank_id = $_POST['bank_id'];
                        $bank_name = $_POST['bank_name'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $contact_no = $_POST['contact_no'];
                        $address = $_POST['address'];

                        // Check if blood bank already exists
                        $check_query = "SELECT * FROM blood_banks WHERE bank_id = '$bank_id'";
                        $check_result = mysqli_query($conn, $check_query);

                        if (mysqli_num_rows($check_result) > 0) {
                            echo '<div class="alert alert-warning">Bank ID already exists!</div>';
                        } else {
                            // Insert blood bank data
                            $insert_query = "INSERT INTO blood_banks (bank_id, bank_name, bank_password, contact_no, address) 
                                             VALUES ('$bank_id', '$bank_name', '$password', '$contact_no', '$address')";

                            if (mysqli_query($conn, $insert_query)) {
                                echo '<div class="alert alert-success">Blood Bank added successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
                            }
                        }
                    }
                    ?>

                    <form method="post" action="">
                        <div class="row">
                            <div class="col-lg-4 mb-4"><br>
                                <div class="font-italic">Bank ID<span style="color:red">*</span></div>
                                <div><input type="text" name="bank_id" class="form-control" required></div>
                            </div>
                            <div class="col-lg-4 mb-4"><br>
                                <div class="font-italic">Bank Name<span style="color:red">*</span></div>
                                <div><input type="text" name="bank_name" class="form-control" required></div>
                            </div>
                            <div class="col-lg-4 mb-4"><br>
                                <div class="font-italic">Password<span style="color:red">*</span></div>
                                <div><input type="password" name="password" class="form-control" required></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-4"><br>
                                <div class="font-italic">Contact No<span style="color:red">*</span></div>
                                <div><input type="text" name="contact_no" class="form-control" required></div>
                            </div>
                            <div class="col-lg-4 mb-4"><br>
                                <div class="font-italic">Address<span style="color:red">*</span></div>
                                <div><input type="text" name="address" class="form-control" required></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
    ?>
        <form method="post" action="login.php" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4" style="float:left">
                    <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
                </div>
            </div>
        </form>
    <?php }
    ?>
</body>
</html>
