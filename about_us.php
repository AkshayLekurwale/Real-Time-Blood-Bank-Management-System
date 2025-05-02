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

        h1 {
            color: #2C3E50;
        }

        .img-fluid {
            border-radius: 10px;
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
        $active = 'about';
        include('head.php'); 
        ?>
    </div>

    <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:50px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="mt-4 mb-3">About Us</h1>
                        <p>
                            <?php
                            include 'conn.php';
                            $sql = "SELECT * FROM pages WHERE page_type='aboutus'";
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
                        <img class="img-fluid" src="image/banner_590x300.jpg" style="height:400px" alt="About Us">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>