<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Βιβλιογραφία</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/MAIN.css';?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons bi class-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Βιβλιογραφία</h3>

    <div class="container">

        <!-- D-flex class allows to adjust the buttons in the center of it with justify-content-center.-->
        <div class="d-flex justify-content-center">
            <!-- Button that navigates the user to bibliographySUBMIT.php to add new interview -->
            <a href="bibliographySUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Εισαγωγή Νέας Βιβλιογραφίας</a>
        </div>

        <!-- Table that displays the name of the author and the title of the bibliography table -->
        <!-- W-auto takes the width that is needed and mx-auto center the table inside the parent element  -->
        <table class="table table-bordered table-hover w-auto mx-auto">
            <thead>
                <tr>
                    <th>Ονοματεπώνυμο Συγγραφέα</th>
                    <th>Τίτλος</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT bibliographyID, nameBib, title FROM bibliography ORDER BY nameBib";
                    $result = $conn->query($sql);
                    if($result->num_rows>0){
                        While($row = $result->fetch_assoc()){
                        ?>
                                <!-- data-id keeps the id of the specific row -->
                                <tr class="clickable_row" data-id = "<?php echo $row['bibliographyID']?>">
                                    <td><?php echo $row['nameBib']?></td>
                                    <td><?php echo $row['title']?></td>                    
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
        // When a row of the table is clicked, save the id of the row and pass it through get request to bibliographySHOW.php
        $(".clickable_row").click(function () {
            var bibliographyID = $(this).attr("data-id");
            window.location.href = "bibliographySHOW.php?bibliographyID=" + bibliographyID;
        });
    
});


    </script>

</body>
</html>

