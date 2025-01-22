<?php
$conn = new mysqli("localhost", "root", "", "maestro");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_record'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $created_date = $_POST['created_date'];
    $remarks = $_POST['remarks'];


    // Check if username already exists
    $check_sql = "SELECT COUNT(*) FROM login WHERE Username = '$username'";
    $result = mysqli_query($conn, $check_sql);
    $row = mysqli_fetch_row($result);
    $count = $row[0];


    if ($count > 0) {
        echo "<script>alert('Username already exists!');</script>";
    } else {
        // Insert the record
        $sql = "INSERT INTO login (Username, Password, Role, CreatedDate, Remarks)
                VALUES ('$username', '$password', '$role', '$created_date', '$remarks')";
       
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record added successfully.');</script>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
        }
    }
}


// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
   
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #fae2e2, #ffbcba, #ff948f, #ff6962, #ff3333);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .container {
            background-color: #c41d1d;
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 30px;
            width: 500px;
        }


        h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }


        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
            margin-left: 30px;
        }


        input {
            width: 85%;
            padding: 8px;
            margin-bottom: 15px;
            border: none;
            border-radius: 8px;
            outline: 1px solid black;
        }


        form {
            margin-bottom: 20px;
        }


        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }


        button {
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
            text-align: center;
            width: 60%;
            margin-left: 3rem;
        }


        button:hover {
            background-color: #ff948f;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
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


            <div class="button-group">
                <button type="button" onclick="window.location.href='main_menu.php';">Exit</button>
                <button type="submit" name="add_record">Add Record</button>
            </div>


        </form>
   
    </div>


</body>
</html>
