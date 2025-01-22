<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maestro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['import_csv'])) {
    // Validate file upload
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
        $filename = $_FILES['csv_file']['tmp_name'];

        if (($file = fopen($filename, "r")) !== FALSE) {
            // Delete all existing records
            $conn->query("DELETE FROM login");

            // Skip the first row (header)
            fgetcsv($file);

            // Process CSV rows
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $id = $data[0];
                $username = $data[1];
                $password = $data[2];
                $role = $data[3];
                $createdDate = date('Y-m-d', strtotime($data[4])); // Convert date format
                $remarks = $data[5];

                // Insert record into the database
                $sql = "INSERT INTO login (id, Username, Password, Role, CreatedDate, Remarks) 
                        VALUES ('$id', '$username', '$password', '$role', '$createdDate', '$remarks')";

                if (!$conn->query($sql)) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            fclose($file);
            echo "<script>alert('CSV file imported successfully');</script>";
        } 
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import CSV</title>
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
            font-size: 2em;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="file"] {
            display: block;
            background-color: white;
            color: #c41d1d;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 1em;
            text-decoration: none;
            outline: 1px solid black;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin: 10px auto;
            text-align: center;
            width: 90%;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            margin-left: rem;
            width: 200%;
        }
        .exit-button {
         margin-top: 5px; /* Adjust this value to bring it closer */
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
            width: 50%; 
            margin-top: 20px;
        }

        button:hover {
            background-color: #ff948f;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Import CSV File</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" required>
            <button type="submit" name="import_csv">Import</button>
        </form>

        <div class="button-group">
            <form action="main_menu.php" method="get">
                <button type="submit" class="exit-button">Exit</button>
            </form>
        </div>

    </div>
</body>
</html>
