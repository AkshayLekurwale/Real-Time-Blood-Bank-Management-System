<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .header {
            background-color: #7FB3D5;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .carousel-inner img {
            width: 100%;
            height: 500px;
        }

        .card {
            transition: transform 0.2s;
            border: none;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: #5D6D7E;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #4A6072;
        }

        h1, h2, h4 {
            color: #2C3E50;
        }

        .footer {
            background-color: #7FB3D5;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php
        $active = "home";
        include('head.php'); ?>
    </div>
    <?php include 'ticker.php'; ?>

    <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:75px;">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="image/_107317099_blooddonor976.jpg" alt="Blood Donation" />
                        </div>
                        <div class="carousel-item">
                            <img src="image/Blood-facts_10-illustration-graphics__canteen.png" alt="Blood Facts" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
                <br>
                <h1>Welcome to BloodBank & Donor Management System</h1>
                <br>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <h4 class="card-header bg-info text-white">The need for blood</h4>
                            <p class="card-body overflow-auto" style="height:120px; text-align:left;">
                                <?php
                                include 'conn.php';
                                $sql = "SELECT * FROM pages WHERE page_type='needforblood'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['page_data'];
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <h4 class="card-header bg-info text-white">Blood Tips</h4>
                            <p class="card-body overflow-auto" style="height:120px; text-align:left;">
                                <?php
                                $sql = "SELECT * FROM pages WHERE page_type='bloodtips'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['page_data'];
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <h4 class="card-header bg-info text-white">Who You Could Help</h4>
                            <p class="card-body overflow-auto" style="height:120px; text-align:left;">
                                <?php
                                $sql = "SELECT * FROM pages WHERE page_type='whoyouhelp'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['page_data'];
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <h2>BLOOD GROUPS</h2>
                        <p>
                            <?php
                            $sql = "SELECT * FROM pages WHERE page_type='bloodgroups'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row['page_data'];
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded" src="image/blood_donationcover.jpeg" alt="Blood Donation Cover">
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
                        <p>
                            <?php
                            $sql = "SELECT * FROM pages WHERE page_type='universal'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row['page_data'];
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-lg btn-secondary btn-block" href="donate_blood.php">Become a Donor</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>

</html>