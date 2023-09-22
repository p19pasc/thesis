<?php
    include "../connDB.php";

    // Get the id of the user's choice from ecofactMAIN.php
    $ecofactID = $_GET["ecofactID"];

    $sql = "SELECT ecofact.description as ecofactDesc, ecofactType, dataType, appliedMethodDate, hyperlink, 
            ecofactMethods.description as ecofactMethodsDesc, sites.description as sitesDesc 
            FROM ecofact
            JOIN ecofactMethods ON ecofact.ecofactMethodID = ecofactMethods.ecofactMethodID
            JOIN sites ON ecofact.siteID = sites.siteID
            WHERE ecofact.ecofactID = $ecofactID";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Περιβαλλοντικά Δεδομένα</title>
    <style>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/MAIN_SHOW/SHOW.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons, bi class -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>

    <h3 id="main_title">Κλιματικό/Περιβαλλοντικό Δεδομένο No:<?php echo " " . $ecofactID?></h3>

    <div class="container">
        <a href="ecofactMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>

        <?php
            //If the sql query returns atleast 1 row 
            if ($result->num_rows > 0){
                // Check that the result is stored correctly in $row
                if($row = $result->fetch_assoc()){ 
        ?>
                    <!-- Depends on the size of the screen row-cols adjust the number of the cols for each row -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 text-center g-4">
                            <div class="col">
                                <h5>Τόπος Ανασκαφής</h5>
                                <p><?php echo $row['sitesDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Περιγραφή</h5>
                                <p><?php echo $row['ecofactDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Κατηγορία</h5>
                                <p>
                                    <?php 
                                        if($row['ecofactType'] == 1){
                                            echo "Γεωλογικό/Γεωμορφολογικό Δεδομένο";
                                        }else{
                                            echo "Οικοδεδομένο";
                                        }   
                                    ?>
                                </p>
                            </div>
                            <div class="col">
                                <h5>Μέθοδος</h5>
                                <p><?php echo $row['ecofactMethodsDesc']?></p>
                            </div>
                            <div class="col">
                                <h5>Ημερομηνία εφαρμογής της μεθόδου</h5>
                                <p><?php echo $row['appliedMethodDate']?></p>
                            </div>
                            <div class="col">
                                <h5>Μορφή Αρχείου </h5>
                                <p>
                                    <?php
                                        if($row['dataType'] == 1)
                                        {
                                            echo 'Json';
                                        }else{
                                            echo 'XML';
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="col">
                                <h5>Υπερσύνδεσμος</h5>
                                <p><a href="<?php echo $row['hyperlink'] ?>"><?php echo $row['hyperlink'] ?></a></p>
                            </div>

                    </div>

        <?php 
                }
            // In case the user change the ID on the url
            }else{
                echo "Ecofact No:" . $ecofactID . " does not exist";
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".btn").click(function(event) {
            history.back();
        });
    </script>
</body>
</html>