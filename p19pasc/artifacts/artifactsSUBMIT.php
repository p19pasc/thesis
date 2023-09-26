<?php
    // create a session with artifactsINSERT.php to pass message from artifactsINSERT.php through $_SESSION superglobal
    session_start();
    include "../connDB.php";

    $sql = "SELECT siteID, description FROM sites";
    $result_sites = $conn->query($sql);

    $sql = "SELECT * from material order BY description";
    $result_material = $conn->query($sql);

    $sql = "SELECT artifacttypeID, description from artifactType order BY description";
    $result_artifactType = $conn->query($sql);

    $sql = "SELECT * from storagePlace order by description";
    $result_storagePlace = $conn->query($sql);

    $sql = "SELECT periodID, startYear, endYear, datingMethod FROM chronologyPeriods order By startYear";
    $result_chronologyPeriods = $conn->query($sql);

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προσθήκη νέου τέχνεργου</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>


    <h3 id="main_title">Προσθήκη νέου τέχνεργου</h3>
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
        <a href="artifactsMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        <!-- Row-cols-auto class takes ass much space as needed to display the content of col elements which are inside of it -->
        <div class="row row-cols-auto mb-3">
            <div class="col">
                <a href="../sites/sitesSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Νέος Τόπος Ανασκαφής</a>
            </div>
            <div class="col">
                <a href="../chronologyPeriods/chronologyPeriodsSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Νέα Χρονολογία</a>
            </div>
        </div>
        <form action="artifactsINSERT.php" method="POST">
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5 g-2">
                <div class="col">
                    <select class="form-select" name="siteID" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Τόπος Ανασκαφής</option>
                        <?php
                            While($row = $result_sites->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["siteID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="periodID" required>
                        <option value="" selected disabled>Χρονολογία στην οποία ανήκει</option>
                        <?php
                            While($row = $result_chronologyPeriods->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["periodID"]; ?>"><?php echo $row["startYear"] . " " . $row["endYear"]. " " .$row["datingMethod"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="materialID" required>
                        <option value="" selected disabled>Υλικό Τέχνεργου</option>
                        <?php
                            While($row = $result_material->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["materialID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="artifacttypeID" required>
                        <option value="" selected disabled>Είδος Τέχνεργου</option>
                        <?php
                            While($row = $result_artifactType->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["artifacttypeID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="storagePlaceID" required>
                        <option value="" selected disabled>Τόπος Φύλαξης</option>
                        <?php
                            While($row = $result_storagePlace->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["storagePlaceID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
            </div>

            <div class="row second_row row-cols-1 row-cols-md-2 g-3 pt-4">
                <div class="col">
                    <label for="description">Όνομα Τέχνεργου</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="description" name="description" placeholder="Όνομα" required>
                </div>
                <div class="col">
                    <label for="dateFound">Ημερομηνία Έυρεσης</label>
                    <input type="date" class="form-control" id="dateFound" name="dateFound" required>
                </div>
                <div class="col">
                    <label for="characteristics">Χαρακτηριστικά</label>
                    <input type="text" class="form-control" id="characteristics" name="characteristics" placeholder="Περιγράψτε τα χαρακτηριστικά του Τέχνεργου">
                </div>
                <div class="col">
                    <label for="survivingPart">Σωζόμενο Μέρος</label>
                    <input type="text" class="form-control" id="survivingPart" name="survivingPart" placeholder="Περιγράψτε το σωζόμενο μέρος του Τέχνεργου">
                </div>
                <div class="col">
                    <label for="damages">Φθορές</label>
                    <input type="text" class="form-control" id="damages" name="damages" placeholder="Αναφέρετε τις φθορές του Τέχνεργου">
                </div>
                <div class="col">
                    <label for="maintenanceWork">Εργασίες Συντήρησης</label>
                    <input type="text" class="form-control" id="maintenanceWork" name="maintenanceWork" placeholder="Αναφέρετε τις εργασίες συντήρησης">
                </div>
                <!-- step="any" more flexible (for double) if user wants to use the arrows inside the input box -->
                <div class="col">
                    <label for="objectWidth">Μήκος σωζόμενο</label>
                    <input type="number" step="any" class="form-control" id="objectWidth" name="objectWidth" placeholder="Μήκος σε εκατοστά">
                </div>
                <div class="col">
                    <label for="objectHeight">Ύψος σωζόμενο</label>
                    <input type="number" step="any" class="form-control" id="objectHeight" name="objectHeight" placeholder="Ύψος σε εκατοστά">
                </div>
                <div class="col">
                    <label for="objectDiameter">Διάμετρος</label>
                    <input type="number" step="any" class="form-control" id="objectDiameter" name="objectDiameter" placeholder="Διάμετρος σε εκατοστά">
                </div>
                <div class="col">
                    <label for="objectThickness">Πάχος</label>
                    <input type="number" step="any" class="form-control" id="objectThickness" name="objectThickness" placeholder="Πάχος σε εκατοστά">
                </div>
                <div class="col">
                    <p>Κατάσταση Τέχνεργου</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="wholeObject" value="1" id="wholeObject" required>
                        <label class="form-check-label" for="wholeObject">
                            Ολόκληρο Αντικείμενο
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="wholeObject" value="2" id="wholeObject">
                        <label class="form-check-label" for="wholeObject">
                            Μέρος Αντικειμένου
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="wholeObject" value="3" id="wholeObject">
                        <label class="form-check-label" for="wholeObject">
                            Δεν είναι γνωστό
                        </label>
                    </div>
                </div>
            </div>

            <!-- Create a div with text-center to center the button and mt-2 mb-2 for margin  top and bottom -->
            <div class="text-center mt-2 mb-2">
                <button type="submit" name="submit_artifacts" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>