<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργα-Χώροι Ανασκαφής</title>
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

    <h3 id="main_title">Αναζήτηση με βάση τον τόπο ανασκαφής</h3>

        <!-- Col class combined with col-sm/md/lg..-(number 1-12), sets the number of columns (grid system) that the container
             will take for the specific window size. -->
        <div class="container col-lg-6 col-xl-5">
            <!-- Form that is submitted on the same page when user click the submit button -->
            <form action="" method="POST">
                <!-- Row class to adjust in the same row, the col divs that contains the dropdown list and submit button -->
                <div class="row">
                    <div class="col">
                        <select class="form-control text-truncate" name="site_choice">
                            <option value="" selected disabled>Τόπος Ευρήματος</option>
                            <?php
                                $sql = "SELECT sites.siteID, sites.description as sitesDescription FROM sites";
                                $sites = $conn->query($sql);
                                if($sites->num_rows>0){
                                    while($row = $sites->fetch_assoc()){                                    
                            ?>
                            <option value="<?php echo $row["siteID"];?>"><?php echo $row["sitesDescription"];?></option>   
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
                if(isset($_POST["site_choice"]))
                {
                    //  Save the id of the site that user choosed
                    $siteID = $_POST["site_choice"];
                    $sql = "SELECT artifacts.artifactID, artifacts.description as artifactsDescription, material.description as materialDescription, 
                            artifactType.description as artifactTypeDescription FROM sites
                            JOIN artifacts ON sites.siteID = artifacts.siteID
                            JOIN material ON artifacts.materialID = material.materialID
                            JOIN artifactType ON artifacts.artifacttypeID = artifactType.artifactTypeID
                            WHERE sites.siteID = $siteID";
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