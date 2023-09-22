<?php
    // Create a session with bibliographySUBMIT.php to pass message from bibliographyINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_bibliography"])){
            // Create the INSERT INTO query until before "VALUES" 
            $insert_string = "INSERT INTO bibliography(";
            // Create the INSERT INTO query from "VALUES" until the end
            $values_string = "VALUES(";
            foreach($_POST as $name => $value){
                    // Each variable that has value from the user in the form add it to the query
                    if(!empty($value)){
                        $insert_string = $insert_string . $name . ",";
                        // The variables in if statement are int type. Int type does not need "" in insert query
                        if($name != 'editionNumber' && $name != 'editionYear' && $name != 'collectiveBody'){
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
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in bibliographySUBMIT.php
            $_SESSION["message"] = $message;
            $conn->close();
            // Redirect to the previous page
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        // If the user did not accessed the page with POST request, redirect to the home page after a delay of 4 seconds
        header("Refresh: 4; url=../index.php");
        echo "You have accessed this page without submiting a form. Redirecting you to the home page...";
    }


?>