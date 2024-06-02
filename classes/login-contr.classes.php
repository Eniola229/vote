<?php 
class LoginContr extends Login
{
    private $email;
    private $pass_word;

    public function __construct($email, $pass_word)
    {
        $this->email = $email;
        $this->pass_word = $pass_word;
    }

    public function loginUser()
    {
        session_start();

        if ($this->emptyInput() == false) {
            header('Location: ../login.php?status=emptyinput');
            exit;
        }
        
        $userData = $this->getUser($this->email, $this->pass_word);
        if (!$userData) {
            header('Location: ../login.php?status=loginfailed');
            exit;
        }

        if (!$this->CheckLogin($this->email)) {
            error_log("Failed to send login email notification.");
        }

       
        $_SESSION['role'] = $userData['role']; 

        if ($_SESSION['role'] == "" || $_SESSION['role'] == "0") {
             header("Location: ../login.php?status=waitforaprroval");
             exit;  
           
        } else {
            header("Location: ../dashboard.php");
            exit;  
        } 
    }

    private function emptyInput()
    {
        return !empty($this->email) && !empty($this->pass_word);
    }
}
