<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αρχειακό Υλικό</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/MAIN.css';?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Αρχειακό Υλικό</h3>

    <!-- D-flex class allows to adjust the buttons in the center of it with justify-content-center.
         In this MAIN.php file the d-flex is outside of container to avoid the "table-bordered" class
         (in small screen) that allows to scroll left-right not only the table but the <button> inside the d-flex also.-->
    <div class="d-flex justify-content-center">
        <!-- Button that navigates the user to archiveDataSUBMIT.php to add new interview -->
        <a href="archiveDataSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Εισαγωγή Αρχειακού Υλικού</a>
    </div>
    <div class="container table-responsive">
        
        <!-- Table that displays the name of the author, the title and the documentEditionDate of the archiveData table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Τίτλος Αρχείου</th>
                    <th>Τίτλος Τεκμηρίου</th>
                    <th>Ημερομηνία Έκδοσης</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT archiveDataID, archiveTitle, documentTitle, documentEditionDate FROM archivedata ORDER BY archiveTitle,documentTitle,documentEditionDate";
                    $result = $conn->query($sql);
                    if($result->num_rows>0){
                        While($row = $result->fetch_assoc()){
                        ?>
                                <!-- data-id keeps the id of the specific row -->
                                <tr class="clickable_row" data-id = "<?php echo $row['archiveDataID']?>">
                                    <td><?php echo $row['archiveTitle']?></td>
                                    <td><?php echo $row['documentTitle']?></td>                
                                    <td><?php echo $row['documentEditionDate']?></td>       
                                </tr>                    
                        <?php
                        }            
                    }
                ?>
            </tbody>
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // When a row of the table is clicked, save the id of the row and pass it through get request to archiveDataSHOW.php
        $(".clickable_row").click(function () {
            var archiveDataID = $(this).attr("data-id");
            window.location.href = "archiveDataSHOW.php?archiveDataID=" + archiveDataID;
        });
    
});


    </script>

</body>
</html>

