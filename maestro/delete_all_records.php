<?php
$conn = new mysqli("localhost", "root", "", "maestro");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle delete all request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM login";

    if ($conn->query($sql)) {
        $message = "<p style='color: green;'>All records deleted successfully.</p>";
    } else {
        $message = "<p style='color: red;'>Error deleting records: " . $conn->error . "</p>";
    }
}

// Fetch all records
$sql = "SELECT * FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete All Records</title>
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
    <script type="text/javascript">
        // JavaScript function to confirm before submitting the delete all form
        function confirmDeleteAll() {
            var result = confirm("Are you sure you want to delete all records?");
            if (result) {
                document.getElementById("deleteAllForm").submit(); // Submit the form if confirmed
            }
        }
    </script>
</head>
<body>
    <h1>Delete All Records</h1>

    <?php 
    // Display success or error message
    echo $message; 
    ?>

    <?php if ($result && $result->num_rows > 0): ?>
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
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['Role']); ?></td>
                    <td><?php echo htmlspecialchars($row['CreatedDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['Remarks']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No records found in the database.</p>
    <?php endif; ?>

    <form id="deleteAllForm" method="POST" action="">
        <button type="button" onclick="confirmDeleteAll()">Delete All Records</button>
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
