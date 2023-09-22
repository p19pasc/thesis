<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Περιβελλοντικά Δεδομένα</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/MAIN.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons, bi class -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Κλιματικά/Περιβαλλοντικά Δεδομένα</h3>

    <!-- D-flex class allows to adjust the buttons in the center of it with justify-content-center.
         In this MAIN.php file the d-flex is outside of container to avoid the "table-bordered" class
         (in small screen) that allows to scroll left-right not only the table but the <button> inside the d-flex also.-->
    <div class="d-flex justify-content-center">
        <!-- Button that navigates the user to ecofactSUBMIT.php to add new interview -->
        <a href="ecofactSUBMIT.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus"></i>Εισαγωγή Νέου Περιβαλλοντικού Δεδομένου</a>
    </div>

    <div class="container table-responsive">
        <table class="table table-bordered table-hover w-auto mx-auto text-truncate">
            <thead>
                <tr>
                    <th>Χώρος Ανασκαφής</th>
                    <th>Μέθοδος</th>
                    <th>Περιγραφή</th>
                    <th>Κατηγορία</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT sites.description as sitesDesc, 
                            CASE
                                WHEN LENGTH(ecofact.description) > 100 THEN CONCAT(LEFT(ecofact.description, 100), '...')
                                ELSE ecofact.description
                            END AS ecofactDesc,
                            ecofactID, ecofactType, ecofactMethods.description as ecofactMethodsDesc
                            FROM sites 
                            JOIN ecofact ON sites.siteID = ecofact.siteID
                            JOIN ecofactMethods ON ecofact.ecofactMethodID = ecofactMethods.ecofactMethodID
                            ORDER BY sitesDesc, ecofactMethodsDesc";
                    $result = $conn->query($sql);
                    // Create table rows, if the sql query returns at least 1 row
                    if($result->num_rows>0){
                        While($row = $result->fetch_assoc()){
                ?>
                            <!-- data-id keeps the id of the specific row -->
                            <tr class="clickable_row" data-id = "<?php echo $row['ecofactID']?>">
                                <td><?php echo $row['sitesDesc']?></td>
                                <td><?php echo $row['ecofactMethodsDesc']?></td>             
                                <td><?php echo $row['ecofactDesc']?></td>  
                                <td>  
                                    <?php
                                        if($row['ecofactType'] == 1)
                                        {
                                            echo "Geofact";
                                        }else{
                                            echo "Biofact";
                                        }
                                    ?>
                                </td>                                
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
            // When a row of the table is clicked, save the id of the row and pass it through get request to ecofactSHOW.php
            $(".clickable_row").click(function () {
                var ecofactID = $(this).attr("data-id");
                window.location.href = "ecofactSHOW.php?ecofactID=" + ecofactID;
            });
        
        });
        </script>

</body>
</html>