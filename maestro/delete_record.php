<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM login WHERE id='$id'";

    if ($conn->query($sql)) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete a Record</title>
</head>
<body>
    <h1>Delete a Record</h1>
    <form method="POST">
        ID: <input type="number" name="id" required><br>
        <button type="submit">Delete Record</button>
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
    
</body>
</html>
