<?php
session_start();
  include "classes/viewcan.classes.php";
  include "classes/searchcan.classes.php";
    
      if ($_SESSION['role'] == "" || $_SESSION['role'] == "0") {
            header("Location: ogin.php?status=invalid_attempt");
            exit;  
        } 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RECTEM | Home</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script type="text/javascript" src="js/home.js"></script>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<div class="app-container">
  <div class="app-left">
    <button class="close-menu">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="app-logo">
      
      <span>RECTEM DASHBOARD</span>
    </div>
    <ul class="nav-list">
      <li class="nav-list-item">
        <a class="nav-list-link" href="dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-columns"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"/></svg>
          Dashboard
        </a>
      </li>
      <li class="nav-list-item">
        <a class="nav-list-link" href="">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          All Feedback
        </a>
      </li>
       <li class="nav-list-item">
        <a class="nav-list-link" href="candidateweb.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          All Candidates
        </a>
      </li>
 
      <?php 
      if ($_SESSION['role'] == 2) { ?>
       
      <li class="nav-list-item active">
        <a class="nav-list-link" href="viewdoc.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
          New Candidates
        </a>
      </li>
     <?php
      } ?>
      <li class="nav-list-item">
        <a class="nav-list-link" style="color: red;" href="include/logout.inc.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
          Logout
        </a>
      </li>
    </ul>
  </div>
  <div class="app-main">
    <div class="main-header-line">
      <h1 style="color: black;">Welcome <?php echo $_SESSION['name'] ?>!</h1>
      <div class="action-buttons">
        <button class="open-right-area">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      </button>
      <button class="menu-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      </div>
    </div>
  
    <div class="chart-row two">
      <div class="chart-container-wrapper big">
        <div class="chart-container">
          <div class="chart-container-header">
            <h2>Search For Candidate</h2>
            <span>Kindly enter name</span>
          </div>
           <div class="container mt-5">
            <form class="form-inline">
              <div class="form-group mx-sm-13 mb-2">
                <label for="search" class="sr-only" style="color: white;">Search</label>
                <input type="text" id="search" class="form-control" id="search" placeholder="Search">
              </div>
            </form>
            <p style="color: white; margin-top: 2%;" id="results"></p>
          </div>
        </div>  
      </div>
      </div>
       <script>
             $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                $.ajax({
                    url: 'classes/searchcan.classes.php',
                    type: 'GET',
                    data: {first_name: query},
                    success: function(data){
                        $('#results').html(data);
                    }
                });
            });
        });
      </script>
       <!----------This is for Records-------->
         <?php
                if (isset($_GET['status'])) {
                    $errorCode = htmlspecialchars($_GET['status']); // Sanitize input
                    switch ($errorCode) {
                        case 'stmtfailed':
                            echo '<p style="color: red; text-align: center;">An unexpected error occurred!</p>';
                            break;
                        case 'approved':
                            echo '<p style="color: green; text-align: center;">Account Activated Successfully!</p>';
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
                    echo '<p style="color: red; text-align: center;"></p>';
                }
                ?>
  <div class="container mt-5">
    <h2 class="mb-4">All New Application</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Passport</th>
          <th scope="col">Full Name</th>
          <th scope="col">Email:</th>
          <th scope="col">Gender</th>
          <th scope="col">Profile ID</th>
          <th scope="col">Matric No</th>
        </tr>
      </thead>  
      <tbody>
        <?php 
         foreach ($users as $user) {?>
        <tr class="table-primary">
          <th scope="row"><?php echo $user['user_id'] ?></th>
          <th scope="row"><img style="height: 100px; width: 100px;" src="can_profile_pics/<?php echo $user['profile_pics']?>" class="img-thumbnail" alt="..."></th>
          <th scope="row"><?php echo $user['name'] ?></th>
          <th scope="row"><?php echo $user['email'] ?></th>
          <th scope="row"><?php echo $user['gender'] ?></th>
          <th scope="row"><?php echo $user['profileid'] ?></th>
          <th scope="row"><?php echo $user['matric'] ?></th>
          <td>
           
           <!--  <a href="viewspecificteacher.php?id=<?php echo $user['user_id'] ?>">
            <button type="button" class="btn btn-info btn-sm">View</button>
            </a> -->
          </td>
        </tr>
        <?php 
           } ?>

      </tbody>
    </table>
  </div>
    </div>

  </div>
  <div class="app-right">
    <button class="close-right">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="profile-box">
      <div class="profile-photo-wrapper">
        <img src="can_profile_pics/<?php echo $_SESSION['profile_pics']?>" alt="profile">
      </div>
      <p class="profile-text"><?php echo $_SESSION['name']; ?></p>
      <p class="profile-text"><?php echo $_SESSION['position'];?></p>
      <p class="profile-text"><?php echo $_SESSION['profileid'];?></p>
    </div>
   
  </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>