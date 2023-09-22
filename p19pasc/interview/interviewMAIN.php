<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Συνεντεύξεις</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/MAIN.css';?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons, bi class -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Συνεντεύξεις</h3>

    <div class="container table-responsive">

        <!-- D-flex class allows to adjust the buttons in the center of it with justify-content-center.
             This div element is inside container for better looking (because of the spaces left-right) -->
        <div class="d-flex justify-content-center">
                <!-- Button that navigates the user to interviewSUBMIT.php to add new interview -->
                <a href="interviewSUBMIT.php" class="btn btn-secondary btn-sm me-2"><i class="bi bi-plus"></i>Καταγραφή νέας συνέντευξης</a>

                <!-- Button that navigates the user to intervieweeSUBMIT.php to add new interviewee -->
                <a href="intervieweeSUBMIT.php" class="btn btn-secondary btn-sm ms-2"><i class="bi bi-plus"></i>Προσθήκη συνεντευξιαζόμενου</a>
        </div>

        <?php
            $sql = "SELECT interviewID, interviewer,interviewDate FROM interview ORDER BY interviewDate DESC";
            $result = $conn->query($sql);
            // If the query return results then create the table
            if($result->num_rows>0){
        ?>
                <!-- Table that displays the interviewer and the interview date of the interview table -->
                <!-- W-auto takes the width that is needed and mx-auto center the table inside the parent element  -->
                <table class="table table-bordered table-hover w-auto mx-auto">
                    <thead>
                        <tr>
                            <th>Όνομα συνεντευξιαστή/-ριας</th>
                            <th>Ημερομηνία Συνέντευξης</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                While($row = $result->fetch_assoc()){
                                ?>
                                        <!-- data-id keeps the id of the specific row -->
                                        <tr class="clickable_row" data-id = "<?php echo $row['interviewID']?>">
                                            <td><?php echo $row['interviewer']?></td>
                                            <td><?php echo $row['interviewDate']?></td>                    
                                        </tr>                    
                                <?php
                                }          
                        ?>
                    </tbody>
                </table>
        <?php
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // When a row of the table is clicked, save the id of the row and pass it through get request to interviewSHOW.php
        $(".clickable_row").click(function () {
            var interviewID = $(this).attr("data-id");
            window.location.href = "interviewSHOW.php?interviewID=" + interviewID;
        });
    
});


    </script>


</body>
</html>

