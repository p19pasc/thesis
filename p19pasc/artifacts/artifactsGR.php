                                    <!-- This page has similar code to artifactsENG.php -->
                                    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργα-GR</title>
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
    <h3 id="main_title">Αναζήση με βάση τις περιόδους GR</h3>


        <div class="container col-lg-6 col-xl-5">
            <form action="" method="POST">
            <div class="row">
                <div class="col">
                    <select class="form-control text-truncate" name="chronology_choice">
                        <option value="" selected disabled>Περίοδοι</option>
                        <?php
                            $sql = "SELECT chronologyID,periodDescription FROM chronologyGR";
                            $chronology = $conn->query($sql);
                            if($chronology->num_rows>0){
                                while($row = $chronology->fetch_assoc()){                                    
                        ?>
                        <option value="<?php echo $row["chronologyID"];?>"><?php echo $row["periodDescription"];?></option>   
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-secondary">Search</button> <!-- Submit button  -->
                </div>
            </div>
            </form>
            <?php
                if(isset($_POST["chronology_choice"]))
                {
                    $chronologyID = $_POST["chronology_choice"];
                    $sql = "SELECT artifacts.artifactID, artifacts.description as artifactsDescription, material.description as materialDescription, 
                            artifactType.description as artifactTypeDescription, sites.description as sitesDesc
                            FROM chronologyGR 
                            JOIN chronologyPeriods ON chronologyGR.chronologyID = chronologyPeriods.chronologyGRID
                            JOIN artifacts ON chronologyPeriods.periodID = artifacts.periodID
                            JOIN artifactType ON artifacts.artifacttypeID = artifactType.artifactTypeID
                            JOIN material ON artifacts.materialID = material.materialID
                            JOIN sites ON artifacts.siteID = sites.siteID
                            WHERE chronologyGR.chronologyID = $chronologyID";
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
                                            <td><?php echo $row['sitesDesc']?></td>        
                                        </tr>    
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                <?php
                    }else{
                ?>
                    <div class="d-flex text-center pt-5 justify-content-center" role="alert">
                        <p class="alert alert-warning">Δεν υπάρχουν σχετικές εγγραφές</p>
                    </div>   
            <?php
                    }
                }
            ?>
        </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".clickable_row").click(function () {
                var artifactID = $(this).attr("data-id");
                window.location.href = "artifactsSHOW.php?artifactID=" + artifactID;
            });
        
        });
    </script>
           
</body>
</html>