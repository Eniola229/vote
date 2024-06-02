<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="csss/register.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <section class="vh-50 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Candidate Registration Form</h3>
            <p style="text-align: center;">
              <?php
                if (isset($_GET['status'])) {
                    $errorCode = htmlspecialchars($_GET['status']); // Sanitize input
                    switch ($errorCode) {
                        case 'stmtfailed':
                            echo '<p style="color: red; text-align: center;">An unexpected error occurred!</p>';
                            break;
                        case 'emptyInput':
                            echo '<p style="color: red; text-align: center;">All fields are required!</p>';
                            break;
                        case 'loginfailed':
                            echo '<p style="color: red; text-align: center;">Invalid Email or Password</p>';
                            break;
                        case 'emailsent':
                            echo '<p style="color:white; text-align:center">Successful! Kindly Check your Email and Login</p>';
                            break; 
                        case 'invalidfiletype':
                            echo '<p style="color:red; text-align:center">Invalid Image Uploaded</p>';
                            break;
                        case 'invalidAttempit':
                             echo '<p style="color:red; text-align:center">Invalid Attempt</p>';
                            break;
                        case 'emailsent':
                             echo '<p style="color:white; text-align:center">Added Successful</p>';
                            break;
                        default:
                            // Log unrecognized error codes for debugging
                            error_log("Unrecognized error code: $errorCode");
                            echo '<p style="color: red; text-align: center;">An unexpected error occurred! Please try again later.</p>';
                            break;
                    }
                } else {
                    echo '<p style="color: red; text-align: center;">Kindly fill in your details correctly!</p>';
                }
                ?>
              </p>
           <form action="include/register.inc.php" method="POST" enctype="multipart/form-data">


              <div class="row">

                 <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="file" name="profile_pics" id="profile" class="form-control form-control-lg" required />
                    <label  class="form-label" for="profile picture">Profile Picture</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="firstName" name="name" class="form-control form-control-lg" required/>
                    <label class="form-label" for="firstName">Full Name</label>
                  </div>

                </div>

                 <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="firstName" name="matric" class="form-control form-control-lg" required/>
                    <label class="form-label" for="firstName">Matirc Number</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="firstName" name="email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="firstName">Email</label>
                  </div>

                </div>


                   <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Female" name="gender" id="femaleGender"
                      value="option1" checked />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Male" name="gender" id="maleGender"
                      value="option2" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                </div>

                  <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div data-mdb-input-init class="form-outline datepicker w-100">
                    <input type="date" name="dob" class="form-control form-control-lg" id="birthdayDate" required/>
                    <label for="birthdayDate" class="form-label">Date of Birth</label>
                  </div>

                </div>

                  <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="lastName" name="state" class="form-control form-control-lg" required/>
                    <label class="form-label" for="lastName">State of Origin</label>
                  </div>
                </div>

                

              </div>

              <div class="row">
                <hr>
                 <div class="col-md-6 mb-4">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="" name="dep" class="form-control form-control-lg" required/>
                    <label class="form-label" for="">Department*</label>
                  </div>
                </div>
                 <div class="col-md-6 mb-4 d-flex align-items-center">
                   <div data-mdb-input-init class="form-outline">
                    <select  name="level" required class="select form-control-lg">
                      <option value="1" disabled>Level</option>
                      <option value="ND1">ND1</option>
                      <option value="ND2">ND2</option>
                      <option value="HND1">HND1</option>
                      <option value="HND2">HND2</option>
                    </select>
                     <label for="" class="form-label">Choose Level</label>
                  </div>
                </div>

              </div>

              <div class="row">
                <hr>
                 <div class="col-md-6 mb-4 pb-2">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="" name="position" class="form-control form-control-lg" required/>
                    <label class="form-label" for="">Runnig for?</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4 pb-2">

                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="" name="why" class="form-control form-control-lg" required/>
                    <label class="form-label" for="">Why are you runnig for this position?</label>
                  </div>

                </div>

            
                <div class="col-md-6 mb-4 pb-2">

                  <div data-mdb-input-init class="form-outline">
                    <input type="password" name="pass_word" id="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Password (Advice: Use your First NAme as your passowrd)</label>
                  </div>

                </div>

              </div>

              

              <div class="mt-4 pt-2">
                <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Submit" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>