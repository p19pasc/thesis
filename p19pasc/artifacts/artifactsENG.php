<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργα-ENG</title>
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
    <h3 id="main_title">Αναζήση με βάση τις περιόδους ENG</h3>

        <!-- Col class combined with col-sm/md/lg..-(number 1-12), sets the number of columns (grid system) that the container
             will take for the specific window size. -->
        <div class="container col-lg-6 col-xl-5">
            <!-- Form that is submitted on the same page when user click the submit button -->
            <form action="" method="POST">
                <!-- Row class to adjust in the same row, the col divs that contains the dropdown list and submit button -->
                <div class="row">
                    <div class="col">
                        <select class="form-control text-truncate" name="chronology_choice">
                            <option value="" selected disabled>Περίοδοι</option>
                            <?php
                                $sql = "SELECT * FROM chronologyENG";
                                $chronology = $conn->query($sql);
                                if($chronology->num_rows>0){
                                    while($row = $chronology->fetch_assoc()){                                    
                            ?>
                            <option value="<?php echo $row["chronologyEngID"];?>"><?php echo $row["periodDescription"];?></option>   
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
                // If user click submit button
                if(isset($_POST["chronology_choice"]))
                {
                    //  Save the id of the chronologyENG that user choosed
                    $chronologyEngID = $_POST["chronology_choice"];
                    $sql = "SELECT artifacts.artifactID, artifacts.description as artifactsDescription, material.description as materialDescription, 
                            artifactType.description as artifactTypeDescription, sites.description as sitesDesc
                            FROM chronologyENG 
                            JOIN chronologyPeriods ON chronologyENG.chronologyEngID = chronologyPeriods.chronologyENGID
                            JOIN artifacts ON chronologyPeriods.periodID = artifacts.periodID
                            JOIN artifactType ON artifacts.artifacttypeID = artifactType.artifactTypeID
                            JOIN material ON artifacts.materialID = material.materialID
                            JOIN sites ON artifacts.siteID = sites.siteID
                            WHERE chronologyENG.chronologyEngID = $chronologyEngID";
                    $result = $conn->query($sql);
                    // Check if the sql query returns at least 1 row and create a table to display the results
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
                                    // Each table row that is created, user can click it and navigate to show.php file with javascript
                                    while($row = $result->fetch_assoc()){
                                ?>
                                        <!-- data-id keep the id of the specific row -->
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
                        <!-- In case user has created a site that does not contain any artifacts -->
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
            // When a row of the table is clicked, save the id of the row and pass it to artifactsSHOW.php
            $(".clickable_row").click(function () {
                var artifactID = $(this).attr("data-id");
                window.location.href = "artifactsSHOW.php?artifactID=" + artifactID;
            });
        
        });
    </script>
           
</body>
</html>