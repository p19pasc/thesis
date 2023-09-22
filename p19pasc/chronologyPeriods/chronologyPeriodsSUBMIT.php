<?php 

    // Create a session with chronologyPeriodsINSERT.php to pass message from chronologyPeriodsINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";
    $sql = "SELECT * from chronologyENG";
    $result_chronologyENG = $conn->query($sql);

    $sql = "SELECT chronologyID, periodDescription from chronologyGR";
    $result_chronologyGR = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Χρονολογική Περίοδος</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Προσθήκη χρονολογικής περιόδου</h3>

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
        <form action="chronologyPeriodsINSERT.php" method="POST">
            <div class="row row-cols-1 row-cols-md-2  g-2">
                <div class="col">
                    <select class="form-select" name="chronologyENGID" required>
                        <!-- required combined with value= "" , display message for the user to pick an option from the list that has a value.
                            Selected: Display this <option> as a choice to the dropdown list
                            Disabled: When another option will be chosen, the user can't choose this option
                        -->
                        <option value="" selected disabled>Χρονολογική Περίοδος ENG</option>
                        <?php
                            While($row = $result_chronologyENG->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["chronologyEngID"]; ?>"><?php echo $row["periodDescription"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" name="chronologyGRID" required>
                        <option value="" selected disabled>Χρονολογική Περίοδος GR</option>
                        <?php
                            While($row = $result_chronologyGR->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row["chronologyID"]; ?>"><?php echo $row["periodDescription"];?></option>
                        <?php    
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="row second_row row-cols-1 row-cols-md-2 g-3 pt-4">
                <div class="col">
                    <label for="startYear">Αρχικό Έτος Περιόδου</label>
                    <input type="number" class="form-control" id="startYear" name="startYear" placeholder="Αρχικό Έτος Περιόδου (μη υποχρεωτικό)">
                </div>        
                <div class="col">
                    <label for="endYear">Τελικό Έτος Περιόδου</label>
                    <input type="number" class="form-control" id="endYear" name="endYear" placeholder="Τελικό Έτος Περιόδου (ή συγκεκριμένο έτος)" required>
                </div>        
                <div class="col">
                    <label for="datingMethod">Μέθοδος Χρονολόγησης</label>
                    <input type="text" maxlength="255" class="form-control" id="datingMethod" name="datingMethod" placeholder="Μέθοδος Χρονολόγησης (c14, Δενδροχρονολόγηση, ..)" required>
                </div>
            </div>
            <div class="text-center mt-3 mb-3">
                <button type="submit" name="submit_chronologyPeriods" class="btn btn-secondary">Submit</button>
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
                        echo "history.back()";
                    }
                ?> 
                        
                });
                
        });
    </script>
</body>
</html>

