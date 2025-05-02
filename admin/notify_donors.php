<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
include 'conn.php';

if (isset($_POST['blood_group'])) {
    $bloodGroup = $_POST['blood_group'];

    // Blood group mapping (Integer values from database)
    $bloodGroupMap = [
        "B+" => 1,
        "B-" => 2,
        "A+" => 3,
        "O+" => 4,
        "O-" => 5,
        "A-" => 6,
        "AB+" => 7,
        "AB-" => 8
    ];

    // Check if the blood group is valid
    if (!isset($bloodGroupMap[$bloodGroup])) {
        echo "Invalid blood group!";
        exit;
    }

    $bloodGroupId = $bloodGroupMap[$bloodGroup];

    // Fetch donor emails
    $query = "SELECT donor_mail FROM donor_details WHERE donor_blood = $bloodGroupId";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Database error: " . mysqli_error($conn);
        exit;
    }

    $emails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $emails[] = $row['donor_mail'];
    }

    if (empty($emails)) {
        echo "No donors found for blood group $bloodGroup.";
        exit;
    }

    // Configure PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'lekurwaleakshay73@gmail.com';  // Change this to your email
        $mail->Password = 'jlar fgdt hccg yjrc';  // Use App Password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Blood Bank System');
        $mail->Subject = "Urgent Blood Donation Request";
        $mail->Body = "Dear Donor,\n\nWe urgently need blood donations for your blood group ($bloodGroup). If available, please visit the nearest blood bank.\n\nThank you!";
        
        // Send email to all donors
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }

        if ($mail->send()) {
            echo "Notification emails sent successfully to donors with blood group $bloodGroup!";
        } else {
            echo "Failed to send emails.";
        }
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
} else {
    echo "No blood group provided!";
}
?>
