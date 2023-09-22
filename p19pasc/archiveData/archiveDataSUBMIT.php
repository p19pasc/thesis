<?php
    // create a session with archiveDataINSERT.php to pass message from archiveDataINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    $sql = "SELECT * from archivesources";
    $result_archivesources = $conn->query($sql);

    $sql = "SELECT * from documentcategory";
    $result_documentcategoryID = $conn->query($sql);

    $sql = "SELECT informationCategoryID, description from informationcategory";
    $result_informationCategoryID = $conn->query($sql);
    
    $sql = "SELECT placenamesID as RecordPlacenamesID, DescriptionGR as RecordDescriptionGR from placeNames";
    $result_RecordPlaceNames = $conn->query($sql);

    $sql = "SELECT placenamesID as ReferencePlacenamesID, DescriptionGR as ReferenceDescriptionGR from placeNames";
    $result_ReferencePlaceNames = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εισαγωγή νέου αρχειακού υλικού</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons , bi class-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>


    <h3 id="main_title">Εισαγωγή νέου αρχειακού υλικού</h3>

    <!-- Container that includes the form and success/unsuccessful message of the insertion  -->
    <div class="container">
        <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];

                    if($message == "Inserted Succesfully!")
                    {
            ?>
                        <!-- Green box for successful messages  -->
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo $message;?>
                        </div>
            <?php
                    }
                    else
                    {
            ?>
                        <!-- Red box for unsuccessful messages  -->
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $message; ?>
                        </div>
            <?php
                    }
                    // Clear the session variable so the message won't be displayed again on refresh
                    unset($_SESSION['message']);
                }
            ?>

        <a href="archiveDataMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        <form action="archiveDataINSERT.php" method="POST">
            <!-- row class used for creating horizontal groups of columns within the grid system 
                Row-cols-xl-5 is utility class for 5 div class="col" in the same row (xl ≥1200px)
                row-cols-md-3   is utility class for 3 div class="col" in the same row (md ≥768px)
                row-cols-1 is utility class for 1 div class="col" in the row (for the rest px)
                g-2 utility class for specific gap (2) between the cols
            -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5 g-2">
                <div class="col">
                    <select class="form-select" name="archiveSourcesID" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Αρχειακή Συλλογή</option>
                        <?php
                            While($row = $result_archivesources->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["archiveSourcesID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                        </div>

                <div class="col">
                    <select class="form-select" name="documentCategoryID" required>
                        <option value="" selected disabled>Κατηγορία Τεκμηρίων</option>
                        <?php
                            While($row = $result_documentcategoryID->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["documentCategoryID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <!-- text-truncate utility class that puts dots at the end of <option> name when it does not fill in its div -->
                    <select class="form-select text-truncate" name="informationCategoryID" required>
                        <option value="" selected disabled>Κατηγορία Πληροφορίας</option>
                        <?php
                            While($row = $result_informationCategoryID->fetch_assoc()){
                        ?>
                        <option id="test" value="<?php echo $row["informationCategoryID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="placeOfRecord" required>
                        <option value="" selected disabled>Τόπος Καταγραφής</option>
                        <?php
                            While($row = $result_RecordPlaceNames->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["RecordPlacenamesID"]; ?>"><?php echo $row["RecordDescriptionGR"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="placeOfReference" required>
                        <option value="" selected disabled>Τόπος Αναφοράς</option>
                        <?php
                            While($row = $result_ReferencePlaceNames->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["ReferencePlacenamesID"]; ?>"><?php echo $row["ReferenceDescriptionGR"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

            </div>
            
            <div class="row second_row row-cols-1 row-cols-md-2 g-3 pt-4">
                <div class="col">
                    <label for="archiveTitle">Τίτλος αρχείου</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="archiveTitle" name="archiveTitle" placeholder="Τίτλος αρχείου" required>
                </div>

                <div class="col">
                    <label for="dossierNumbering">Φάκελος/Αρίθμηση</label>
                    <input type="text" maxlength="255" class="form-control" id="dossierNumbering" name="dossierNumbering" placeholder="Φάκελος/Αρίθμηση" required>
                </div>

                <div class="col">
                    <label for="thematicUnit">Θεματική ενότητα</label>
                    <input type="text" maxlength="255" class="form-control" id="thematicUnit" name="thematicUnit" placeholder="Θεματική ενότητα">
                </div>

                <div class="col">
                    <label for="documentTitle">Τίτλος Τεκμηρίου</label>
                    <input type="text" maxlength="255" class="form-control" id="documentTitle" name="documentTitle" placeholder="Τίτλος Τεκμηρίου" required>
                </div>

                <div class="col">
                    <label for="documentEditionDate">Ημερομηνία Έκδοσης</label>
                    <input type="date" class="form-control" id="documentEditionDate" name="documentEditionDate">
                </div>

                <div class="col">
                    <label for="documentEditionYear">Έτος Έκδοσης</label>
                    <input type="number" class="form-control" id="documentEditionYear" name="documentEditionYear" placeholder="Έτος Έκδοσης">
                </div>

                <div class="col">
                    <label for="documentReferenceDate">Ημερομηνία Αναφοράς</label>
                    <input type="date" class="form-control" id="documentReferenceDate" name="documentReferenceDate">
                </div>

                <div class="col">
                    <label for="documentReferenceYear">Αρχικό έτος αναφοράς</label>
                    <input type="number" class="form-control" id="documentReferenceYear" placeholder="Έτος Αναφοράς" name="documentReferenceYear">
                </div>

                <div class="col">
                    <label for="documentReferenceYearEnd">Τελικό έτος αναφοράς</label>
                    <input type="number" class="form-control" id="documentReferenceYearEnd" name="documentReferenceYearEnd" placeholder="Τελικό έτος αναφοράς">
                </div>

                <div class="col">
                    <label for="remarks">Παρατηρήσεις</label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Παρατηρήσεις" required>
                </div>

                <div class="col">
                    <label for="placeOfRecordText">Τόπος Καταγραφής (κείμενο)</label>
                    <input type="text" maxlength="255" class="form-control" name="placeOfRecordText" id="placeOfRecordText" placeholder="Περιγραφή τόπου καταγραφής" required>
                </div>

                <div class="col">
                    <label for="placeOfReferenceText">Τόπος Αναφοράς (κείμενο)</label>
                    <input type="text" maxlength="255" class="form-control" name="placeOfReferenceText" id="placeOfReferenceText" placeholder="Περιγραφή τόπου αναφοράς" required>
                </div>

                <div class="col">
                    <label for="digitalFile">Σύνδεσμος σε ψηφιακό αρχείο</label>
                    <input type="text" maxlength="255" class="form-control" name="digitalFile" id="digitalFile" placeholder="Σύνδεσμος σε ψηφιακό αρχείο" required>
                </div>

                <div class="col">
                    <label for="archiveKeywords">Λέξεις - Κλειδιά</label>
                    <input type="text" maxlength="255" class="form-control" name="archiveKeywords" id="archiveKeywords" placeholder="Λέξεις-Κλειδιά" required>
                </div>

                <div class="col">
                    <label for="summary">Περίληψη</label>
                    <input type="text" class="form-control" name="summary" id="summary" placeholder="Περίληψη" required>
                </div>

                <div class="col">
                    <label for="remarks">Παρατηρήσεις</label>
                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Παρατηρήσεις" required>
                </div>

                <div class="col">
                    <label for="quotation">Απόσπασμα</label>
                    <input type="text" class="form-control" name="quotation" id="quotation" placeholder="Απόσπασμα" required>
                </div>

                <div class="col">
                    <p>Στατιστικα Στοιχεία</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasStatistics" value="1" id="hasStatistics" required>
                        <label class="form-check-label" for="hasStatistics">
                            Υπάρχουν
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasStatistics" value="2" id="hasStatistics">
                        <label class="form-check-label" for="hasStatistics">
                            Δεν Υπάρχουν
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasStatistics" value="3" id="hasStatistics">
                        <label class="form-check-label" for="hasStatistics">
                            Δεν γνωρίζουμε
                        </label>
                    </div>
                </div>
            </div>     
            
            <!-- Create a div with text-center to center the button and mt-2 mb-2 for margin  top and bottom -->
            <div class="text-center mt-2 mb-2">
                <button type="submit" name="submit_archiveData" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>

