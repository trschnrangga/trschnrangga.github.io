<?php
    include 'config.php';

    $id = $_GET['id'];

    if (isset($id)) {

        $sql = "SELECT photo FROM employees WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();


            if ($stmt->num_rows > 0) {
                $stmt->bind_result($photo); 
                $stmt->fetch();

                $file_path = "photouploads/" . $photo;
                if (file_exists($file_path)) {
                    unlink($file_path); 
                }


                $delete_sql = "DELETE FROM employees WHERE id = ?";
                if ($delete_stmt = $conn->prepare($delete_sql)) {
                    $delete_stmt->bind_param("i", $id);
                    if ($delete_stmt->execute()) {
                        echo "Employee record and photo deleted successfully!";
                    } else {
                        echo "Error deleting record: " . $delete_stmt->error;
                    }

                    $delete_stmt->close();
                } else {
                    echo "Error preparing delete query: " . $conn->error;
                }
            } else {
                echo "Record not found!";
            }

            $stmt->close();
        } else {
            echo "Error preparing the query: " . $conn->error;
        }
    } else {
        echo "No ID provided!";
    }


    header("Location: index.php");
    exit;
?>