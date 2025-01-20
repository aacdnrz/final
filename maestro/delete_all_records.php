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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete All Records</title>
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
            text-align: left;
            margin-left: 10px;
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
            width: 50%;
        }

        button:hover {
            background-color:  #ff948f;
            color: white;
        }
    </style>
    <script type="text/javascript">
        function confirmDeleteAll() {
            var result = confirm("Are you sure you want to delete all records?");
            if (result) {
                document.getElementById("deleteAllForm").submit(); 
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Delete All Records</h1>

        <?php 
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
    </div>
</body>
</html>

<?php
$conn->close();
?>
