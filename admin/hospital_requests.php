<?php
include 'conn.php';
include 'session.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>

#sidebar{position:relative;margin-top:-20px}
#content{position:relative;margin-left:210px}
@media screen and (max-width: 600px) {
  #content {
    position:relative;margin-left:auto;margin-right:auto;
  }
}
</style>
</head>
<body style="color:black">
    <div id="header">
        <?php include 'header.php'; ?>
    </div>
    <div id="sidebar">
        <?php $active = "hospital_queries"; include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <div class="container-fluid">
            <h1 class="page-title">Hospital Blood Requests</h1>
            <hr>

            <?php
            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Fetch hospital blood requests
            $sql = "SELECT * FROM hospital_blood_requests LIMIT $offset, $limit";
            $result = mysqli_query($conn, $sql);

            // Check for SQL errors
            if (!$result) {
                die("Query Failed: " . mysqli_error($conn)); // Print the error message
            }

            if (mysqli_num_rows($result) > 0) {
            ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Hospital ID</th>
                            <th>Blood Group</th>
                            <th>Quantity</th>
                            <th>Urgency Level</th>
                            <th>Contact No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = $offset + 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo htmlspecialchars($row['hospital_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['urgency_level']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
                            <td>
                                <a href='delete_hospital_requests.php?id=<?php echo $row['hospital_id']; ?>' class="btn btn-danger btn-sm">Complete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <?php 
            // Get total records for pagination
            $sql1 = "SELECT COUNT(*) AS total FROM hospital_blood_requests";
            $result1 = mysqli_query($conn, $sql1);

            if (!$result1) {
                die("Query Failed: " . mysqli_error($conn)); // Debug SQL error
            }

            $row1 = mysqli_fetch_assoc($result1);
            $total_records = $row1['total'];
            $total_pages = ceil($total_records / $limit);

            if ($total_pages > 1) {
                echo '<ul class="pagination">';
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'class="active"' : '';
                    echo '<li ' . $active . '><a href="hospital_queries.php?page=' . $i . '">' . $i . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
            <?php } else { echo '<div class="alert alert-info">No blood requests found.</div>'; } ?>
        </div>
    </div>
</body>
</html>
<?php 
} else { 
    echo '<div class="alert alert-danger">Please login first to access the portal.</div>'; 
} 
?>
