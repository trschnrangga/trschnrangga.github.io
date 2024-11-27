<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Data</title>
    <style>
        input {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <h2>Add Student</h2><br>
    <form method="post" action="addstudent.php" enctype="multipart/form-data"> <!-- Added enctype -->
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>
        <label for="age">Age</label>
        <input type="number" id="age" name="age" required><br>
        <label for="course">Course</label>
        <input type="text" id="course" name="course"><br>
        <label for="photo">Photo</label>
        <input type="file" name="photo" required><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
<?php
    include 'config.php';

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $course = $_POST['course'];


        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];

            $newphoto = date('dmYHis') . '_' . $photo;


            $path = "photouploads/" . $newphoto;


            if (move_uploaded_file($tmp, $path)) {

                $sql = "INSERT INTO students (name, email, age, course, photo) VALUES (?, ?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ssiss", $name, $email, $age, $course, $newphoto);

                    if ($stmt->execute()) {
                        echo "New student added successfully!";
                        header("Location: index.php");
                        exit;
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Error preparing the query: " . $conn->error;
                }
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "Error uploading file.";
        }
    }
?>
</html>
