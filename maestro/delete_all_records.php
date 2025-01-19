<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM login";

    if ($conn->query($sql)) {
        echo "All records deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete All Records</title>
</head>
<body>
    <h1>Delete All Records</h1>
    <form method="POST">
        <button type="submit">Delete All Records</button>
    </form>
</body>
</html>
