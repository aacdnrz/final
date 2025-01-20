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
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #fae2e2, #ffbcba, #ff948f, #ff6962, #ff3333);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            background-color: #c41d1d;
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 30px;
            width: 80%;
            max-width: 800px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: white;
        }

        table, th, td {
            border: 1px solid #c41d1d;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin: 20px 0;
        }

        input[type="number"] {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #c41d1d;
            margin-bottom: 10px;
        }
        
        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        button {
            display: inline-block;
            background-color: white;
            color: #c41d1d;
            border: none;
            border-radius: 20px;
            padding: 10px;
            font-size: 1em;
            text-decoration: none;
            outline: 1px solid black;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin: 10px auto;
            width: 45%;
        }

        button:hover {
            background-color: #ff948f;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete a Record</h1>

        <?php echo $message; ?>

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
        <label for="id">ID:</label>
            <input type="number" name="id" id="id" required>

        <div class="button-group">
        <form action="main_menu.php" method="get">
            <button type="submit">Exit</button>
        </form>
        <form id="deleteForm" method="POST" action="">
            <button type="button" onclick="confirmDelete()">Delete Record</button>
        </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
