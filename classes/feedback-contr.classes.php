<?php
class RegisterContr extends Register
{
    private $name;
    private $email;
    private $candidates;
    private $msg;

    public function __construct(
        $name,
        $email,
        $candidates,
        $msg,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->candidates = $candidates;
        $this->email = $email;
        $this->msg = $msg;
}
    public function registerUser(
        $name,
        $email,
        $candidates,
        $msg,
    ) {
        // Assign the parameters to the properties
        $this->name = $name;
        $this->email = $email;
        $this->candidates = $candidates;
        $this->email = $email;
        $this->msg = $msg;

        if ($this->emptyInput() == false) {
             header('Location: ../index.php?status=emptyInput');
            exit();
        }
        if ($this->invalidEmail() == false) {
            header('Location: ../index.php?status=invalidEmail');
            exit();
        }

        // If all checks pass, proceed with user registration
        $this->setUser(
            $this->name,
            $this->email,
            $this->candidates,
            $this->msg,
        );

        // Send confirmation email
        $this->sendEmail($this->email, $this->did);
    }

    private function emptyInput() {
        // Check for empty inputs
        return !empty($this->email) && !empty($this->candidates)  && !empty($this->name) && !empty($this->msg);
    }

    private function invalidEmail() {
        // Validate email format
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function idTakenCheck()
    {
        // Check if username or email is already taken
        return $this->checkUser($this->email);
    }
}
?>
