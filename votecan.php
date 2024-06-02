<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>RECTEM VOTING</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <style>
            .center {
                max-width: 600px;
                margin-top: 50px;
                padding: 20px;
                background: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }
            h2 {
                margin-bottom: 30px;
            }
            .snapshot-container {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 20px;
            }
            video, canvas {
                border: 2px solid #007bff;
                border-radius: 8px;
                margin-bottom: 10px;
            }
            #snap {
                display: block;
            }
        </style>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
                <div class="container px-5">
                    <a class="navbar-brand fw-bold" href="index.php">RECTEM VOTING PLATFORM</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="bi-list"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                            <li class="nav-item"><a class="nav-link me-lg-3" href="candidates.php">CANDIDATES</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="#download">VOTE</a></li>
                            <li class="nav-item"><a class="nav-link me-lg-3" href="login.php">LOGIN</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container center">
                <h2 class="text-center">Voting Form</h2>
                <p style="text-align: center;">
                    <?php
                        if (isset($_GET['status'])) {
                            $errorCode = htmlspecialchars($_GET['status']);
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
                                case 'useroremailtaken':
                                    echo '<p style="color:red; text-align:center">User Already Voted Before</p>';
                                    break;
                                case 'uploadedimg':
                                    echo '<p style="color:red; text-align:center">You must Take a shot</p>';
                                    break;                            
                                default:
                                    error_log("Unrecognized error code: $errorCode");
                                    echo '<p style="color: red; text-align: center;">An unexpected error occurred! Please try again later.</p>';
                                    break;
                            }
                        } else {
                            echo '<p style="color: red; text-align: center;">Kindly fill in your details correctly!</p>';
                        }
                    ?>
                </p>
                <form action="include/prevote.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Full Name:</label>
                        <input type="text" name="name" class="form-control" id="username" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group snapshot-container">
                        <video id="video" width="320" height="240" autoplay></video>
                        <button id="snap" type="button">Snap Photo</button>
                        <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                        <input id="fileInput" type="file" name="v_img">
                    </div>
                    <div class="form-group">
                        <label for="candidate">Choose Your Presidential Candidate:</label>
                        <select class="form-control" name="precandidate" id="candidate" required>
                            <option value="" disabled selected>Select your candidate</option>
                            <option value="candidate1">OSOBA OLUWATOBILOBA NIFEMI</option>
                            <option value="candidate2">EMARIAVWORHE EFE PAUL</option>
                            <option value="candidate3">AMADI EMMANUEL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="candidate">Choose Your Vice Presidential Candidate:</label>
                        <select class="form-control" name="vicecandidate" id="candidate" required>
                            <option value="" disabled selected>Select your candidate</option>
                            <option value="candidate1">OSOBA OLUWATOBILOBA NIFEMI</option>
                            <option value="candidate2">EMARIAVWORHE EFE PAUL</option>
                            <option value="candidate3">AMADI EMMANUEL</option>
                        </select>
                    </div>
                    <button style="margin-top: 2%;" type="submit" class="btn btn-success">Submit Vote</button>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
                const video = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const snap = document.getElementById('snap');
                const context = canvas.getContext('2d');

                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {
                        video.srcObject = stream;
                    })
                    .catch((err) => {
                        console.error("Error accessing camera: ", err);
                    });

                snap.addEventListener('click', () => {
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    video.style.display = 'none';
                    snap.style.display = 'none';
                    canvas.style.display = 'block';

                    const dataURL = canvas.toDataURL('image/jpg');

                    // console.log(dataURL);
                    
                    // console.log(dataURL.split(";"));


                    const splitURL = dataURL.split(";")[0].split(":")[1];
                    //console.log(splitURL);

                    const byteString = atob(dataURL.split(',')[1]);



                    const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
                    const ab = new ArrayBuffer(byteString.length);
                    console.log(ab);
                    const ia = new Uint8Array(ab);

                    const decoder = new TextDecoder('utf-8');
                    const text = decoder.decode(ia);
                    // console.log(text);


                    // console.log(ia);
                    for (let i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }
                    const blob = new Blob([ab], { type: mimeString });

                    const fileInput = document.getElementById('fileInput');
                    const dt = new DataTransfer();
                    /*
                         
                    File
                    lastModified
                    : 
                    1717174591193
                    lastModifiedDate
                    : 
                    Fri May 31 2024 17:56:31 GMT+0100 (British Summer Time) {}
                    name
                    : 
                    "snapshot.jpg"
                    size
                    : 
                    129116
                    type
                    : 
                    ""
                    webkitRelativePath
                    : 
""
                    */

                    const files = dt.files;

                    const dtFile = {
                        ...files,
                        type: "image/png",
                    };
                    console.log(files);
                    dt.items.add(new File([blob], "snapshot.jpg"));
                    fileInput.files = dt.files;

                    // console.log(dt);
                    // dt.items.add(new File([blob], "snapshot.jpg"));
                    // fileInput.files = dt.files;
                    
                });


                    
                
            

            </script>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
