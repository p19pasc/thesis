<?php
    // Create a session with intervieweeINSERT.php to pass message from intervieweeINSERT.php through $_SESSION superglobal
    session_start();

    include "../connDB.php";

    $sql = "SELECT * from gender";
    $result_gender = $conn->query($sql);

    $sql = "SELECT * from educationallevel";
    $result_educationallevel = $conn->query($sql);

    $sql = "SELECT placenamesID, DescriptionGR from placeNames";
    $result_placenames = $conn->query($sql);

    $sql = "SELECT * from maritalstatus";
    $result_maritalstatus = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Συνεντευξιαζόμενοι</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons bi class-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Προσθήκη Συνεντευξιαζόμενου</h3>

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
        <a href="interviewMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>
        <form action="intervieweeINSERT.php" method="POST">

            <!-- row class used for creating horizontal groups of columns within the grid system 
                Row-cols-xl-4 is utility class for 4 div class="col" in the same row (xl ≥1200px)
                row-cols-md-2   is utility class for 2 div class="col" in the same row (md ≥768px)
                row-cols-1 is utility class for 1 div class="col" in the row (for the rest px)
                g-2 utility class for gap between the cols -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2">
                <!-- The "name" attributes are the same with the table column names in the database (because they will be inserted, with
                     INSERT INTO query after the post request) -->
                <div class="col">
                    <select class="form-select" name="gender" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Φύλο</option>
                        <?php
                            While($row = $result_gender->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["ID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="educationLevel" required>
                        <option value="" selected disabled>Μορφωτικό Επίπεδο</option>
                        <?php
                            While($row = $result_educationallevel->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["educationalLevelID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="maritalstatus" required>
                        <option value="" selected disabled>Οικογενειακή Κατάσταση</option>
                        <?php
                            While($row = $result_maritalstatus->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["maritalStatusID"]; ?>"><?php echo $row["description"]; ?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="birthPlace" required>
                        <option value="" selected disabled>Τόπος Γεννήσεως</option>
                        <?php
                            While($row = $result_placenames->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["placenamesID"]; ?>"><?php echo $row["DescriptionGR"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
            </div>

            <div class="row second_row row-cols-1 row-cols-md-2 g-3 pt-4">

                <div class="col">
                    <label for="firstname">Όνομα</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="firstname" name="firstname" placeholder="Όνομα" required>
                </div>

                <div class="col">
                    <label for="lastname">Επώνυμο</label>
                    <input type="text" maxlength="255" class="form-control" id="lastname" name="lastname" placeholder="Επώνυμο" required>
                </div>

                <div class="col">
                    <label for="birthYear">Έτος Γέννησης</label>
                    <input type="number" class="form-control" id="birthYear" name="birthYear" placeholder="Έτος Γέννησης" required>
                </div>

                <div class="col">
                    <label for="birthPlaceText">Τόπος Γέννησης(κείμενο)</label>
                    <input type="text" maxlength="255" class="form-control" id="birthPlaceText" name="birthPlaceText" placeholder="Περιγραφή Τόπου Γεννήσεως" required>
                </div>

                <div class="col">
                    <label for="professionNow">Επάγγελμα(σήμερα)</label>
                    <input type="text" maxlength="255" class="form-control" id="professionNow" name="professionNow" placeholder="Περιγραφή Επαγγέλματος">
                </div>

                <div class="col">
                    <label for="professionPast">Προηγούμενο Επάγγελμα</label>
                    <input type="text" maxlength="255" class="form-control" id="professionPast" name="professionPast" placeholder="Περιγραφή Επαγγέλματος">
                </div>

            </div>     

            <!-- Create a div with text-center to center the button and mt-3 mb-3 for margin  top and bottom -->
            <div class="text-center mt-3 mb-3">
                <button type="submit" name="submit_interviewee" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>