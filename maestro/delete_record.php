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
                $message = "<p class='message' style='color: green;'>Record with ID $id deleted successfully.</p>";
            } else {
                $message = "<p class='message' style='color: red;'>Error deleting record: " . $conn->error . "</p>";
            }
        } else {
            $message = "<p class='message' style='color: red;'>Record with ID $id does not exist.</p>";
        }
    } else {
        $message = "<p class='message' style='color: red;'>Please enter an ID to delete a record.</p>";
    }
}

// Fetch all records
$sql = "SELECT * FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete a Record</title>
    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                document.getElementById("deleteForm").submit();
            }
        }

        // Function to hide messages after 3 seconds
        function hideMessage() {
            setTimeout(() => {
                const message = document.querySelector('.message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 3000); // 3000ms = 3 seconds
        }

        // Run the function when the page loads
        window.onload = hideMessage;
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #fae2e2, #ffbcba, #ff948f, #ff6962, #ff3333);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 15px;
            padding: 20px 30px;
            width: 90%;
            max-width: 800px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #c41d1d;
            margin-bottom: 20px;
            font-size: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #c41d1d;
            color: white;
        }

        table th:first-child {
            border-top-left-radius: 10px;
        }

        table th:last-child {
            border-top-right-radius: 10px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #ffe6e6;
        }

        input[type="number"] {
            width: 50%;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid black;
            margin: 20px 0;
            font-size: 1em;
            text-align: center;
        }

        button {
            background-color: white;
            color: #c41d1d;
            border: 2px solid #c41d1d;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background-color: #ff948f;
            color: white;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button-group form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete a Record</h1>

        <!-- Display message -->
        <?php echo $message; ?>

        <!-- Display table -->
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        <?php else: ?>
            <p>No records found in the database.</p>
        <?php endif; ?>

        <!-- Form for deletion -->
        <form id="deleteForm" method="POST" action="">
            <input type="number" name="id" id="id" placeholder="Enter ID to Delete" required>
        </form>

        <div class="button-group">
        <button type="button" onclick="confirmDelete()">Delete Record</button>
            <form action="main_menu.php" method="get">
                <button type="submit">Exit</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
