<?php
    include "classes/count_canone.classes.php";
    include "classes/count_cantwo.classes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        .card-header {
            font-size: 1.5em;
            font-weight: bold;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- President Results -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        President Election Results
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Candidate</th>
                                    <th scope="col">Party</th>
                                    <th scope="col">Votes</th>
                                    <th scope="col">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>OSOBA OLUWATOBILOBA NIFEMI</td>
                                    <td>Party A</td>
                                    <td><?php echo $preCount; ?></td>
                                    <td>20%</td>
                                </tr>
                                <tr>
                                    <td>EMARIAVWORHE EFE PAUL</td>
                                    <td>Party B</td>
                                    <td><?php echo $pretwoCount; ?></td>
                                    <td>15%</td>
                                </tr>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Vice President Results -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-success text-white">
                        Vice President Election Results
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Candidate</th>
                                    <th scope="col">Party</th>
                                    <th scope="col">Votes</th>
                                    <th scope="col">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Toyosi</td>
                                    <td>Party A</td>
                                    <td><?php echo $preCount; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tunimse</td>
                                    <td>Party B</td>
                                    <td>15</td>
                                    <td>15%</td>
                                </tr>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
