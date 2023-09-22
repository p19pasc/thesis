<?php
    // Session to pass the $_SESSION variables
    session_start();
    include "../connDB.php";

    // Checking if the user visits insert.php after POST request or typing the path in search bar
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $table_name = $_SESSION["table_name"];
        $description_name = $_SESSION["description_name"];

        // Checking if the treasure has two columns except the id. So it should has a description and 
        // a greater_description.
        if(!empty($_POST["description_box"]) && isset($_SESSION["greater_description_name"])){
        
                $greater_description_name = $_SESSION["greater_description_name"];
                $description = addslashes($_POST["description_box"]);
                $greater_description = addslashes($_POST["greater_description_box"]);
                $sql = "INSERT INTO $table_name ($description_name, $greater_description_name) VALUES ('$description','$greater_description')";
                $result = $conn->query($sql);
                unset($_SESSION["greater_description_name"]);

        // In this case the treasure has one column (description).
        }elseif(!empty($_POST['description_box'])){
        
                $description = addslashes($_POST["description_box"]);
                $sql = "INSERT INTO $table_name ($description_name) VALUES ('$description')";
                $result = $conn->query($sql);

        }else{
            $message = "You can't submit the form with empty description!";
        }

        if($result){
            $message = "Inserted Succesfully!";
        }

        $conn->close();
        // Store the message to superglobal $_SESSION 
        $_SESSION["message"] = $message;
        // Redirect to previous php file 
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }else{
        // Redirect to the home page after a delay of 4 seconds
        header("Refresh: 4; url=../index.php");
        echo "You have accessed this page without submiting a form. Redirecting you to the home page...";
    }
?>