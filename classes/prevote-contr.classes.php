<?php
class RegisterContr extends Register
{
    private $v_img;
    private $name;
    private $precandidate;
    private $vicecandidate;
    private $profileid;

    public function __construct(
      $v_img, $name, $precandidate, $vicecandidate, $profileid
    ) {
        $this->v_img = $v_img;
        $this->name = $name;
        $this->precandidate = $precandidate;
        $this->vicecandidate = $vicecandidate;
        $this->profileid = $profileid;
    }
        //All fields are required!
    public function registerUser() {
        if (!$this->emptyInput()) {
            header('location: ../votecan.php?status=emptyInput');
            exit();
        }
        // if (!$this->invalidEmail()) {
        //     header('location: ../votecan.php?status=invalidEmail');
        //     exit();
        // }
        if (!$this->idTakenCheck()) {
            header('location: ../votecan.php?status=useroremailtaken');
            exit();
        }

        // If all checks pass, proceed with user registration
        $this->setUser(
            $this->v_img,
            $this->name,
            $this->precandidate,
            $this->vicecandidate,
            $this->profileid,
        );

    }

    private function emptyInput() {
        // Check for empty inputs
        return !(
            empty($this->name) ||
            empty($this->precandidate) ||
            empty($this->vicecandidate)
        );
    }

    // private function invalidEmail() {
    //     // Validate email format
    //     return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    // }

    private function idTakenCheck() {
        // Check if username or email is already taken
        return $this->checkUser($this->name);
    }
}
