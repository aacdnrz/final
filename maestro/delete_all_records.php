<?php
$conn = new mysqli("localhost", "root", "", "maestro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM login";

    if ($conn->query($sql)) {
        echo "All records deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete All Records</title>
    <script type="text/javascript">
        // JavaScript function to confirm before submitting the delete all form
        function confirmDeleteAll() {
            var result = confirm("Are you sure you want to delete all records?");
            if (result) {
                document.getElementById("deleteAllForm").submit(); // Submit the form if confirmed
            }
        }
    </script>
</head>
<body>
    <h1>Delete All Records</h1>
    
    <form id="deleteAllForm" method="POST" action="">
        <button type="button" onclick="confirmDeleteAll()">Delete All Records</button> <!-- Calls confirmDeleteAll function -->
    </form>

    <form action="main_menu.php" method="get">
        <button type="submit">Exit</button>
    </form>
</body>
</html>
