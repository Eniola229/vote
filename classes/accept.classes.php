<?php
include_once "../classes/dbh.classes.php";
include_once "../vendor/autoload.php"; // Adjust the path to autoload.php if necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserApproval extends Dbh {
    public function approveUser($email, $user_id) {
        try {
            // Establish a database connection
            $pdo = $this->connect();

            // Prepare and execute the update query
            $stmt = $pdo->prepare("UPDATE candidates SET role = '1' WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user_id]);

            // Send confirmation email
            $this->sendEmail($email);

            // Redirect back to the previous page with status=approved parameter
            header("Location: ../newcan.php?status=approved");
            exit();
        } catch (PDOException $e) {
            // Handle database errors
            error_log("Database error: " . $e->getMessage());
            header("Location: ../newcan.php?status=errora");
            exit();
        }
    }

    protected function sendEmail($email) {
        try {
            $mail = new PHPMailer(true);
            
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jasonsappmailer@gmail.com';
            $mail->Password = 'fnzdftwlxkmqaahh';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Email content
            $mail->setFrom('jasonsappmailer@gmail.com', 'RECTEM');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Congratulations |  RECTEM';
            $email_template = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Admission Offer</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333;
                    }
                    .container {
                        width: 100%;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background-color: #f9f9f9;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .header h4 {
                        color: #4CAF50;
                    }
                    .content {
                        margin-bottom: 20px;
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        color: #777;
                    }
                    .footer b {
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>RECTEM Admission</h1>
                    </div>
                    <div class="content">
                        <p>Your Account has been activated <strong>RECTEM</strong>.</p>
                        <h4>Welcome!!!</h4>
                        <p>Kindly visit the school.</p>
                    </div>
                    <div class="footer">
                        <p><b>Warm Regards</b></p>
                    </div>
                </div>
            </body>
            </html>';

            $mail->Body = $email_template;

            // Send the email
            $mail->send();
        } catch (Exception $e) {
            // Handle email sending errors
            error_log("Error sending email: " . $e->getMessage());
        }
    }
}

// Check if email and user_id parameters exist
if (isset($_GET['email']) && isset($_GET['user_id'])) {
    $email = $_GET['email'];
    $user_id = $_GET['user_id'];

    // Create an instance of UserApproval class
    $userApproval = new UserApproval();

    // Approve the user and send confirmation email
    $userApproval->approveUser($email, $user_id);
} else {
    // If email or user_id parameter is not provided, redirect to an error page or handle the error accordingly
    header("Location: ../newcan.php?status=errora");
    exit();
}
?>
