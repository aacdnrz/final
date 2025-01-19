<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $createdDate = $_POST['created_date'];
    $remarks = $_POST['remarks'];

    $sql = "UPDATE login SET Username='$username', Password='$password', Role='$role', 
            CreatedDate='$createdDate', Remarks='$remarks' WHERE id='$id'";

    if ($conn->query($sql)) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit a Record</title>
</head>
<body>
    <h1>Edit a Record</h1>
    <form method="POST">
        ID: <input type="number" name="id" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Role: <input type="text" name="role" required><br>
        Created Date: <input type="date" name="created_date" required><br>
        Remarks: <input type="text" name="remarks"><br>
        <button type="submit">Update Record</button>
    </form>
</body>
</html>
