<!-- Session between treasuresInsert.php and treasuresDELETE.php in order to pass the status of insert-delete as messages with super global $_SESSION-->
<?php session_start();?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αρχειακές Πηγές</title>
    <style>
        <?php 
        include '../css/navbar.css';
        include '../css/treasures/treasures.css'; 
        include '../css/treasures/treasures_tb2.css';
        ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons (class bi)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- Jquery file(teleport user at the end of the page to add new column) -->
    <script type="text/javascript" src="teleport_button.js"></script>
</head>
<body>
    <?php include "../connDB.php";?>
    <?php include "../navbar.php"; ?>

    <!-- When user navigates from a previous page that use $_SESSION["greater_description_name"] it should be unset(dont keep data from previous page) -->
    <?php unset($_SESSION["greater_description_name"]); ?> 

    <h3 id="main_title">Αρχειακές Πηγές</h3>

    <!-- Responsive container for the display of the data from archivesources mysql table with table structure -->
    <div class="container col-9 col-sm-7 col-md-6 col-lg-5 col-xl-4 text-center">
        <!-- Checking the value that is returned from treasuresInsert-treasuresDELETE.php to display the appropriate message -->
        <?php
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];

                if($message == "Record deleted succesfully!" || $message == "Inserted Succesfully!")
                {
        ?>
                    <!-- Green box for successful messages  -->
                    <div class="alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
        <?php
                }
                else
                {
        ?>
                    <!-- Red box for unsuccessful messages  -->
                    <div class="alert alert-danger" role="alert">
                        <?php echo $message; ?>
                    </div>
        <?php
                }
                // Clear the session variable so the message won't be displayed again on refresh
                unset($_SESSION['message']);
            }
        ?>
        <!-- Plus button that teleports the user to the element at the end of the page to add new column -->
        <button type="button" class="btn btn-secondary" id="teleport_button"><i class="bi bi-plus"></i></button>
        <!-- Arrow up button that teleports the user to the top of the page -->
        <button type="button" class="btn btn-secondary" id="teleport_top"><i class="bi bi-arrow-up"></i></button>
        <!-- Table structure for to display the data from the database -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Περιγραφή</th>
                    <th></th>
                </tr>                
            </thead>
            <?php 
                /* Make the specific treasure more dynamic with superglobal $_SESSION and simple
                variables. Put the neccesary column names from the table that we want to access and display to the user 
                in the following superglobal variables.*/
                // In this way ../treasures/php files share the treasuresDELETE and treasuresINSERT.php
                $_SESSION["table_name"] = "archivesources";
                $_SESSION["id_name"] = "archiveSourcesID";
                $_SESSION["description_name"] = "description";

                $table_name = $_SESSION["table_name"];
                $id_name = $_SESSION["id_name"];
                $description_name =  $_SESSION["description_name"];

                $sql = "SELECT * from $table_name order by $id_name ASC";
                $result = $conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row = $result->fetch_assoc())
                    { 
            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row[$description_name]?></td>
                            <td>
                                <!-- Send the ID of the row that should be deleted to treasuresDELETE.php -->
                                <form action="treasuresDELETE.php" method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $row[$id_name];?>">
                                    <button type="submit" class="bi bi-trash btn btn-outline-danger"></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
            <?php   }
                }
                $conn->close();
            ?>
        </table>
    </div>
    <!-- Post request of the user's submit in order to add new column -->
    
    <form id="add_new_column" action="treasuresINSERT.php" method="POST">
        <p id="paragraph">Add new archive source</p>
        <input type="text" maxlength="255" name="description_box">
        <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
    </form>
    

</body>
</html>