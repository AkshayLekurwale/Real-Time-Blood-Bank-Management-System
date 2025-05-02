<?php
include 'conn.php';

if (!isset($_POST['blood_group'])) {
    echo "No blood group provided!";
    exit;
}

$bloodGroup = mysqli_real_escape_string($conn, $_POST['blood_group']);

// Count available units
$countQuery = "SELECT COUNT(*) as count FROM blood_storage WHERE blood_group = '$bloodGroup'";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalUnits = $countRow['count'];

// Ensure at least 1 unit remains
if ($totalUnits < 1) {
    echo "Cannot remove! At least 1 unit must remain.";
    exit;
}

// Find the oldest unit
$findOldestQuery = "SELECT donor_name, contact_no, email_id, bank_id 
                    FROM blood_storage 
                    WHERE blood_group = '$bloodGroup' 
                    ORDER BY bank_id ASC LIMIT 1";
$oldestResult = mysqli_query($conn, $findOldestQuery);

if (!$oldestResult || mysqli_num_rows($oldestResult) == 0) {
    echo "No units available for $bloodGroup!";
    exit;
}

$oldestRow = mysqli_fetch_assoc($oldestResult);
$donorName = $oldestRow['donor_name'];
$contactNo = $oldestRow['contact_no'];
$emailId   = $oldestRow['email_id'];
$bankId    = $oldestRow['bank_id'];

// Delete the oldest unit
$deleteQuery = "DELETE FROM blood_storage 
                WHERE blood_group = '$bloodGroup' 
                AND donor_name = '$donorName' 
                AND contact_no = '$contactNo' 
                AND email_id = '$emailId' 
                AND bank_id = '$bankId' 
                LIMIT 1";

if (mysqli_query($conn, $deleteQuery)) {
    echo "1 unit of $bloodGroup removed successfully!";
} else {
    echo "Error removing unit: " . mysqli_error($conn);
}
?>
