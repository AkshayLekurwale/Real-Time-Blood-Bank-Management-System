<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $req_id = $_GET['id'];

    // Use single quotes to handle string values
    $sql = "DELETE FROM hospital_blood_requests WHERE hospital_id='$req_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }
}

mysqli_close($conn);
header("Location: hospital_requests.php"); // Redirect back
exit();
?>
