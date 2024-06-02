<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends Dbh
{
    protected function CheckLogin($email)
    {
        require '../vendor/autoload.php';

        try {
            $mail = new PHPMailer(true);
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rhcwebmailer@gmail.com'; // Replace with your email
            $mail->Password = 'yrkddeezyduwkodd'; // Replace with your password or use environment variables
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('rhcwebmailer@gmail.com', 'RECTEM'); // Replace with your email
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Alert!!! | RECTEM Team';
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $email_template = "Someone tried to login! Was this you?" .
                "" .
                "<p>Time Logged In: " . date('Y-m-d H:i:s') . 
                "<p>$userAgent</p>".
                "<b>StellarMind Team</b>";

            $mail->Body = $email_template;
            
            if ($mail->send()) {
                return true;
            } else {
                throw new Exception('Email sending failed.');
            }
        } catch (Exception $e) {
            error_log("Error sending email: " . $e->getMessage());
            return false;
        }
    }

    

    protected function getUser($email, $pass_word)
    {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM candidates WHERE email = ?;');
            if (!$stmt->execute([$email])) {
                throw new Exception('Error executing query.');
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($pass_word, $user['pass_word'])) {
                return false;
            }  

            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['gender'] = $user['gender'];
            $_SESSION['profile_pics'] = $user['profile_pics'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['position'] = $user['position'];
            $_SESSION['gender'] = $user['gender'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['matric'] = $user['matric'];
            $_SESSION['profileid'] = $user['profileid'];
            $_SESSION['created_at'] = $user['created_at'];

            $stmt = null;

            return $user;
        } catch (Exception $e) {
            error_log("Error fetching user data: " . $e->getMessage());
            return false;
        }
    }
}
