<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Records</title>
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
            width: 80%;
            max-width: 800px;
        }

        h1 {
            font-size: 2em;
            text-align: left;
            margin-left: 10px;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            background-color: white;
        }

        table, th, td {
            border: 1px solid #c41d1d;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
            width: 50%;
        }

        button:hover {
            background-color:  #ff948f;
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
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Remarks</th>
                </tr>
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
