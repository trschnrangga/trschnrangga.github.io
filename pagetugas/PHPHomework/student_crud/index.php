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
            <th>Photo</th>
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
                        <td>{$row['course']}</td>";
                        
                        if (!empty($row['photo']) && file_exists("photouploads/{$row['photo']}")) {
                            echo "<td><img src='photouploads/{$row['photo']}' alt='Student Photo' style='width:150px; height:auto;'></td>";
                        } else {
                            echo "<td><p>No Photo Available</p></td>";
                        }

                echo "<td><a href='updatestudent.php?id=$row[id]'>Edit</a>&nbsp&nbsp<a href='deletestudent.php?id=$row[id]'>Delete</a>
                     </tr>";
            }
        ?>
    </table>
    <h2>List of Employee</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Department</th>
            <th>Photo</th>
            <th>Options</th>
        </tr>
        <?php
            $result = $conn->query("SELECT * FROM employees");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['department']}</td>";

                        if (!empty($row['photo']) && file_exists("photouploads/{$row['photo']}")) {
                            echo "<td><img src='photouploads/{$row['photo']}' alt='Employee Photo' style='width:150px; height:auto;'></td>";
                        } else {
                            echo "<td><p>No Photo Available</p></td>";
                        }

                echo  "<td><a href='updateemploy.php?id=$row[id]'>Edit</a>&nbsp&nbsp<a href='deleteemploy.php?id=$row[id]'>Delete</a>
                     </tr>";
            }
        ?>
    </table>
    <br>
    <a href="addstudent.php">Add Students</a><br><br>
    <a href="addemployee.php">Add Employees</a><br>
</body>
</html>