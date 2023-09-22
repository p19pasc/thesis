<?php
include "../connDB.php";


    $artifactID = $_GET["artifactID"];

    $sql = "SELECT artifacts.description as artifactsDesc, dateFound, characteristics, wholeObject, survivingPart, damages, maintenanceWork, 
            objectWidth, objectHeight, objectDiameter, objectThickness,
            sites.description as sitesDesc,
            startYear,endYear,datingMethod,
            chronologyENG.periodDescription as periodDescENG,
            chronologyGR.periodDescription as periodDescGR, chronologyGR.periodCode as periodCodeGR,
            storageplace.description as storagePlaceDesc,
            artifactType.description as artifactTypeDesc,
            material.description as materialDesc
            FROM artifacts
            JOIN sites ON artifacts.siteID = sites.siteID
            JOIN chronologyPeriods ON artifacts.periodID = chronologyPeriods.periodID
            JOIN chronologyENG ON chronologyPeriods.chronologyENGID = chronologyENG.chronologyEngID
            JOIN chronologyGR ON chronologyPeriods.chronologyGRID = chronologyGR.chronologyID
            JOIN storagePlace ON artifacts.storagePlaceID = storagePlace.storagePlaceID
            JOIN artifactType ON artifacts.artifacttypeID = artifactType.artifactTypeID
            JOIN material ON artifacts.materialID = material.materialID
            WHERE artifacts.artifactID = $artifactID";

        $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργο</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/SHOW.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Τέχνεργο No:<?php echo " " . $artifactID?></h3>
    
    <div class="container">
        <button class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a></button>
        
        <?php 
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row
                if($row = $result->fetch_assoc()){ ?>
                    <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                            <div class="col">
                                <h5>Όνομα Τέχνεργου</h5>
                                <p><?php echo $row['artifactsDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Ημερομηνία Εύρεσης</h5>
                                <p><?php echo $row['dateFound']?></p>
                            </div>
                            <div class="col">
                                <h5>Είδος Τέχνεργου</h5>
                                <p><?php echo $row['artifactTypeDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Υλικό Τέχνεργου</h5>
                                <p><?php echo $row['materialDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Χώρος Αποθήκευσης</h5>
                                <p><?php echo $row['storagePlaceDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Τόπος Ανασκαφής</h5>
                                <p><?php echo $row['sitesDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Εκτιμώμενη περίοδος στην οποία ανήκει</h5>
                                <p>
                                    <?php
                                        // startYear is nullable in database. User can put the value "0" in the startYear.
                                        //  In order to recognise the difference between "0" and null (null is when user submit the form with empty startYear),
                                        //  use !== . If startYear is null it means that the artifact belongs to a specific Year (endYear), unless it is belongs
                                        //  to a specific period.
                                        if($row['startYear'] !== NULL){
                                            echo "Από: " . $row['startYear'] . "<br>Έως: " . $row['endYear'];
                                        }else{
                                            echo "Έτος: " . $row["endYear"];
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="col">
                                <h5>Περίοδος ENG</h5>
                                <p><?php echo $row['periodDescENG']?></p>
                            </div>
                            <div class="col">
                                <h5>Περίοδος GR</h5>
                                <p><?php echo $row['periodDescGR']?></p>
                            </div>
                            <div class="col">
                                <h5>Κωδικός περιόδου GR</h5>
                                <p><?php echo $row['periodCodeGR']?></p>
                            </div>
                            <div class="col">
                                <h5>Μέθοδος Χρονολόγησης</h5>
                                <p><?php echo $row['datingMethod']?></p>
                            </div>
                            <div class="col">
                                <h5>Ολόκληρο Τέχνεργο</h5>
                                <p><?php 
                                        if($row['wholeObject'] == 1){
                                            echo "ΝΑΙ";
                                        }elseif($row['wholeObject'] == 3){
                                            echo "Δεν είναι γνωστό αν το τέχνεργο είναι ολόκληρο";
                                        }
                                        elseif($row['wholeObject'] == 2){
                                            echo "ΟΧΙ";
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="col">
                                <h5>Πλάτος Τέχνεργου (cm)</h5>
                                <p><?php echo $row['objectWidth']?></p>
                            </div>
                            <div class="col">
                                <h5>Ύψος Τέχνεργου (cm)</h5>
                                <p><?php echo $row['objectHeight']?></p>
                            </div>
                            <div class="col">
                                <h5>Διάμετρος Τέχνεργου (cm)</h5>
                                <p><?php echo $row['objectDiameter']?></p>
                            </div>
                            <div class="col">
                                <h5>Πάχος Τέχνεργου (cm)</h5>
                                <p><?php echo $row['objectThickness']?></p>
                            </div>
                            <div class="col">
                                <h5>Χαρακτηριστικά</h5>
                                <p><?php echo $row['characteristics']?></p>
                            </div>
                            <div class="col">
                                <h5>Σωζόμενο Μέρος Τέχνεργου</h5>
                                <p><?php echo $row['survivingPart']?></p>
                            </div>
                            <div class="col">
                                <h5>Φθορές</h5>
                                <p><?php echo $row['damages']?></p>
                            </div>
                            <div class="col">
                                <h5>Εργασίες Συντήρησης</h5>
                                <p><?php echo $row['maintenanceWork']?></p>
                            </div>
                        </div>
        <?php 
                }
            // In case the user change the ID on the url but, it does not exist in the database
            }else{
                echo "Artifact No:" . $artifactID . " does not exist";
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".btn").click(function(event) {
            // When user click "Go back" button, it will be redirected to the previous page
            history.back();
        });
    </script>

</body>
</html>