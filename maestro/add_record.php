<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_record'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $created_date = $_POST['created_date'];
    $remarks = $_POST['remarks'];

    $sql = "INSERT INTO login (Username, Password, Role, CreatedDate, Remarks) 
            VALUES ('$username', '$password', '$role', '$created_date', '$remarks')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<p>Record added successfully.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Record</title>
</head>
<body>
    <h1>Add a New Record</h1>
    <form method="post" action="add_record.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" required><br><br>
        
        <label for="created_date">Created Date:</label>
        <input type="date" id="created_date" name="created_date" required><br><br>
        
        <label for="remarks">Remarks:</label>
        <input type="text" id="remarks" name="remarks"><br><br>
        
        <button type="submit" name="add_record">Add Record</button>
    </form>

    <!-- Exit Button -->
    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
</body>
</html>
