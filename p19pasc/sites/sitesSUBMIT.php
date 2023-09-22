<?php 
    // Create a session with sitesINSERT.php to pass message from sitesINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    $sql = "SELECT * from siteKind";
    $result_siteKind = $conn->query($sql);

    $sql = "SELECT placenamesID, DescriptionGR from placenames";
    $result_placeNames = $conn->query($sql);

    $sql = "SELECT periodID, startYear, endYear, datingMethod FROM chronologyPeriods order By startYear";
    $result_chronologyPeriods = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τόπος Ανασκαφής</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Προσθήκη νέου τόπου ανασκαφής</h3>

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

        <button id="goback" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a></button>

        <div class="col mb-3">
            <a href="../chronologyPeriods/chronologyPeriodsSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Νέα Χρονολογία</a>
        </div>
        
        <form action="sitesINSERT.php" method="POST">
            <!-- row class used for creating horizontal groups of columns within the grid system 
                row-cols-md-3   is utility class for 3 div class="col" in the same row (md ≥768px)
                row-cols-1 is utility class for 1 div class="col" in the row (for the rest px)
                g-2 utility class for gap between the cols
            -->
            <div class="row row-cols-1 row-cols-md-3 g-2">
                <div class="col">
                    <select class="form-select" name="kindOfSiteID" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Είδος Περιοχής</option>
                        <?php
                            While($row = $result_siteKind->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["kindOfSiteID"]; ?>"><?php echo $row["description"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select text-truncate" name="placeNameID" required>
                        <option value="" selected disabled>Περιφέρεια τόπου ανασκαφής</option>
                        <?php
                            While($row = $result_placeNames->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["placenamesID"]; ?>"><?php echo $row["DescriptionGR"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select text-truncate" name="periodID" required>
                        <option value="" selected disabled>Περίοδος όλων των ευρημάτων του χώρου ανασκαφής</option>
                        <?php
                            While($row = $result_chronologyPeriods->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["periodID"]; ?>"><?php echo $row["startYear"] . " " . $row["endYear"]. " " .$row["datingMethod"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-4 pt-4">
                    <label for="description">Όνομα τόπου ανασκαφής</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="description" name="description" placeholder="Όνομα τόπου ανασκαφής" required>
            </div>
            <!-- Create a div with text-center to center the button and mt-3 mb-3 for margin  top and bottom -->
            <div class="text-center mt-3 mb-3">
                <button type="submit" name="submit_sites" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#goback").click(function(event) {
                <?php 
                     // IF the user navigates to chronologyPeriodsSUBMIT and submit the form, then "go back" button needs to be clicked twice.
                    // The first time will navigate the user to the form (again) with the data inside the input elements and if the "go back" 
                    // button will be clicked again then user will be redirected to the previous page that came from.
                    if(isset($_SESSION['form_success'])){
                        if($_SESSION['form_success']){
                            // The 2 echo acts like the button is clicked twice
                            echo "history.back();";
                            echo "history.back();";
                            unset($_SESSION['form_success']);
                        }
                    }else{
                        // If user does not submit the form with one click "go back" button will redirect to previous page imediately
                        echo "history.back();";
                    }
                ?> 
                        
            });                
        });
    </script>
</body>
</html>

