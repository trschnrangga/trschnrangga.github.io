<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Tables</title>
    <style>
        table{
            border: 1px solid black;
        }
        th, td {
        border: 1px solid black; 
        padding: 8px; 
        text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>List of Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Course</th>
            <th>Options</th>
        </tr>
        <?php
            $result = $conn->query("SELECT * FROM students");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['course']}</td>
                        <td><a href='instaupdate.php?id=$row[id]'>Edit</a>&nbsp&nbsp<a href='instadelete.php?id=$row[id]'>Delete</a>
                     </tr>";
            }
        ?>
    </table>
    <br>
    <a href="create.php">Add Students</a><br><br>
</body>
</html>