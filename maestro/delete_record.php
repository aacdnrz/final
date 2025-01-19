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
    <script type="text/javascript">
        // JavaScript function to confirm before submitting the delete form
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                document.getElementById("deleteForm").submit(); // Submit the form if confirmed
            }
        }
    </script>
</head>
<body>
    <h1>Delete a Record</h1>
    
    <form id="deleteForm" method="POST" action="">
        ID: <input type="number" name="id" required><br><br>
        <button type="button" onclick="confirmDelete()">Delete Record</button> <!-- Calls confirmDelete function -->
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
</body>
</html>
