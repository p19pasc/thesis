<?php
    // create a session with interviewINSERT.php to pass message from interviewINSERT.php through $_SESSION superglobal
    session_start();

    include "../connDB.php";

    $sql = "SELECT * from interviewtype";
    $result_interviewtype = $conn->query($sql);

    $sql = "SELECT * from recordingmediumtype";
    $result_recordingmediumtype = $conn->query($sql);

    $sql = "SELECT placenamesID, DescriptionGR from placeNames";
    $result_placenames = $conn->query($sql);

    $sql = "SELECT intervieweeID, firstname, lastname from interviewee";
    $result_interviewee = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Καταγραφή νέας συνέντευξης</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>


    <h3 id="main_title">Καταγραφή νέας συνέντευξης</h3>

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
        <form action="interviewINSERT.php" method="POST">
            <!-- row class used for creating horizontal groups of columns within the grid system 
                Row-cols-xl-4 is utility class for 4 div class="col" in the same row (xl ≥1200px)
                row-cols-md-2   is utility class for 2 div class="col" in the same row (md ≥768px)
                row-cols-1 is utility class for 1 div class="col" in the row (for the rest px)
                g-2 utility class for specific gap (2) between the cols
            -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2">
                <!-- The "name" attributes are the same with the table column names in the database (because they will be inserted, with
                     INSERT INTO query after the post request) -->
                <div class="col">
                    <select class="form-select" name="interviewType" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Τύπος Συνέντευξης</option>
                        <?php
                            While($row = $result_interviewtype->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["interviewTypeID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="recordingMedium" required>
                        <option value="" selected disabled>Μέσο Καταγραφής</option>
                        <?php
                            While($row = $result_recordingmediumtype->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["recordingTypeID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="interviewee" required>
                        <option value="" selected disabled>Πληροφορητής</option>
                        <?php
                            While($row = $result_interviewee->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["intervieweeID"]; ?>"><?php echo $row["firstname"] . " " . $row["lastname"]; ?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" name="interviewLocation" required>
                        <option value="" selected disabled>Τόπος Συνέντευξης</option>
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
                    <label for="interviewer">Ονοματεπώνυμο Συνεντευξιαστή/-ριας</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="interviewer" maxlength = "255" name="interviewer" placeholder="Όνομα - Επώνυμο" required>
                </div>

                <div class="col">
                    <label for="interviewLocationText">Τόπος Συνέντευξης (Κείμενο)</label>
                    <input type="text" maxlength="255" class="form-control" id="interviewLocationText" name="interviewLocationText" placeholder="Περιγραφή τόπου συνέντευξης" required>
                </div>

                <div class="col">
                    <label for="interviewDuration">Διάρκεια Συνέντευξης</label>
                    <input type="number" class="form-control" id="interviewDuration" name="interviewDuration" placeholder="Διάρκεια συνέντευξης σε λεπτά" required>
                </div>

                <div class="col">
                    <label for="program">Πρόγραμμα</label>
                    <input type="text" maxlength="255" class="form-control" id="program" name="program" placeholder="Περιγραφή Προγράμματος" required>
                </div>

                <div class="col">
                    <label for="interviewEditor">Επιμέλεια - Επεξεργασία συνέντευξης</label>
                    <input type="text" maxlength="255" class="form-control" id="interviewEditor" name="interviewEditor" placeholder="Όνομα - Επώνυμο" required>
                </div>

                <div class="col">
                    <label for="paraxwritirio">Παραχωρητήριο</label>
                    <input type="text" maxlength="255" class="form-control" id="paraxwritirio" name="paraxwritirio" placeholder="Παραχωρητήριο" required>
                </div>

                <div class="col">
                    <label for="mainInterviewTopic">Κύριο θέμα συνέντευξης</label>
                    <input type="text" maxlength="255" class="form-control" id="mainInterviewTopic" name="mainInterviewTopic" placeholder="Περιγραφή κύριου θέματος συνέντευξης" required>
                </div>

                <div class="col">
                    <label for="interviewSummary">Περίληψη</label>
                    <input type="text" class="form-control" id="interviewSummary" name="interviewSummary" placeholder="Περίληψη συνέντευξης" required>
                </div>

                <div class="col">
                    <label for="keywords">Λέξεις-κλειδιά</label>
                    <input type="text" maxlength="255" class="form-control" id="keywords" name="keywords" placeholder="Λέξεις-κλειδιά" required>
                </div>

                <div class="col">
                    <label for="remarks">Παρατηρήσεις</label>
                    <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Παρατηρήσεις" required>
                </div>

                <div class="col-2 w-auto p-auto">
                    <label for="interviewDate">Ημερομηνία συνέντευξης</label>
                    <input type="date" class="form-control" name="interviewDate" id="interviewDate" required>
                </div>
            </div>     
            
            <!-- Create a div with text-center to center the button and mt-2 mb-2 for margin  top and bottom -->
            <div class="text-center mt-2 mb-2">
                <button type="submit" name="submit_interview" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>

