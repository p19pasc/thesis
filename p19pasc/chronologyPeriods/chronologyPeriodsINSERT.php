<?php
    // Create a session with chronologyPeriodsSUBMIT.php to pass message from chronologyPeriodsINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_chronologyPeriods"])){
            // startYear column in chronologyperiods table is nullable. If user submit the form with empty startYear its value will be '' (empty string).
            // We want with php to insert in database only columns that have value from the submited form( if startYear = 0 it has value).
            // Because empty string make it harder due to the if statments I have made, I give startYear the value of NULL, so that 
            // it will be checked with !isnull($value) after foreach. 
            if($_POST['startYear'] == ''){$_POST['startYear'] = NULL;}

            // Create the INSERT INTO query until before "VALUES" 
            $insert_string = "INSERT INTO chronologyPeriods(";
            // Create the INSERT INTO query from "VALUES" until the end
            $values_string = "VALUES(";
            foreach($_POST as $name => $value){
                // Each variable that has value from the user in the form, add it to the query
                    if(!is_null($value) && $name != 'submit_chronologyPeriods'){
                        $insert_string = $insert_string . $name . ",";
                        // The variables in if statement are int type. Int type does not need "" in insert query
                        if($name != 'startYear' && $name != 'endYear' && $name != 'chronologyENGID' && $name != 'chronologyGRID'){
                            // Escape ', ", \, and null 
                            $escape = addslashes($value);
                            $values_string = $values_string . "'$escape'" . ",";
                        }else
                        { 
                            $values_string = $values_string . $value . ",";
                        }
                    }
            }
            // Remove the last ',' from the string that is stored in $insert_string
            $insert_string = rtrim($insert_string, ',');
            $insert_string = $insert_string . ")";
            // Remove the last ',' from the string that is stored in $values_string
            $values_string = rtrim($values_string, ',');
            $values_string = $values_string . ")";
            // Concatenate the two strings to create the whole INSERT INTO query, that contain the necessary variables and their values
            // The variables that wont participate in the query will stay NULL in the database.
            $sql = $insert_string . " " . $values_string;

            // Execute the query 
            $result = $conn->query($sql);
            
            if($result){
                $message = "Inserted Succesfully!";
            }else {
                $message = "Insertion Unsuccessful!";
            }
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in artifactsSUBMIT.php
            $_SESSION["message"] = $message;
            $conn->close();
            $_SESSION["form_success"] = True;
            // Redirect to the previous page
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        // If the user did not accessed the page with POST request, redirect to the home page after a delay of 4 seconds
        header("Refresh: 4; url=../index.php");
        echo "You have accessed this page without submiting a form. Redirecting you to the home page...";
    }
?>
            
