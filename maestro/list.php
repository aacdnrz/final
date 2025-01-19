<!DOCTYPE html>
<html>
<head>
    <title>List Records</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "maestro");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM login";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Remarks</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['Role']}</td>
                    <td>{$row['CreatedDate']}</td>
                    <td>{$row['Remarks']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }

    $conn->close();
    ?>

<form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
    
</body>
</html>
