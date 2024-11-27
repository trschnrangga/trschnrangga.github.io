<?php
    include 'config.php';


    $id = $_GET['id'];


    if (isset($_POST['update'])) {


        $name = $_POST['name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $photo = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];


        if (!empty($photo)) {

            $newphoto = date('dmYHis') . '_' . $photo;
            $path = "photouploads/" . $newphoto;


            $result = $conn->query("SELECT photo FROM students WHERE id=$id");
            $data = $result->fetch_assoc();


            if (is_file("photouploads/" . $data['photo'])) {
                unlink("photouploads/" . $data['photo']);
            }


            move_uploaded_file($tmp, $path);
        } else {
            //if no photo is uploaded use the old one
            $result = $conn->query("SELECT photo FROM students WHERE id=$id");
            $data = $result->fetch_assoc();
            $newphoto = $data['photo']; 
        }

        $sql = "UPDATE students SET name=?, email=?, course=?, photo=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $name, $email, $course, $newphoto, $id);


            if ($stmt->execute()) {
                echo "Student Updated!";
            } else {
                echo "Error: " . $stmt->error;
            }


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
        table {
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
        input {
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
            <th>Photo</th>
        </tr>
        <?php

            $result = $conn->query("SELECT * FROM students WHERE id=$id");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['course']}</td>
                        <td><img src='photouploads/{$row['photo']}' alt='Student Photo' width='50'></td>
                    </tr>";
            }
        ?>
    </table>
    <br><br>

    <form action="updatestudent.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <?php

            $result = $conn->query("SELECT * FROM students WHERE id=$id");
            $row = $result->fetch_assoc();
        ?>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"><br>

        <label for="course">Course</label>
        <input type="text" id="course" name="course" value="<?php echo $row['course']; ?>"><br>

        <label for="photo">Photo</label>
        <input type="file" name="photo"><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
