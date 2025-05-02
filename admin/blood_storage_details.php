<?php
include 'conn.php';
include 'session.php';
$active = "blood_inventory";
include 'sidebar.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <style>
        body { color: black; }
        #sidebar { position: relative; margin-top: -20px; }
        #content { position: relative; margin-left: 210px; }
        .table thead { background-color: #17a2b8; color: white; }
        @media screen and (max-width: 600px) {
            #content { margin-left: auto; margin-right: auto; }
        }
    </style>
</head>
<body>

<div id="header">
    <?php include 'header.php'; ?>
</div>
<div id="sidebar">
    <?php include 'sidebar.php'; ?>
</div>

<div id="content">
    <div class="container-fluid">
        <h2 class="page-title text-center" style="color:black;">Blood Inventory</h2>
        <hr>

        <?php
        // Fetch all blood groups including 0 units
        $bloodGroups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-"];

        // Query to count available units for each blood group
        $sql = "SELECT blood_group, COUNT(*) as count 
                FROM blood_storage 
                GROUP BY blood_group 
                ORDER BY blood_group";
        $result = mysqli_query($conn, $sql);

        $bloodCounts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bloodCounts[$row['blood_group']] = $row['count'];
        }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Blood Group</th>
                        <th>Units Available</th>
                        <th>Notify Donors</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="color:black;">
                    <?php foreach ($bloodGroups as $group) { 
                        $units = isset($bloodCounts[$group]) ? $bloodCounts[$group] : 0;
                    ?>
                    <tr>
                        <td><b><?php echo $group; ?></b></td>
                        <td><?php echo $units; ?></td>
                        <td>
                            <button class="btn btn-info notify-btn" data-group="<?php echo $group; ?>">Notify Donors</button>
                        </td>
                        <td>
                            <button class="btn btn-danger remove-btn" 
                                    data-group="<?php echo $group; ?>" 
                                    data-units="<?php echo $units; ?>"
                                    <?php echo ($units < 1) ? "disabled" : ""; ?>>
                                Remove 1 Unit
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".remove-btn", function() {
    var bloodGroup = $(this).data("group");
    var units = $(this).data("units");

    if (units < 1) {
        alert("Cannot remove! At least 1 unit must remain.");
        return;
    }

    if (confirm("Are you sure you want to remove 1 unit of " + bloodGroup + "?")) {
        $.ajax({
            url: "remove_blood_unit.php",
            type: "POST",
            data: { blood_group: bloodGroup },
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
});
</script>

<script>
$(document).on("click", ".notify-btn", function() {
    var bloodGroup = $(this).data("group");

    if (confirm("Are you sure you want to notify donors for " + bloodGroup + "?")) {
        $.ajax({
            url: "notify_donors.php",
            type: "POST",
            data: { blood_group: bloodGroup },
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
});
</script>


</body>
</html>
