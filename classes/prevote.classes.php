<?php

class Register extends Dbh
{
    protected function setUser($v_img, $name, $precandidate, $vicecandidate, $profileid)
    {

    $uploadStatus = ""; // To store debug messages

    // Check if a file was uploaded
    if (isset($_FILES['v_img']) && $_FILES['v_img']['size'] > 0) {
        $file_name = $_FILES['v_img']['name'];
        $file_tmp = $_FILES['v_img']['tmp_name'];
        $file_type = $_FILES['v_img']['type'];
        $file_size = $_FILES['v_img']['size']; // Get the file size

        // Array of allowed image file types
        $allowed_image_types = array('image/jpeg', 'image/png', 'image/gi');
        $max_file_size = 2 * 1024 * 1024; // 2MB in bytes

        // Check if the uploaded file type is allowed
        if (in_array($file_type, $allowed_image_types)) {
            // Resize the image if it exceeds the max file size

            // File is an image
            $uploadDirectory = '../voter_recognision/';
            // Generate a unique name for the file
            $uniqueFileName = uniqid() . '_' . $file_name;
            // Move the uploaded file to the server
            $uploadPath = $uploadDirectory . $uniqueFileName;

            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $uploadStatus = "File uploaded successfully.";
            } else {
                // Error in moving the file
                header("location: ../votecan.php?status=fileuploaderror");
                exit();
            }
        } else {
            // File type is not allowed
            header("location: ../votecan.php?status=invalidfiletype");
            exit();
        }
    } else {
        // Handle the case where no file was uploaded
        $uniqueFileName = "no_file_uploaded";
    }

    // Debug output for file upload status
    echo "Debug: $uploadStatus";

        $stmt = $this->connect()->prepare('INSERT INTO presidential (v_img, name, precandidate, vicecandidate, profileid) VALUES (?, ?, ?, ?, ?);');

        if (!$stmt->execute([$uniqueFileName, $name, $precandidate, $vicecandidate, $profileid])) {
            $stmt = null;
            header("location: ../votecan.php?status=stmtfailed");
            exit();
        } else {
            header("Location: ../secvote.php?name=" . $name);
            exit(); 
        }

        $stmt = null;
    }

    protected function checkUser($name)
    {
        $stmt = $this->connect()->prepare('SELECT id FROM presidential WHERE name = ?');

        if (!$stmt->execute([$name])) {
            $stmt = null;
            header("location: ../votecan.php?status=usertaken");
            exit();
        }

        $resultCheck = $stmt->rowCount() > 0 ? false : true;
        return $resultCheck;
    }
}
