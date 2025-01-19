<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $createdDate = $_POST['created_date'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO login (Username, Password, Role, CreatedDate, Remarks) 
            VALUES ('$username', '$password', '$role', '$createdDate', '$remarks')";

    if ($conn->query($sql)) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Record</title>
</head>
<body>
    <h1>Add New Record</h1>
    <form method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Role: <input type="text" name="role" required><br>
        Created Date: <input type="date" name="created_date" required><br>
        Remarks: <input type="text" name="remarks"><br>
        <button type="submit">Add Record</button>
    </form>
</body>
</html>
