<?php
    include "../connDB.php";

    // Get the id of the user's choice from archiveDataMAIN.php
    $archiveDataID = $_GET['archiveDataID'];

    $sql = "SELECT archiveDataID, archiveTitle, dossierNumbering, thematicUnit, documentTitle, summary, remarks, archiveKeywords, quotation, digitalFile, 
    placeOfRecordText, placeOfReferenceText, documentEditionDate, documentEditionYear, documentReferenceDate, documentReferenceYear, documentReferenceYearEnd, hasStatistics,
    archivesources.description as archiveSourcesDesc,
    documentcategory.description as documentCategoryDesc,
    informationcategory.description as informationCategoryDesc, informationcategory.greaterDescription as informationCategoryGreaterDesc,
    RecordPlacenames.DescriptionGR as RecordPlacenamesDescriptionGR,
    ReferencePlacenames.DescriptionGR as ReferencePlacenamesDescriptionGR
    FROM archivedata 
    JOIN archiveSources ON archivedata.archiveSourcesID = archiveSources.archiveSourcesID
    JOIN documentCategory ON archivedata.documentCategoryID  = documentCategory.documentCategoryID
    JOIN informationCategory ON archivedata.informationCategoryID = informationCategory.informationCategoryID
    JOIN placenames as RecordPlacenames ON archiveData.placeOfRecord = RecordPlacenames.placenamesID
    JOIN placenames as ReferencePlacenames ON archiveData.placeOfReference = ReferencePlacenames.placenamesID
    WHERE archiveDataID = $archiveDataID";

    $result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αρχειακό Υλικό</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/SHOW.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons bi class-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Αρχειακό Υλικό No:<?php echo " " . $archiveDataID?></h3>
    

    <div class="container">
        <a href="archiveDataMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        
        <?php
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row 
                if($row = $result->fetch_assoc()){ ?>
                <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                        <div class="col">
                            <h5>Τίτλος αρχείου</h5>
                            <p><?php echo $row['archiveTitle']?></p>
                        </div>

                        <div class="col">
                            <h5>Φάκελος/αρίθμησης</h5>
                            <p><?php echo $row['dossierNumbering']?></p>
                        </div>
                        <div class="col">
                            <h5>Θεματική ενότητα</h5>
                            <p><?php echo $row['thematicUnit']?></p>
                        </div>
                        <div class="col">
                            <h5>Κατηγορία Τεκμηρίου</h5>
                            <p><?php echo $row['documentCategoryDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Τίτλος τεκμηρίου</h5>
                            <p><?php echo $row['documentTitle']?></p>
                        </div>
                        <div class="col">
                            <h5>Αρχειακή Συλλογή</h5>
                            <p><?php echo $row['archiveSourcesDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Κατηγορία Πληροφορίας</h5>
                            <p><?php echo $row['informationCategoryDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Μεγαλύτερη περιγραφή κατηγορίας πληροφορίας</h5>
                            <p><?php echo $row['informationCategoryGreaterDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Ημερομηνία Έκδοσης</h5>
                            <p><?php echo $row['documentEditionDate']?></p>
                        </div>
                        <div class="col">
                            <h5>Έτος έκδοσης</h5>
                            <p><?php echo $row['documentEditionYear']?></p>
                        </div>
                        <div class="col">
                            <h5>Ημερομηνία Αναφοράς</h5>
                            <p><?php echo $row['documentReferenceDate']?></p>
                        </div>
                        <div class="col">
                            <h5>Αρχικό έτος αναφοράς</h5>
                            <p><?php echo $row['documentReferenceYear']?></p>
                        </div>
                        <div class="col">
                            <h5>Τελικό έτος αναφοράς</h5>
                            <p><?php echo $row['documentReferenceYearEnd']?></p>
                        </div>
                        <div class="col">
                            <h5>Στατιστικά Στοιχεία</h5>
                            <p><?php 
                                        if($row['hasStatistics'] == 1){
                                            echo "Υπάρχουν";                            
                                        }elseif($row['hasStatistics'] == 3){
                                            echo "Δεν είναι γνωστό αν υπάρχουν";
                                        }
                                        elseif($row['hasStatistics'] == 2){
                                            echo "Δεν υπάρχουν";
                                        }
                                ?>
                            </p>
                        </div>
                        <div class="col">
                            <h5>Περιγραφή τόπου καταγραφής</h5>
                            <p><?php echo $row['placeOfRecordText']?></p>
                        </div>                        
                        <div class="col">
                            <h5>Περιφέρεια τόπου καταγραφής</h5>
                            <p><?php echo $row['RecordPlacenamesDescriptionGR']?></p>
                        </div>
                        <div class="col">
                            <h5>Περιγραφή τόπου αναφοράς</h5>
                            <p><?php echo $row['placeOfReferenceText']?></p>
                        </div>
                        <div class="col">
                            <h5>Περιφέρεια τόπου αναφοράς</h5>
                            <p><?php echo $row['ReferencePlacenamesDescriptionGR']?></p>
                        </div>
                        <div class="col">
                            <h5>Σύνδεσμος σε ψηφιακό αρχείο</h5>
                            <p><?php echo $row['digitalFile']?></p>
                        </div>
                        <div class="col">
                            <h5>Λέξεις-Κλειδιά</h5>
                            <p><?php echo $row['archiveKeywords']?></p>
                        </div>
                        <div class="col">
                            <h5>Περίληψη</h5>
                            <p><?php echo $row['summary']?></p>
                        </div>
                        <div class="col">
                            <h5>Παρατηρήσεις</h5>
                            <p><?php echo $row['remarks']?></p>
                        </div>
                        <div class="col">
                            <h5>Απόσπασμα</h5>
                            <p><?php echo $row['quotation']?></p>
                        </div>

                    </div>
        <?php
                } 
            // In case the user change the ID on the url but, it does not exist in the database
            }else{
                    echo "Interview No:" . $archiveDataID . " does not exist";
                }
        ?>
        </div>

</body>
</html>