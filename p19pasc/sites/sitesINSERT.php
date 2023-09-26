<?php
    // Create a session with sitesSUBMIT.php to pass message from sitesINSERT.php through $_SESSION superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_sites"])){
            $kindOfSiteID = $_POST['kindOfSiteID'];
            $placeNameID = $_POST['placeNameID'];
            $periodID = $_POST['periodID'];
            $description = addslashes($_POST['description']);

            $sql = "INSERT INTO sites (description, kindOfSiteID, placeNameID, periodID) VALUES ('$description', $kindOfSiteID, $placeNameID, $periodID)";
            $result = $conn->query($sql);

            if($result){
                $message = "Inserted Succesfully!";
            }else {
                $message = "Insertion Unsuccessful!";
            }
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in sitesSUBMIT.php
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