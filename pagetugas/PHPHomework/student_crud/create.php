
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert new data</title>
    <style>
        input{
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <form method="post" action="create.php">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required><br>
        <label for="age">Age</label>
        <input type="number" id="age" name="age" required><br>
        <label for="course">Course</label>
        <input type="text" id="course" name="course"><br>
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


        $sql = "INSERT INTO students(name, email, age, course) VALUES (?, ?, ?, ?)";


        if ($stmt = $conn->prepare($sql)) {

            $stmt->bind_param("ssis", $name, $email, $age, $course);


            if ($stmt->execute()) {
                echo "New student added successfully!";
            } else {
                echo "Error: " . $stmt->error; 
            }

            $stmt->close();
        } else {
            echo "Error preparing the query: " . $conn->error;
        }

        header("Location: index.php");
    }
?>
</html>
