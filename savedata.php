<?php
include 'conn.php'; // Database connection file

if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood = $_POST['blood'];
    $address = $_POST['address'];

    // **Age Validation**: Blood donation is allowed between 18 and 65 years
    if ($age < 18 || $age > 65) {
        header("Location: success.php?status=invalid_age");
        exit();
    }

    // Check if donor already exists (by mobile number)
    $check_query = "SELECT * FROM donor_details WHERE donor_number = '$mobile'";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Query Failed: " . mysqli_error($conn)); // Debugging SQL error
    }

    if (mysqli_num_rows($check_result) > 0) {
        // Donor already exists
        header("Location: success.php?status=exists");
        exit();
    } else {
        // Insert new donor
        $insert_query = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address) 
                         VALUES ('$name', '$mobile', '$email', '$age', '$gender', '$blood', '$address')";
        
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            header("Location: success.php?status=success");
            exit();
        } else {
            die("Error inserting data: " . mysqli_error($conn)); // Debugging SQL error
        }
    }
}
?>
