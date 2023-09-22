<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUTS - ΕΛΣΤΑΤ</title>
    <style>
        <?php 
        include '../css/navbar.css'; 
        include '../css/treasures/nuts.css';
        ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../connDB.php";?>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Ένδειξη NUTS - ΕΛΣΤΑΤ</h3>

    <!-- Create a form with POST method to submit the choice of the user -->
    <form action="nuts.php" method="POST">

        <!-- A class that contains the dropdown list and submit button with responsive design -->
        <div class="container col-lg-6 col-xl-5"> 
            <!-- Row class to justify the dropdown list and the button on the same line -->
            <div class="row"> 
                <div class="col">
                    <!-- Drop down list -->
                    <select class="form-control" name="nuts_categories"> 
                        <option value="">Select a category</option>
                        <option value="Περιφερειακές Ενότητες">Περιφερειακές Ενότητες</option>
                        <option value="Δήμοι">Δήμοι</option>
                        <option value="Δημοτικές Ενότητες">Δημοτικές Ενότητες</option>
                        <option value="Κοινότητες">Κοινότητες</option>
                    </select>
                </div>
                <div class="col">
                    <!-- Submit button  -->
                    <button type="submit" class="btn btn-secondary">Search</button> 
                </div>
            </div>
        </div>
    </form>
    <!-- table_container(not a bootstrap class) class contains the whole table that displays the data from the database as long as the user click the submit button.
         table-responsive: if the table does not fit in the window, user can scroll left-right.
         col-md-8: takes 8 out of 12 columns of the screen(grid system) for >=768px until 1200px because col-xl-12 will take 12 out of 12 col for >=1200px  -->
    <div class="container table_container col-md-8 col-xl-12 table-responsive">

        <?php
            // If satement to check if the user has choosen an option and pressed the submit button
            if(isset($_POST["nuts_categories"])){  

                // If satement to check if "Περιφερειακές Ενότητες" is selected
                if($_POST["nuts_categories"] == "Περιφερειακές Ενότητες"){ 
                    $sql = "SELECT NUTS, CodeGR, DescriptionGR, CodeEU, DescriptionEU FROM placenames";
                    // The sql query will be executed
                    $result = $conn->query($sql); 
                    //Check If the query returned data from the database 
                    if($result->num_rows > 0){ 
                        // Display the number of returned rows
                        echo "Αριθμός Περιφερειακών Ενοτήτων: " . $result->num_rows; 
                        // Create table by using php (not good option). This is the only file that use php to create html elements.
                        echo "<table class='table table-sm table-bordered'>";
                        echo "<thead> 
                                <tr>
                                    <th>NUTS 1, 2</th> 
                                    <th>Ελληνικός Κωδικός</th>
                                    <th>Ελληνική Ονομασία</th>
                                    <th>Ευρωπαϊκός Κωδικός</th>
                                    <th>Ευρωπαϊκή Ονομασία</th>
                                </tr>
                                </thead>
                                <tbody id='nuts_table'>";
                        // Each loop returns one row of data and display it in the table 
                        While($row = $result->fetch_assoc()){ 
                            echo "<tr><td>" . $row["NUTS"] . "</td><td>" . $row["CodeGR"] . "</td><td>" .  $row["DescriptionGR"] . "</td><td>" . $row["CodeEU"] . "</td><td>" . $row["DescriptionEU"] . "</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "<p>Δεν ανιχνεύτηκαν Περιφερειακές Ενότητες στη βάση</p>";
                    }
                }elseif($_POST["nuts_categories"] == "Δήμοι"){
                    $sql = "SELECT municipality.NUTS as mNUTS, municipality.CodeGR as mCodeGR, municipality.DescriptionGR as mDescriptionGR, municipality.CodeEU as mCodeEU, municipality.DescriptionEU as mDescriptionEU, 
                            placenames.DescriptionGR as pDescriptionGR, placenames.DescriptionEU as pDescriptionEU
                            from municipality, placenames 
                            where  municipality.placenamesID = placenames.placenamesID;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        echo "Αριθμός Δήμων: " . $result->num_rows;
                        echo "<table class='table table-sm table-bordered'>";
                        echo "<thead>
                                <tr>
                                    <th>NUTS 1, 2</th> 
                                    <th>Ελληνικός Κωδικός</th>
                                    <th>Ελληνική Ονομασία</th>
                                    <th>Ευρωπαϊκός Κωδικός</th>
                                    <th>Ευρωπαϊκή Ονομασία</th>
                                    <th>Περιφερειακή Ενότητα Δήμου (GR)</th>
                                    <th>Περιφερειακή Ενότητα Δήμου (EU)</th>
                                </tr>
                                </thead>
                                <tbody id='nuts_table'>";
                        While($row = $result->fetch_assoc()){
                            echo "<tr><td>" . $row["mNUTS"] . "</td><td>" . $row["mCodeGR"] . "</td><td>" . $row["mDescriptionGR"] . "</td><td>" . $row["mCodeEU"] . "</td><td>" . $row["mDescriptionEU"] . "</td><td>" . 
                            $row["pDescriptionGR"] . "</td><td>" . $row["pDescriptionEU"] . "</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "<p>Δεν ανιχνεύτηκαν Δήμοι στη βάση</p>";
                    }
                }elseif($_POST["nuts_categories"] == "Δημοτικές Ενότητες"){
                    $sql = "SELECT village.NUTS as vNUTS, village.CodeGR as vCodeGR, village.DescriptionGR as vDescriptionGR, village.CodeEU as vCodeEU, village.DescriptionEU as vDescriptionEU, 
                            municipality.DescriptionGR as mDescriptionGR, municipality.DescriptionEU as mDescriptionEU
                            from village, municipality where  village.municipalityID = municipality.municipalityID;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        echo "Αριθμός Δημοτικών Ενοτήτων: " . $result->num_rows;
                        echo "<table class='table table-sm table-bordered'>";
                        echo "<thead>
                                <tr>
                                    <th>NUTS 1, 2</th> 
                                    <th>Ελληνικός Κωδικός</th>
                                    <th>Ελληνική Ονομασία</th>
                                    <th>Ευρωπαϊκός Κωδικός</th>
                                    <th>Ευρωπαϊκή Ονομασία</th>
                                    <th>Δήμος (GR)</th>
                                    <th>Δήμος (EU)</th>
                                </tr>
                                </thead>
                                <tbody id='nuts_table'>";
                        While($row = $result->fetch_assoc()){
                            echo "<tr><td>" . $row["vNUTS"] . "</td><td>" . $row["vCodeGR"] . "</td><td>" . $row["vDescriptionGR"] . "</td><td>" . $row["vCodeEU"] . "</td><td>" . $row["vDescriptionEU"] . "</td><td>" . 
                            $row["mDescriptionGR"] . "</td><td>" . $row["mDescriptionEU"] . "</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "<p>Δεν ανιχνεύτηκαν Δημοτικές Ενότητες στη βάση</p>";
                    }
                }elseif($_POST["nuts_categories"] == "Κοινότητες"){
                    $sql = "SELECT area.NUTS as aNUTS, area.CodeGR as aCodeGR, area.DescriptionGR as aDescriptionGR, area.CodeEU as aCodeEU, area.DescriptionEU as aDescriptionEU, 
                            village.DescriptionGR as vDescriptionGR, village.DescriptionEU as vDescriptionEU
                            from area, village where  area.villageID = village.villageID;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        echo "Αριθμός Κοινοτήτων: " . $result->num_rows;
                        echo "<table class='table table-sm table-bordered'>";
                        echo "<thead>
                                <tr>
                                    <th>NUTS 1, 2</th> 
                                    <th>Ελληνικός Κωδικός</th>
                                    <th>Ελληνική Ονομασία</th>
                                    <th>Ευρωπαϊκός Κωδικός</th>
                                    <th>Ευρωπαϊκή Ονομασία</th>
                                    <th>Δημοτική Ενότητα (GR)</th>
                                    <th>Δημοτική Ενότητα (EU)</th>
                                </tr>
                                </thead>
                                <tbody id='nuts_table'>";
                        While($row = $result->fetch_assoc()){
                            echo "<tr><td>" . $row["aNUTS"] . "</td><td>" . $row["aCodeGR"] . "</td><td>" . $row["aDescriptionGR"] . "</td><td>" . $row["aCodeEU"] . "</td><td>" . $row["aDescriptionEU"] . "</td><td>" . 
                            $row["vDescriptionGR"] . "</td><td>" . $row["vDescriptionEU"] . "</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    else{
                        echo "<p>Δεν ανιχνεύτηκαν Κοινότητες στη βάση</p>";
                    }
                }
            }

            $conn->close();
        ?>
    </div>
           
</body>
</html>