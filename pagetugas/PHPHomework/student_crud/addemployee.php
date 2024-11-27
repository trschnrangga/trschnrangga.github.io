<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Employee</title>
    <style>
        input {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <h2>Add Employee</h2><br>
    <form method="post" action="addemployee.php" enctype="multipart/form-data"> <!-- Added enctype -->
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>

        <label for="age">Age</label>
        <input type="number" id="age" name="age" required><br>

        <label for="department">Department</label>
        <input type="text" id="department" name="department"><br>

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
        $department = $_POST['department'];


        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name'];
            $tmp = $_FILES['photo']['tmp_name'];


            $newphoto = date('dmYHis') . '_' . $photo;


            $path = "photouploads/" . $newphoto;


            if (move_uploaded_file($tmp, $path)) {

                $sql = "INSERT INTO employees (name, email, age, department, photo) VALUES (?, ?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ssiss", $name, $email, $age, $department, $newphoto);

                    if ($stmt->execute()) {
                        echo "New employee added successfully!";
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
