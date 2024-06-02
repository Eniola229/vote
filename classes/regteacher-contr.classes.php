<?php
class RegisterContr extends Register
{
    private $profile_pics;
    private $name;
    private $gender;
    private $email;
    private $dob;
    private $state;
    private $dep;
    private $leve;
    private $position;
    private $why;
    private $matric;
    private $pass_word;
    private $profileid;

    public function __construct(
        $profile_pics, $name, $gender, $email, $dob, $state, $dep, $level, $position, $why, $matric, $pass_word, $profileid
    ) {
        $this->profile_pics = $profile_pics;
        $this->name = $name;
        $this->gender = $gender;
        $this->email = $email;
        $this->dob = $dob;
        $this->state = $state;
        $this->dep = $dep;
        $this->level = $level;
        $this->position = $position;
        $this->why = $why;
        $this->matric = $matric;
        $this->pass_word = $pass_word;
        $this->profileid = $profileid;
    }
        //All fields are required!
    public function registerUser() {
        if (!$this->emptyInput()) {
            header('location: ../register.php?status=emptyInput');
            exit();
        }
        if (!$this->invalidEmail()) {
            header('location: ../register.php?status=invalidEmail');
            exit();
        }
        if (!$this->idTakenCheck()) {
            header('location: ../register.php?status=useroremailtaken');
            exit();
        }

        // If all checks pass, proceed with user registration
        $this->setUser(
            $this->profile_pics,
            $this->name,
            $this->gender,
            $this->email,
            $this->dob,
            $this->state,
            $this->dep,
            $this->level,
            $this->position,
            $this->why,
            $this->matric,
            $this->pass_word,
            $this->profileid
        );

        // Send confirmation email
        $this->sendEmail($this->$name, $this->profileid, $this->email);
    }

    private function emptyInput() {
        // Check for empty inputs
        return !(
            empty($this->email) ||
            empty($this->name) ||
            empty($this->gender) ||
            empty($this->email) ||
            empty($this->state) ||
            empty($this->gender) ||
            empty($this->dob) ||
            empty($this->level) ||
            empty($this->position) ||
            empty($this->matric) ||
            empty($this->pass_word)
            
        );
    }

    private function invalidEmail() {
        // Validate email format
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function idTakenCheck() {
        // Check if username or email is already taken
        return $this->checkUser($this->email);
    }
}
