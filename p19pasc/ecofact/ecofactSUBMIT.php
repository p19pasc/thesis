<?php
    // create a session with ecofactINSERT.php to pass message from ecofactINSERT.php through $_SERVER superglobal
    session_start();
    include "../connDB.php";
    
    $sql = "SELECT siteID, description FROM sites";
    $result_sites = $conn->query($sql);

    $sql = "SELECT * from ecofactMethods";
    $result_ecofactMethods = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προσθήκη νέου Κλιματικού/Περιβαλλοντικού Δεδομένου</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons, bi class -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>


    <h3 id="main_title">Προσθήκη νέου Κλιματικού/Περιβαλλοντικού Δεδομένου</h3>
    <div class="container w-75">
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
        <a href="ecofactMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        <div class="col mb-3">
                <a href="../sites/sitesSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Νέος Τόπος Ανασκαφής</a>
            </div>
        <form action="ecofactINSERT.php" method="POST">
            <div class="row row-cols-1 row-cols-md-2 g-2">
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
                    <select class="form-select" name="ecofactMethodID" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Μέθοδος</option>
                        <?php
                            While($row = $result_ecofactMethods->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["ecofactMethodID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="row second_row row-cols-1 row-cols-md-2 g-3 pt-4">
                <div class="col">
                    <label for="description">Περιγραφή</label>
                    <input type="text" maxlength="255" class="form-control" id="description" name="description" placeholder="Περιγραφή" required>
                </div>                      
                <div class="col">
                    <label for="appliedMethodDate">Ημερομηνία εφαρμογής της μεθόδου</label>
                    <input type="date" class="form-control" id="appliedMethodDate" name="appliedMethodDate" required>
                </div>  
                <div class="col">
                    <label for="hyperlink">Υπερσύνδεσμος</label>
                    <input type="text" maxlength="255" class="form-control" id="hyperlink" name="hyperlink" placeholder="Υπερσύνδεσμος" required>
                </div>  
                <div class="col">
                    <p>Κατηγορία</p>  
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ecofactType" value="1" id="ecofactType" required>
                        <label class="form-check-label" for="ecofactType">
                            Γεωλογικό/Γεωμορφολογικό Δεδομένο
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ecofactType" value="2" id="ecofactType">
                        <label class="form-check-label" for="ecofactType">
                            Οικοδεδομένο
                        </label>
                    </div>
                </div>    
                <div class="col">
                    <p>Μορφή Αρχείου</p>  
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataType" value="1" id="dataType" required>
                        <label class="form-check-label" for="dataType">
                            Json
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataType" value="2" id="dataType">
                        <label class="form-check-label" for="dataType">
                            XML
                        </label>
                    </div>
                </div>   
            </div>
            <div class="text-center mt-3 mb-3">
                <button type="submit" name="submit_ecofact" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
                