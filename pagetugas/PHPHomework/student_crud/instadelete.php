<?php
    include 'config.php';

    $id = $_GET['id'];

    $delete = mysqli_query($conn, "DELETE FROM students WHERE id=$id");

    header("Location:index.php")
?>