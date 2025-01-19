<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
</head>
<body>
    <h1>Main Menu</h1>
    <ul>
        <li><a href="add_record.php">Add New Record</a></li>
        <li><a href="edit_record.php">Edit a Record</a></li>
        <li><a href="delete_record.php">Delete a Record</a></li>
        <li><a href="delete_all_records.php">Delete All Records</a></li>
        <li><a href="list.php">List All Records</a></li>
        <li><a href="import.php">Import CSV File</a></li>
        <li>
            <!-- Exit Button -->
            <form action="login.php" method="post" style="display: inline;">
                <button type="submit">Exit</button>
            </form>
        </li>
    </ul>
</body>
</html>
