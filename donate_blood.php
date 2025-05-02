<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            color: #2C3E50;
        }

        .font-italic {
            font-style: italic;
        }

        .required {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $active = 'donate';
    include('head.php');
    ?>

    <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:50px;">

                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="mt-4 mb-3">Donate Blood</h1>
                    </div>
                </div>

                <form name="donor" action="savedata.php" method="post">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Full Name <span class="required">*</span></div>
                            <div><input type="text" name="fullname" class="form-control" required></div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Mobile Number <span class="required">*</span></div>
                            <div><input type="text" name="mobileno" class="form-control" required></div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Email Id</div>
                            <div><input type="email" name="emailid" class="form-control"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Age <span class="required">*</span></div>
                            <div><input type="number" name="age" class="form-control" required></div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Gender <span class="required">*</span></div>
                            <div>
                                <select name="gender" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Blood Group <span class="required">*</span></div>
                            <div>
                                <select name="blood" class="form-control" required>
                                    <option value="" selected disabled>Select</option>
                                    <?php
                                    include 'conn.php';
                                    $sql = "SELECT * FROM blood";
                                    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['blood_id'] . '">' . $row['blood_group'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Blood Groups Available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Address <span class="required">*</span></div>
                            <div><textarea class="form-control" name="address" required></textarea></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>

</body>
</html>