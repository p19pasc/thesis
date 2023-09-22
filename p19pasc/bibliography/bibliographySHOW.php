<?php
include "../connDB.php";

// Get the id of the user's choice from bibliographyMAIN.php
$bibliographyID = $_GET["bibliographyID"];

$sql = "SELECT nameBib, title, subtitle, editors, editorsPlace, editionNumber, 
                            editionYear, chapterTitle, anouncementTitle, paperTitle, journalTitle, 
                            newspaperTitle, volNumber, issueNumber, monthYearIssue, dateIssue, 
                            editionPeriod, chapterSize, anouncementSize, articleSize, collectiveBody, 
                            conferenceProcTitle, editorName, introductionName, prologueName, translatorName,
                            availableURL, accessDate, website, webpage, phdTitle, institutionUniversity, 
                            nonPublishedDissertation, filmTitle, directorName, materialType, distribution, 
                            productionPlace, productionCompany, remarks FROM bibliography WHERE bibliographyID = $bibliographyID";

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons bi class-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Βιβλιογραφία No:<?php echo " " . $bibliographyID?></h3>
    
    <div class="container">
        <a href="bibliographyMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>

        <?php 
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row
                if($row = $result->fetch_assoc()){ ?>
                    <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row.
                         g-4: leave spaces between the col elements -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                            <div class="col">
                                <h5>Ονοματεπώνυμο Συγγραφέα</h5>
                                <p><?php echo $row['nameBib']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος</h5>
                                <p><?php echo $row['title']?></p>
                            </div>
                            <div class="col">
                                <h5>Υπότιτλος</h5>
                                <p><?php echo $row['subtitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Εκδόσεις</h5>
                                <p><?php echo $row['editors']?></p>
                            </div>
                            <div class="col">
                                <h5>Τόπος Έκδοσης</h5>
                                <p><?php echo $row['editorsPlace']?></p>
                            </div>
                            <div class="col">
                                <h5>Αριθμός Έκδοσης</h5>
                                <p><?php echo $row['editionNumber']?></p>
                            </div>
                            <div class="col">
                                <h5>Έτος Έκδοσης</h5>
                                <p><?php echo $row['editionYear']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Κεφαλαίου</h5>
                                <p><?php echo $row['chapterTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Εισήγησης</h5>
                                <p><?php echo $row['anouncementTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Άρθρου</h5>
                                <p><?php echo $row['paperTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Περιοδικού</h5>
                                <p><?php echo $row['journalTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Εφημερίδας</h5>
                                <p><?php echo $row['newspaperTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Αριθμός Τόμου</h5>
                                <p><?php echo $row['volNumber']?></p>
                            </div>
                            <div class="col">
                                <h5>Αριθμός Τεύχους</h5>
                                <p><?php echo $row['issueNumber']?></p>
                            </div>
                            <div class="col">
                                <h5>Μήνας και χρόνος κυκλοφορίας</h5>
                                <p><?php echo $row['monthYearIssue']?></p>
                            </div>
                            <div class="col">
                                <h5>Ημερομηνία και έτος κυκλοφορίας</h5>
                                <p><?php echo $row['dateIssue']?></p>
                            </div>
                            <div class="col">
                                <h5>Περίοδος Έκδοσης</h5>
                                <p><?php echo $row['editionPeriod']?></p>
                            </div>
                            <div class="col">
                                <h5>Έκταση Κεφαλαίου</h5>
                                <p><?php echo $row['chapterSize']?></p>
                            </div>
                            <div class="col">
                                <h5>Έκταση Εισήγησης</h5>
                                <p><?php echo $row['anouncementSize']?></p>
                            </div>
                            <div class="col">
                                <h5>Έκταση Άρθρου</h5>
                                <p><?php echo $row['articleSize']?></p>
                            </div>
                            <div class="col">
                                <h5>Συλλογικό Όργανο</h5>
                                <p><?php echo $row['collectiveBody']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος πρακτικών συνεδρίου</h5>
                                <p><?php echo $row['conferenceProcTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Επιμελητή</h5>
                                <p><?php echo $row['editorName']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Εισαγωγής</h5>
                                <p><?php echo $row['introductionName']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Προλόγου</h5>
                                <p><?php echo $row['prologueName']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Μεταφραστή</h5>
                                <p><?php echo $row['translatorName']?></p>
                            </div>
                            <div class="col">
                                <h5>Διαθέσιμο URL</h5>
                                <p><a href="<?php echo $row['availableURL']?>"><?php echo $row['availableURL'];?></a></p>
                            </div>
                            <div class="col">
                                <h5>Ημερομηνία Πρόσβασης</h5>
                                <p><?php echo $row['accessDate']?></p>
                            </div>
                            <div class="col">
                                <h5>Διαδικτυακός Τόπος</h5>
                                <p><a href="<?php echo $row['website']?>"><?php echo $row['website']?></a></p>
                            </div>
                            <div class="col">
                                <h5>Ιστοσελίδα</h5>
                                <p><a href="<?php echo $row['webpage']?>"><?php echo $row['webpage']?></a></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Διδακτορικής Διατριβής</h5>
                                <p><?php echo $row['phdTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Ιδρύματος–Πανεπιστήμιο</h5>
                                <p><?php echo $row['institutionUniversity']?></p>
                            </div>
                            <div class="col">
                                <h5>Μη εκδοθείσα Διδακτορική Διατριβή</h5>
                                <p><?php echo $row['nonPublishedDissertation']?></p>
                            </div>
                            <div class="col">
                                <h5>Τίτλος Ταινίας</h5>
                                <p><?php echo $row['filmTitle']?></p>
                            </div>
                            <div class="col">
                                <h5>Όνομα Σκηνοθέτη</h5>
                                <p><?php echo $row['directorName']?></p>
                            </div>
                            <div class="col">
                                <h5>Τύπος Υλικού</h5>
                                <p><?php echo $row['materialType']?></p>
                            </div>
                            <div class="col">
                                <h5>Έτος Διανομής</h5>
                                <p><?php echo $row['distribution']?></p>
                            </div>
                            <div class="col">
                                <h5>Τόπος Παραγωγής</h5>
                                <p><?php echo $row['productionPlace']?></p>
                            </div>
                            <div class="col">
                                <h5>Εταιρεία Παραγωγής</h5>
                                <p><?php echo $row['productionCompany']?></p>
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
                echo "Bibliography No:" . $bibliographyID . " does not exist";
            }
        ?>
    </div>

</body>
</html>