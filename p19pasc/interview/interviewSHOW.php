<?php
    include "../connDB.php";

    // Get the id of the user's choice from interviewMAIN.php
    $interviewID = $_GET['interviewID'];
     
    $sql = "SELECT interviewer, interviewDate, interviewLocationTable.DescriptionGR as intlocDescriptionGR, interviewLocationText, interviewDuration, program, interviewEditor, paraxwritirio, mainInterviewTopic, interviewSummary, keywords, remarks,
    interviewtype.description as inttypeDescription,
    recordingmediumtype.description as recDescription,
    firstname, lastname, birthYear, birthPlaceTable.DescriptionGR as birthPlaceDescriptionGR, birthPlaceText, professionNow, professionPast,
    gender.description as genderDescription,
    educationallevel.description as eduDescription,
    maritalstatus.description as maritalDescription 
    FROM interview
    JOIN interviewtype ON interview.interviewType = interviewtype.interviewTypeID
    JOIN recordingmediumtype ON interview.recordingMedium = recordingmediumtype.recordingTypeID
    JOIN placeNames as interviewLocationTable ON interview.interviewLocation = interviewLocationTable.placenamesID
    JOIN interviewee ON interview.interviewee = interviewee.intervieweeID
    JOIN placeNames as birthPlaceTable ON interviewee.birthPlace = birthPlaceTable.placenamesID
    JOIN maritalstatus ON interviewee.maritalstatus = maritalstatus.maritalStatusID
    JOIN gender ON interviewee.gender = gender.ID
    JOIN educationallevel ON interviewee.educationLevel = educationallevel.educationalLevelID
    WHERE interviewID = $interviewID";

    $result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Συνεντεύξεις</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/SHOW.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Συνέντευξη No:<?php echo " " . $interviewID?></h3>
    

    <div class="container">

        <a href="interviewMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        
        <?php
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row 
                if($row = $result->fetch_assoc()){ ?>
                <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row.
                     g-4: leave spaces between the col elements -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                        <div class="col">
                            <h5>Όνομα συνεντευξιαστή/-ριας</h5>
                            <p><?php echo $row['interviewer']?></p>
                        </div>

                        <div class="col">
                            <h5>Ημερομηνία Συνέντευξης</h5>
                            <p><?php echo $row['interviewDate']?></p>
                        </div>
                        <div class="col">
                            <h5>Τόπος Συνέντευξης</h5>
                            <p><?php echo $row['interviewLocationText']?></p>
                        </div>
                        <div class="col">
                            <h5>Περιφέρεια τόπου συνέντευξης</h5>
                            <p><?php echo $row['intlocDescriptionGR']?></p>
                        </div>
                        <div class="col">
                            <h5>Διάρκεια Συνέντευξης</h5>
                            <p><?php echo $row['interviewDuration'] . "'"?></p>
                        </div>
                        <div class="col">
                            <h5>Μέσο Καταγραφής</h5>
                            <p><?php echo $row['recDescription']?></p>
                        </div>
                        <div class="col">
                            <h5>Πρόγραμμα</h5>
                            <p><?php echo $row['program']?></p>
                        </div>
                        <div class="col">
                            <h5>Επιμέλεια–επεξεργασία συνέντευξης</h5>
                            <p><?php echo $row['interviewEditor']?></p>
                        </div>
                        <div class="col">
                            <h5>Παραχωρητήριο</h5>
                            <p><?php echo $row['paraxwritirio']?></p>
                        </div>
                        <div class="col">
                            <h5>Όνομα Πληροφορητή/-ριας</h5>
                            <p><?php echo $row['firstname'] ." ". $row['lastname']?></p>
                        </div>
                        <div class="col">
                            <h5>Φύλο</h5>
                            <p><?php echo $row['genderDescription']?></p>
                        </div>
                        <div class="col">
                            <h5>Έτος Γέννησης</h5>
                            <p><?php echo $row['birthYear']?></p>
                        </div>
                        <div class="col">
                            <h5>Τόπος Γέννησης</h5>
                            <p><?php echo $row['birthPlaceText']?></p>
                        </div>
                        <div class="col">
                            <h5>Περιφέρεια τόπου γέννησης</h5>
                            <p><?php echo $row['birthPlaceDescriptionGR']?></p>
                        </div>
                        <div class="col">
                            <h5>Επάγγελμα Στο Παρελθόν</h5>
                            <p><?php echo $row['professionPast']?></p>
                        </div>
                        <div class="col">
                            <h5>Επάγγελμα Τώρα</h5>
                            <p><?php echo $row['professionNow']?></p>
                        </div>
                        <div class="col">
                            <h5>Οικογενειακή Κατάσταση</h5>
                            <p><?php echo $row['maritalDescription']?></p>
                        </div>
                        <div class="col">
                            <h5>Κύριο θέμα συνέντευξης</h5>
                            <p><?php echo $row['mainInterviewTopic']?></p>
                        </div>
                        <div class="col">
                            <h5>Λέξεις - κλειδιά</h5>
                            <p><?php echo $row['keywords']?></p>
                        </div>
                        <div class="col">
                            <h5>Περίληψη</h5>
                            <p><?php echo $row['interviewSummary']?></p>
                        </div>
                        <div class="col">
                            <h5>Παρατηρήσεις</h5>
                            <p><?php echo $row['remarks']?></p>
                        </div>
                    </div>
        <?php
                } 
            // In case the user change the ID on the url but, it does not exist in the database
            }else{
                    echo "Interview No:" . $interviewID . " does not exist";
                }
        ?>
        </div>

</body>
</html>