<?php
$conn = new mysqli("localhost", "root", "", "maestro");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        // Check if the record exists
        $checkSql = "SELECT * FROM login WHERE id='$id'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            // Delete the record
            $sql = "DELETE FROM login WHERE id='$id'";
            if ($conn->query($sql)) {
                $message = "<p style='color: green;'>Record with ID $id deleted successfully.</p>";
            } else {
                $message = "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
            }
        } else {
            $message = "<p style='color: red;'>Record with ID $id does not exist.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Please enter an ID to delete a record.</p>";
    }
}

// Fetch all records
$sql = "SELECT * FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete a Record</title>
    <script type="text/javascript">
        // JavaScript function to confirm before submitting the delete form
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                document.getElementById("deleteForm").submit(); // Submit the form if confirmed
            }
        }
    </script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Delete a Record</h1>

    <?php 
    // Display success or error message
    echo $message; 
    ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Remarks</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['Role']; ?></td>
                    <td><?php echo $row['CreatedDate']; ?></td>
                    <td><?php echo $row['Remarks']; ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No records found in the database.</p>
    <?php endif; ?>
    
    <form id="deleteForm" method="POST" action="">
        ID: <input type="number" name="id" required><br><br>
        <button type="button" onclick="confirmDelete()">Delete Record</button> <!-- Calls confirmDelete function -->
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
