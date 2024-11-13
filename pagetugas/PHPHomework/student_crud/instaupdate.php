<?php
    include 'config.php';

    $id = $_GET['id'];

    if (isset($_POST['update'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        // Prepare the SQL insert statement with placeholders
        $sql = "UPDATE students SET name=?, email=?, course=? WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters (s = string, i = integer)
            $stmt->bind_param("sssi", $name, $email, $course, $id);

            // Execute the statement and check if it succeeded
            if ($stmt->execute()) {
                echo "Student Updated!";
            } else {
                echo "Error: " . $stmt->error;  // Output error if execution fails
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the query: " . $conn->error;
        }

        header("Location:index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
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
        input{
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Course</th>
            <?php
                $result = $conn->query("SELECT * FROM students WHERE id=$id");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['course']}</td>
                         </tr>";
                        }
            ?>
        </tr>
    </table>
    <br><br>
    <form action="instaupdate.php?id=<?php echo $id; ?>" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"><br>
        <label for="course">Course</label>
        <input type="text" id="course" name="course"><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>