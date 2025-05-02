<!DOCTYPE html>
<html>
<head>
    <title>Donation Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="text-center">
    <div class="container mt-5">
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="alert alert-success">Thank you! User blood donation details have been recorded successfully.</div>';
            } elseif ($_GET['status'] == 'exists') {
                echo '<div class="alert alert-warning">This user are already registered as a donor.</div>';
            } elseif ($_GET['status'] == 'invalid_age') {
                echo '<div class="alert alert-danger">User are not eligible to donate blood. Age must be between 18 and 65.</div>';
            } else {
                echo '<div class="alert alert-danger">Something went wrong. Please try again.</div>';
            }
        }
        ?>
        <a href="dashboard.php" class="btn btn-primary">Go Back</a>
    </div>
</body>
</html>
