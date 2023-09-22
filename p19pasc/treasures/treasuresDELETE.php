<?php
    session_start();
    include "../connDB.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $table_name = $_SESSION["table_name"];
        $id_name = $_SESSION["id_name"];

        $id_num = $_POST["delete_id"];
        $sql = "DELETE FROM $table_name WHERE $id_name=$id_num";
        $result=$conn->query($sql);
        if($result){
            $message = "Record deleted succesfully!";
        }else{
            $message = "Something went wrong!";
        }
        $conn->close();
        // Store the message to superglobal $_SESSION
        $_SESSION["message"] = $message;
        // Redirect to sitekind.php 
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }else{
        // Redirect to the home page after a delay of 4 seconds
        header("Refresh: 4; url=../index.php");
        echo "You have accessed this page without clicking the delete button. Redirecting you to the home page...";
}
?>