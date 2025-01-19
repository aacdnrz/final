<?php
$conn = new mysqli("localhost", "root", "", "maestro");

$sql = "SELECT * FROM login";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
                <td>{$row['Username']}</td>
                <td>{$row['Password']}</td>
                <td>{$row['Role']}</td>
                <td>{$row['CreatedDate']}</td>
                <td>{$row['Remarks']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}
?>
