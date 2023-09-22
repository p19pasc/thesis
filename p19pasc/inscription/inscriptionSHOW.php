<?php
    include "../connDB.php";

    // Get the id of the user's choice from inscriptionMAIN.php
    $inscriptionID = $_GET["inscriptionID"];

    $sql = "SELECT title, issued, museumNumber, archaeologicalBulletinNumber, versionDetails, bibliography, environmentalInformation,
            positionOnObject, wholeInscription, inscriptionSurvivingPart, inscriptionDamages, surfaceScratches, scrapingOfLetters, erasedLetters, tracesOfPaint, etchGuides, maxLetterHeight, minLetterHeight, maxLetterWidth, minLetterWidth, engravingDepth, autopsyStatement, inscriptionPrint, directionOfWriting, survivingVersesNum, text, translate, letterCases, grammarRemarks, peopleConnectivity, textRestoration, comments, hyperlink,
            inscriptionKind.description as inscriptionKindDesc,
            keywords.description as keywordsDesc,
            artifacts.description as artifactsDesc,
            startYear,endYear,
            chronologyENG.periodDescription as periodDescENG,
            chronologyGR.periodDescription as periodDescGR, chronologyGR.periodCode as periodCodeGR
            FROM inscription
            JOIN inscriptionKind ON inscription.kindOfInscription = inscriptionKind.kindOfInscriptionID
            JOIN keywords_inscription ON inscription.inscriptionID = keywords_inscription.inscriptionID
            JOIN keywords ON keywords_inscription.keywordsID = keywords.keywordsID
            JOIN artifacts ON inscription.artifactID = artifacts.artifactID
            JOIN chronologyPeriods ON artifacts.periodID = chronologyPeriods.periodID
            JOIN chronologyENG ON chronologyPeriods.chronologyENGID = chronologyENG.chronologyEngID
            JOIN chronologyGR ON chronologyPeriods.chronologyGRID = chronologyGR.chronologyID

            WHERE inscription.inscriptionID = $inscriptionID";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επιγραφή</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/SHOW.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Επιγραφή No:<?php echo " " . $inscriptionID?></h3>

    <div class="container">
        <a href="inscriptionMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        <?php
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row
                if($row = $result->fetch_assoc()){ 
        ?>
                    <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                        <div class="col">
                            <h5>Τίτλος</h5>
                            <p><?php echo $row['title']?></p>
                        </div>
                        <div class="col">
                            <h5>Είδος</h5>
                            <p><?php echo $row['inscriptionKindDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Τέχνεργο στο οποίο βρίκσεται</h5>
                            <p><?php echo $row['artifactsDesc']?></p>
                        </div>
                        <div class="col">
                            <h5>Εκτιμώμενη περίοδος στην οποία ανήκει</h5>
                            <p>
                                <?php
                                    // startYear is nullable in database. User can put the value "0" in the startYear.
                                    //  In order to recognise the difference between "0" and null (null is when user submit the form with empty startYear),
                                    //  use !== . If startYear is null it means that the inscription belongs to a specific Year (endYear), unless it is belongs
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
                            <h5>Εκδομένη</h5>
                            <p>
                                <?php 
                                    if($row['issued'] == 1){
                                        echo "ΝΑΙ";
                                    }else{
                                        echo "ΟΧΙ";
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col">
                            <h5>Αριθμός Μουσείου</h5>
                            <p><?php echo $row['museumNumber']?></p>
                        </div>
                        <div class="col">
                            <h5>Αριθμός σε αρχαιολογικά δελτία</h5>
                            <p><?php echo $row['archaeologicalBulletinNumber']?></p>
                        </div>
                        <div class="col">
                            <h5>Στοιχεία Έκδοσης</h5>
                            <p><?php echo $row['versionDetails']?></p>
                        </div>
                        <div class="col">
                            <h5>Περιβαλλοντικές Πληροφορίες</h5>
                            <p><?php echo $row['environmentalInformation']?></p>
                        </div>
                        <div class="col">
                            <h5>Θέση επιγραφής επάνω στο τέχνεργο</h5>
                            <p><?php echo $row['positionOnObject']?></p>
                        </div>
                        <div class="col">
                            <h5>Ολόκληρη η επιγραφή</h5>
                            <p>
                                <?php 
                                    if($row['wholeInscription'] == 1){
                                        echo "ΝΑΙ";
                                    }else{
                                        echo "ΟΧΙ";
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col">
                            <h5>Βιβλιογραφία</h5>
                            <p><?php echo $row['bibliography']?></p>
                        </div>
                        <div class="col">
                            <h5>Μέρος που σώζεται</h5>
                            <p><?php echo $row['inscriptionSurvivingPart']?></p>
                        </div>
                        <div class="col">
                            <h5>Ζημιές</h5>
                            <p><?php echo $row['inscriptionDamages']?></p>
                        </div>
                        <div class="col">
                            <h5>Αποξέσεις της επιφάνειας </h5>
                            <p><?php echo $row['surfaceScratches']?></p>
                        </div>
                        <div class="col">
                            <h5>Αποξέσεις γραμμάτων</h5>
                            <p><?php echo $row['scrapingOfLetters']?></p>
                        </div>
                        <div class="col">
                            <h5>Εξίτηλα γράμματα</h5>
                            <p><?php echo $row['erasedLetters']?></p>
                        </div>
                        <div class="col">
                            <h5>Πιθανά ίχνη χρώματος</h5>
                            <p><?php echo $row['tracesOfPaint']?></p>
                        </div>
                        <div class="col">
                            <h5>Οδηγοί χάραξης</h5>
                            <p><?php echo $row['etchGuides']?></p>
                        </div>                        
                        <div class="col">
                            <h5>Μέγιστο σωζόμενο ύψος γραμμάτων (cm)</h5>
                            <p><?php echo $row['maxLetterHeight']?></p>
                        </div>
                        <div class="col">
                            <h5>Ελάχιστο σωζόμενο ύψος γραμμάτων (cm)</h5>
                            <p><?php echo $row['minLetterHeight']?></p>
                        </div>
                        <div class="col">
                            <h5>Μέγιστο σωζόμενο πλάτος γραμμάτων (cm)</h5>
                            <p><?php echo $row['maxLetterWidth']?></p>
                        </div>
                        <div class="col">
                            <h5>Ελάχιστο σωζόμενο πλάτος γραμμάτων (cm)</h5>
                            <p><?php echo $row['minLetterWidth']?></p>
                        </div>
                        <div class="col">
                            <h5>Βάθος Χάραξης (cm)</h5>
                            <p><?php echo $row['engravingDepth']?></p>
                        </div>
                        <div class="col">
                            <h5>Έχει γίνει αυτοψία</h5>
                            <p>
                                <?php 
                                    if($row['autopsyStatement'] == 1){
                                        echo "ΝΑΙ";
                                    }else{
                                        echo "ΟΧΙ";
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col">
                            <h5>Υπάρχει έκτυπο</h5>
                            <p>
                                <?php 
                                    if($row['inscriptionPrint'] == 1){
                                        echo "ΝΑΙ";
                                    }else{
                                        echo "ΟΧΙ";
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="col">
                            <h5>Φορά γραφής</h5>
                            <p><?php echo $row['directionOfWriting']?></p>
                        </div>
                        <div class="col">
                            <h5>Αριθμός των σωζόμενων στίχων</h5>
                            <p><?php echo $row['survivingVersesNum']?></p>
                        </div>
                        <div class="col">
                            <h5>Κείμενο Επιγραφής</h5>
                            <p><?php echo $row['text']?></p>
                        </div>
                        <div class="col">
                            <h5>Μετάφραση</h5>
                            <p><?php echo $row['translate']?></p>
                        </div>
                        <div class="col">
                            <h5>Σχολιασμός υπεστιγμένων γραμμάτων</h5>
                            <p><?php echo $row['letterCases']?></p>
                        </div>
                        <div class="col">
                            <h5>Σχόλια για την γραμματική</h5>
                            <p><?php echo $row['grammarRemarks']?></p>
                        </div>
                        <div class="col">
                            <h5>Προσωπογραφία</h5>
                            <p><?php echo $row['peopleConnectivity']?></p>
                        </div>
                        <div class="col">
                            <h5>Αποκατάσταση Κειμένου</h5>
                            <p><?php echo $row['textRestoration']?></p>
                        </div>
                        <div class="col">
                            <h5>Σχόλια</h5>
                            <p><?php echo $row['comments']?></p>
                        </div>
                        <div class="col">
                            <h5>Υπερσύνδεσμος</h5>
                            <p><a href="<?php echo $row['hyperlink']?>"><?php echo $row['hyperlink']?></a></p>
                        </div>
                    </div>
        <?php 
                }
            // In case the user change the ID on the url but, it does not exist in the database
            }else{
                echo "Inscription No:" . $inscriptionID . " does not exist";
            }
        ?>
    </div>

</body>
</htmL>