<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom, #fae2e2, #ffbcba, #ff948f, #ff6962, #ff3333); /* Gradient background */
        }

        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 800px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin: 0 0 20px;
            color: #c41d1d; /* Red color for the heading */
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table thead {
            background-color: #c41d1d;
            color: white;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
        }

        table th:first-child {
            border-top-left-radius: 10px;
        }

        table th:last-child {
            border-top-right-radius: 10px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #ffe6e6;
        }

        button {
            display: inline-block;
            background-color: white;
            color: #c41d1d;
            border: 2px solid #c41d1d;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: #c41d1d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>List Records</h1>

        <?php
        $conn = new mysqli("localhost", "root", "", "maestro");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM login";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Created Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo $row['Role']; ?></td>
                            <td><?php echo $row['CreatedDate']; ?></td>
                            <td><?php echo $row['Remarks']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif;

        $conn->close();
        ?>

        <form action="main_menu.php" method="get">
            <button type="submit">Exit</button>
        </form>
    </div>
</body>
</html>
