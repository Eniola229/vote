<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register extends Dbh
{
    protected function sendEmail($name, $profileid, $email)
    {
        // Load Composer's autoloader
        require '../vendor/autoload.php';

        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'rhcwebmailer@gmail.com'; // SMTP username
            $mail->Password   = 'yrkddeezyduwkodd'; // App-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port       = 465; // TCP port to connect to

            //Recipients
            $mail->setFrom('rhcwebmailer@gmail.com', 'RECTEM'); // Fixed sender name
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'RECTEM Candidate Registration';
            $email_template  = "<strong>Dear ". $name ."!</strong><br/>"
                             . "<p>your Registration has been Successful:</p>"
                             . "<p>your Profile Number " . $profileid . "</p>"
                             . "<p>Thank you!</p>>"
                             . "<br/><b>StellarMind</b>";
            $mail->Body = $email_template;

            // Attempt to send the email
            if ($mail->send()) {
                header("location: ../login.php?status=emailsent");
                exit(); // Added exit after header redirect
            } else {
                header("location: ../register.php?status=sentemailfailed&error=" . urlencode($mail->ErrorInfo));
                exit(); // Added exit after header redirect
            }
        } catch (Exception $e) {
            header("location: ../register.php?status=sentemailfailed&error=" . urlencode($e->getMessage()));
            exit(); // Added exit after header redirect
        }
    }

   protected function setUser($profile_pics, $name, $gender, $email, $dob, $state, $dep, $level, $position, $why, $matric, $pass_word, $profileid)
{
    // Hash the password
    $hashedPwd = password_hash($pass_word, PASSWORD_DEFAULT);

    $uploadStatus = ""; // To store debug messages

    // Check if a file was uploaded
    if (isset($_FILES['profile_pics']) && $_FILES['profile_pics']['size'] > 0) {
        $file_name = $_FILES['profile_pics']['name'];
        $file_tmp = $_FILES['profile_pics']['tmp_name'];
        $file_type = $_FILES['profile_pics']['type'];
        $file_size = $_FILES['profile_pics']['size']; // Get the file size

        // Array of allowed image file types
        $allowed_image_types = array('image/jpeg', 'image/png', 'image/gif');
        $max_file_size = 2 * 1024 * 1024; // 2MB in bytes

        // Check if the uploaded file type is allowed
        if (in_array($file_type, $allowed_image_types)) {
            // Resize the image if it exceeds the max file size
            if ($file_size > $max_file_size) {
                try {
                    $file = new Imagick($file_tmp);
                    $file->setImageCompressionQuality(80); // Adjust the quality 
                    $file->writeImage($file_tmp);
                } catch (ImagickException $e) {
                    header("location: ../register.php?status=imageerror");
                    exit();
                }
            }

            // File is an image
            $uploadDirectory = '../can_profile_pics/';
            // Generate a unique name for the file
            $uniqueFileName = uniqid() . '_' . $file_name;
            // Move the uploaded file to the server
            $uploadPath = $uploadDirectory . $uniqueFileName;

            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $uploadStatus = "File uploaded successfully.";
            } else {
                // Error in moving the file
                header("location: ../register.php?status=fileuploaderror");
                exit();
            }
        } else {
            // File type is not allowed
            header("location: ../register.php?status=invalidfiletype");
            exit();
        }
    } else {
        // Handle the case where no file was uploaded
        $uniqueFileName = "no_file_uploaded";
    }

    // Debug output for file upload status
    echo "Debug: $uploadStatus";

    // Prepare the SQL statement
    $stmt = $this->connect()->prepare('INSERT INTO candidates (profile_pics, name, gender, email, dob, state, dep, level, position, why, matric,pass_word, profileid)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

    // Bind the parameters and execute the statement
    if (!$stmt->execute(array($uniqueFileName, $name, $gender, $email, $dob, $state, $dep, $level, $position, $why, $matric, $hashedPwd, $profileid))) {
        $stmt = null;
        header("location: ../register.php?status=stmtfailed");
        exit();
    }
    $stmt = null;
}

    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM candidates WHERE email = ?');

        if (!$stmt->execute(array($email))) 
        {
            $stmt = null;
            header("location: ../register.php?status=usertaken");
            exit();
        }

        $resultCheck = $stmt->rowCount() > 0 ? false : true;
        return $resultCheck;
    }

    protected function getUserId($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM candidates WHERE email = ?;');

        $stmt->execute([$email]); // Execute the prepared statement

        if ($stmt->rowCount() == 0) {
            // If no user is found, redirect with an appropriate status
            header("location: ../register.php?status=stmtfailed");
            exit();
        }

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData['email'];
    }
}
