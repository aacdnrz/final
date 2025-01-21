<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maestro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM login";

    if ($conn->query($sql)) {
        $message = "<p style='color: green;'>All records deleted successfully.</p>";
    } else {
        $message = "<p style='color: red;'>Error deleting records: " . $conn->error . "</p>";
    }
}

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
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            box-sizing: border-box;
            text-align: center;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 800px;
        }

        h1 {
            font-size: 40px;
            color: #c41d1d;
            text-align: center;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 10px;
        }

        table thead {
            background-color: #c41d1d;
            color: white;
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

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        button {
            display: inline-block;
            background-color: white;
            color: #c41d1d;
            border: 2px solid #c41d1d;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin: 10px auto;
            width: 70%;
        }

        button:hover {
            background-color:  #ff948f;
            color: white;
            transform: scale(1.05);
        }
    </style>
    <script type="text/javascript">
        function confirmDeleteAll() {
            var result = confirm("Are you sure you want to delete all records?");
            if (result) {
                document.getElementById("deleteAllForm").submit(); // Submit the form if confirmed
            }
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
        <div class="button-group">
            <form action="main_menu.php" method="get">
                <button type="submit">Exit</button>
            </form>
            <form id="deleteAllForm" method="POST" action="">
                <button type="button" onclick="confirmDeleteAll()">Delete All Records</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
