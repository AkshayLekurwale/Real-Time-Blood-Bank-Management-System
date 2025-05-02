<?php
include 'conn.php'; // Database connection
$active = 'bank';
include('head.php');

if (isset($_POST['submit'])) {
    $bank_id = mysqli_real_escape_string($conn, $_POST['bank_id']);
    $bank_password = mysqli_real_escape_string($conn, $_POST['bank_password']); // Not verifying, just storing
    $donor_name = mysqli_real_escape_string($conn, $_POST['donor_name']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $donor_number = mysqli_real_escape_string($conn, $_POST['contact_no']); // Corrected column name
    $email_id = mysqli_real_escape_string($conn, $_POST['email_id']);

    // ✅ Check if Bank ID exists
    $bank_query = "SELECT bank_id FROM blood_banks WHERE bank_id = ?";
    $bank_stmt = mysqli_prepare($conn, $bank_query);
    mysqli_stmt_bind_param($bank_stmt, "s", $bank_id);
    mysqli_stmt_execute($bank_stmt);
    $bank_result = mysqli_stmt_get_result($bank_stmt);

    if (mysqli_num_rows($bank_result) == 0) {
        echo "<script>alert('Bank ID NOT FOUND!');</script>";
        exit;
    }

    // ✅ Check if Donor exists (using correct column donor_number)
    $donor_query = "SELECT donor_id FROM donor_details WHERE donor_number = ?";
    $donor_stmt = mysqli_prepare($conn, $donor_query);
    mysqli_stmt_bind_param($donor_stmt, "s", $donor_number);
    mysqli_stmt_execute($donor_stmt);
    $donor_result = mysqli_stmt_get_result($donor_stmt);

    if (mysqli_num_rows($donor_result) == 0) {
        echo "<script>alert('Donor NOT FOUND! Please add the donor first.');</script>";
        exit;
    }

    // ✅ Insert into blood_storage
    $insert_query = "INSERT INTO blood_storage (donor_name, blood_group, contact_no, email_id, bank_id) 
                     VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "sssss", $donor_name, $blood_group, $donor_number, $email_id, $bank_id);
    
    if (mysqli_stmt_execute($insert_stmt)) {
        echo "<script>alert('Blood storage entry added successfully!');</script>";
    } else {
        echo "<script>alert('Insert failed: " . mysqli_error($conn) . "');</script>";
    }

    // Close statements
    mysqli_stmt_close($bank_stmt);
    mysqli_stmt_close($donor_stmt);
    mysqli_stmt_close($insert_stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blood Storage Entry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        h2 {
            color: #2C3E50;
        }

        .btn-primary {
            background-color: #7FB3D5;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5D6D7E;
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

<div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
        <div id="content-wrap" style="padding-bottom:50px;">
            <h2>Blood Storage Form</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Bank ID:</label>
                    <input type="text" name="bank_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Bank Password:</label>
                    <input type="password" name="bank_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Donor Name:</label>
                    <input type="text" name="donor_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Blood Group:</label>
                    <select name="blood_group" class="form-control" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Donor Contact No:</label>
                    <input type="text" name="contact_no" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Donor Email ID:</label>
                    <input type="email" name="email_id" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit Entry</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?> <!-- Include the footer -->

</body>
</html>