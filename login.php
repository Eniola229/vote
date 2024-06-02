<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="csss/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="csss/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="csss/style.css">

    <title>Login</title>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('https://th.bing.com/th/id/R.2fb1ffa6d2b05c77dfe5f412a5ae6b3e?rik=m4%2b7kPeHwBM4Lg&pid=ImgRaw&r=0');"></div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
              <h3>Login <strong></strong></h3>
               <?php
        if (isset($_GET['status'])) {
            $errorCode = htmlspecialchars($_GET['status']); // Sanitize input
            switch ($errorCode) {
                case 'stmtfailed':
                    echo '<p style="color: red; text-align: center;">An unexpected error occurred!</p>';
                    break;
                case 'emptyinput':
                    echo '<p style="color: red; text-align: center;">All fields are required!</p>';
                    break;
                case 'loginfailed':
                    echo '<p style="color: red; text-align: center;">Your EMail or Password is Invalid</p>';
                    break;
                case 'emailsent':
                    echo '<p style="color:green; text-align:center">Kindly Check your Email and Login</p>';
                    break; 
                case 'errorlogginyouin':
                    echo '<p style="color:red; text-align:center">Error Logging you in</p>'; 
                    break;
                case 'logoutsuccess':
                    echo '<p style="color:red; text-align:center">Logout Successful</p>';
                    break;
                case 'invalid_attempt':
                    echo '<p style="color:red; text-align:center">Invalid Attempt</p>';
                    break;
                case 'waitforaprroval':
                     echo '<p style="color:red; text-align:center">Kindly get your account activated from DSA and Login Again!</p>';
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
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form action="include/login.inc.php" method="POST">
                <div class="form-group first">
                  <label for="username">Email</label>
                  <input type="email"  name="email" class="form-control" placeholder="your-email@gmail.com" id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="pass_word" class="form-control" placeholder="Your Password" id="password">
                </div>
                
                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                </div>

                <input type="submit" value="Log In" class="btn btn-block btn-primary">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>