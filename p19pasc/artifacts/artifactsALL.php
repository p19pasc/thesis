<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργα</title>
    <style>
        <?php 
        include '../css/navbar.css'; 
        include '../css/artifacts/artifactsCards.css';
        ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../connDB.php"; ?>
    <?php include "../navbar.php"; ?>
    <h3 id="main_title">Όλα τα τέχνεργα</h3>


        <div class="container col-lg-6 col-xl-5">
            <?php
                // SQL query for all artifacts that exists in artifacts table in the database. (Alphabetical order)
                $sql = "SELECT artifacts.artifactID, artifacts.description as artifactsDescription, material.description as materialDescription, 
                        artifactType.description as artifactTypeDescription, sites.description as sitesDescription FROM artifacts
                        JOIN sites ON sites.siteID = artifacts.siteID
                        JOIN material ON artifacts.materialID = material.materialID
                        JOIN artifactType ON artifacts.artifacttypeID = artifactType.artifactTypeID
                        ORDER BY artifactsDescription ASC";
                $result = $conn->query($sql);

                if($result->num_rows>0){
            ?>
            <table class="table table-bordered table-hover mx-auto">
                <thead>
                    <tr>
                        <th>Όνομα</th>
                        <th>Είδος</th>
                        <th>Υλικό</th>
                        <th>Τόπος Ευρήματος</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = $result->fetch_assoc()){
                    ?>
                    <tr class="clickable_row" data-id = "<?php echo $row['artifactID']?>">
                            <td><?php echo $row['artifactsDescription']?></td>
                            <td><?php echo $row['artifactTypeDescription']?></td>    
                            <td><?php echo $row['materialDescription']?></td>
                            <td><?php echo $row['sitesDescription']?></td>                    
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
            // When a row of the table is clicked, save the id of the row and pass it through get request to artifactsSHOW.php
            $(".clickable_row").click(function () {
                var artifactID = $(this).attr("data-id");
                window.location.href = "artifactsSHOW.php?artifactID=" + artifactID;
            });
        
        });
    </script>
           
</body>
</html>