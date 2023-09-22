<?php
    // Create a session with intervieweeSUBMIT.php to pass message from intervieweeINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_interviewee"])){
            //Escape ', ", \, and null with addslashed()
            $gender = $_POST["gender"];
            $educationLevel = $_POST["educationLevel"];
            $maritalstatus = $_POST["maritalstatus"];
            $birthPlace = $_POST["birthPlace"];
            $firstname = addslashes($_POST["firstname"]);
            $lastname = addslashes($_POST["lastname"]);
            $birthYear = $_POST["birthYear"];
            $birthPlaceText = addslashes($_POST["birthPlaceText"]);
            $professionNow = addslashes($_POST["professionNow"]);
            $professionPast = addslashes($_POST["professionPast"]);

            $sql = "INSERT INTO interviewee (firstname, lastname, birthYear, birthPlaceText, professionNow, professionPast, gender, educationLevel, maritalstatus, birthPlace) 
            VALUES ('$firstname', '$lastname', $birthYear, '$birthPlaceText', '$professionNow', '$professionPast', $gender , $educationLevel , $maritalstatus, $birthPlace)";

            // Execute the query 
            $result = $conn->query($sql);
            
            if($result){
                $message = "Inserted Succesfully!";
            }else {
                $message = "Insertion Unsuccessful!";
            }
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in intervieweeSUBMIT.php
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