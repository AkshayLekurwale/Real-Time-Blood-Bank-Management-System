<?php
include 'conn.php'; // Database connection
// Include the header



$active ='need';
include 'head.php'; 




if (isset($_POST['submit'])) {
    $hospital_id = mysqli_real_escape_string($conn, $_POST['hospital_id']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $urgency = mysqli_real_escape_string($conn, $_POST['urgency']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);

    // Check if hospital ID exists
    $sql = "SELECT hospital_id FROM hospitals WHERE hospital_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $hospital_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Insert request into database
            $insert_sql = "INSERT INTO hospital_blood_requests (hospital_id, blood_group, quantity, urgency_level, contact_no) 
                           VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_sql);
            
            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, "ssiss", $hospital_id, $blood_group, $quantity, $urgency, $contact_no);
                mysqli_stmt_execute($insert_stmt);
                echo "<div class='alert alert-success'>Blood request submitted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error in INSERT query: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Hospital ID not found!</div>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'>Error in SELECT query: " . mysqli_error($conn) . "</div>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Blood Request</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
        <div id="content-wrap" style="padding-bottom:50px;">
            <h2>Blood Request Form</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Hospital ID:</label>
                    <input type="text" name="hospital_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Hospital Password:</label>
                    <input type="text" name="hospital_pass" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Hospital Name:</label>
                    <input type="text" name="hospital_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Blood Group Needed:</label>
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
                    <label>Quantity (in units):</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Urgency Priority (1-5):</label>
                    <input type="number" name="urgency" class="form-control" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label>Contact Number:</label>
                    <input type="text" name="contact_no" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?> <!-- Include the footer -->

</body>
</html>
