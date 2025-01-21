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
        echo "<script>alert('Record updated successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Record</title>
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
            width: 500px;
        }

        h1 {
            font-size: 2em;
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
            margin-bottom: 10px;
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
            width: 60%;
        }

        button:hover {
            background-color: #ff948f;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit a Record</h1>
        <form method="POST">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required><br>

            <label for="created_date">Created Date:</label>
            <input type="date" id="created_date" name="created_date" required><br>

            <label for="remarks">Remarks:</label>
            <input type="text" id="remarks" name="remarks" required><br>

            <div class="button-group">
                <button type="submit">Update Record</button>
            </div>
        </form>
        <form action="main_menu.php" method="get">
            <button type="submit">Exit</button>
        </form>
    </div>
</body>
</html>
