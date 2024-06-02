<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
  
class Register extends Dbh
{
    protected function sendEmail($email)
    {
        // Load Composer's autoloader
        require '../vendor/autoload.php';

        $mail = new PHPMailer(true);
        
            try {
               
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'rhcwebmailer@gmail.com';
                $mail->Password   = 'yrkddeezyduwkodd';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
        
                $mail->setFrom('rhcwebmailer@gmail.com', 'RHC HEALTH MANAGEMENT');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'RECTEM VOTING PLAFORM';
                $email_template  = "<strong>Your feedback has been sent!</strong><br/><p>"
                                 . "<p>We will get back to you very soon!</p>"
                                 . "<br/><b>RECTEM TEAM</b>";
                $mail->Body = $email_template;

            // Attempt to send the email
            if ($mail->send()) {
               header("Location: ../success.php?status=success");
                exit(); 
            } else {
                header('Location: ../index.php?status=sentemailfailed');
                exit();
            }
        } catch (Exception $e) {
             header('Location: ../index.php?status=sentemailfailed');
            exit();
        }
        
    }

    protected function setUser($name, $email, $candidates, $msg)
    {
       // Prepare the SQL statement
        $stmt = $this->connect()->prepare('INSERT INTO feedback (name, email, candidates, msg) 
        VALUES (?, ?, ?, ?);');

        // Bind the parameters and execute the statement
        if (!$stmt->execute(array($name, $email, $candidates, $msg))) {
            $stmt = null;
            header('Location: ../index.php?status=stmtfailed');
            exit();
        }
    }


    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM feedback WHERE email = ?');

        if (!$stmt->execute(array($email))) 
        {
            $stmt = null;
            header("location: ../index.php?status=usertaken");
            exit();
        }

        $resultCheck = $stmt->rowCount() > 0 ? false : true;
        return $resultCheck;
    }

    protected function getUserId($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM feedback WHERE email = ?;');

        $stmt->execute([$email]); // Execute the prepared statement

        if ($stmt->rowCount() == 0) {
            // If no user is found, redirect with an appropriate status
            header("location: ../index.php?status=stmtfailed");
            exit();
        }

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData['email'];
    }

    public function registerUser($name, $email, $candidates, $msg)
    {
        //Check if user already exists
        if (!$this->checkUser($email)) {
            header("Location: ../index.php?status=usertaken");
            exit();
        }

        // Insert user into database
        $this->setUser($name, $email, $candidates, $msg);

        // // Create session for the user
        // $this->createSession($email);
    }
}



