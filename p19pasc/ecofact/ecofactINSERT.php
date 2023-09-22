<?php
    // Create a session with ecofactSUBMIT.php to pass message from intervieweeINSERT.php through $_SERVER superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_ecofact"])){
            //Escape ', ", \, and null with addslashes()
            $siteID = $_POST['siteID'];
            $ecofactMethodID = $_POST['ecofactMethodID'];
            $description = addslashes($_POST['description']);
            $appliedMethodDate = $_POST['appliedMethodDate'];
            $hyperlink = addslashes($_POST['hyperlink']);
            $ecofactType = $_POST['ecofactType'];
            $dataType = $_POST['dataType'];

            $sql = "INSERT INTO ecofact (siteID, description, ecofactMethodID, ecofactType, appliedMethodDate, dataType, hyperlink)
                    VALUES ($siteID, '$description', $ecofactMethodID, $ecofactType, '$appliedMethodDate', $dataType, '$hyperlink')";
            $result = $conn->query($sql);

            if($result){
                $message = "Inserted Succesfully!";
            }else {
                $message = "Insertion Unsuccessful!";
            }
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in ecofactSUBMIT.php
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
