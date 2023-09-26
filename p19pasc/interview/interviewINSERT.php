<?php
    // Create a session with interviewSUBMIT.php to pass message from interviewINSERT.php through $_SESSION superglobal
    session_start();

    include "../connDB.php";

    // $_SERVER['REQUEST_METHOD'] === 'POST': if the user accessed the script with post method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["submit_interview"])){
            //Escape ', ", \, and null with addslashes()
            $interviewType = addslashes($_POST["interviewType"]);
            $recordingMedium = addslashes($_POST["recordingMedium"]);
            $interviewee = addslashes($_POST["interviewee"]);
            $interviewLocation = $_POST["interviewLocation"];
            $interviewer = addslashes($_POST["interviewer"]);
            $interviewLocationText = addslashes($_POST["interviewLocationText"]);
            $interviewDuration = $_POST["interviewDuration"];
            $program = addslashes($_POST["program"]);
            $interviewEditor = addslashes($_POST["interviewEditor"]);
            $paraxwritirio = addslashes($_POST["paraxwritirio"]);
            $mainInterviewTopic = addslashes($_POST["mainInterviewTopic"]);
            $interviewSummary = addslashes($_POST["interviewSummary"]);
            $keywords = addslashes($_POST["keywords"]);
            $remarks = addslashes($_POST["remarks"]);
            $interviewDate = addslashes($_POST["interviewDate"]);

            $sql = "INSERT INTO interview (interviewType, interviewer, interviewDate, interviewLocationText, interviewLocation, interviewDuration, recordingMedium, program, interviewEditor, paraxwritirio, interviewee, mainInterviewTopic, interviewSummary, keywords, remarks) 
            VALUES ('$interviewType', '$interviewer', '$interviewDate', '$interviewLocationText', $interviewLocation, $interviewDuration, '$recordingMedium', '$program', '$interviewEditor', '$paraxwritirio', '$interviewee', '$mainInterviewTopic', '$interviewSummary', '$keywords', '$remarks')";
            
            // Execute the query 
            $result = $conn->query($sql);
            
            if($result){
                $message = "Inserted Succesfully!";
            }else {
                $message = "Insertion Unsuccessful!";
            }
            // Initialize the $_SESSION["message"] with the message that will be displayed to the user in interviewSUBMIT.php
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