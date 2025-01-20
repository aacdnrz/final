<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .main-menu {
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

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0 auto; 
            display: grid;
            grid-template-columns: 1fr 1fr; 
            gap: 10px;
            justify-content: center; 
        }

        ul li {
            margin: 0;
        }

        a {
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
            text-align: center;
        }

        a:hover {
            background-color: #ff948f;
            color: white;
        }

        .exit-button {
            width: 50%;
            background-color: white;
            color: #c41d1d;
            font-weight: bold;
            margin-top: 20px;
            margin-left: auto; 
            margin-right: auto; 
            border: none;
            padding: 10px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 20px;
            outline: none;
        }

        .exit-button:hover {
            background-color: #ff948f;
            outline: 1px solid black;
            color: white;
        }
    </style>
    <title>Main Menu</title>
</head>
<body>
    <div class="main-menu">
        <h1>Main Menu</h1>
        <ul>
            <li><a href="add_record.php">Add New Record</a></li>
            <li><a href="edit_record.php">Edit a Record</a></li>
            <li><a href="delete_record.php">Delete a Record</a></li>
            <li><a href="delete_all_records.php">Delete All Records</a></li>
            <li><a href="list.php">List All Records</a></li>
            <li><a href="import.php">Import CSV File</a></li>
        </ul>
        <form action="login.php" method="post">
            <button type="submit" class="exit-button">Exit</button>
        </form>
    </div>
</body>
</html>
