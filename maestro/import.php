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
    // File upload and validation
    if ($_FILES['csv_file']['name']) {
        $filename = $_FILES['csv_file']['tmp_name'];
        $file = fopen($filename, "r");

        // Delete all existing records
        $conn->query("DELETE FROM login");

        // Skip the first row (header)
        fgetcsv($file);

        // Loop through CSV rows
        while (($data = fgetcsv($file)) !== FALSE) {
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
        echo "CSV file imported successfully.";
    } else {
        echo "Please upload a valid CSV file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import CSV</title>
</head>
<body>
    <h1>Import CSV File</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv">
        <button type="submit" name="import_csv">Import</button>
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
    
</body>
</html>
