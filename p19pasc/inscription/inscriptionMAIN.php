<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επιγραφές</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Επιγραφές</h3>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">
            <?php
                $sql = "SELECT inscriptionID, title, image, inscriptionKind.description as inscriptionKindDesc 
                        FROM inscription
                        JOIN gallery ON inscription.galleryID = gallery.galleryID
                        JOIN inscriptionKind ON inscription.kindOfInscription = inscriptionKind.kindOfInscriptionID";
                $result = $conn->query($sql);
                // Check if at least 1 row returned from database, in order to create cards
                if($result->num_rows>0){
                    // Each time we have a row create a bootstrap card 
                    While($row = $result->fetch_assoc()){
            ?>
            <div class="col">
                <!-- Bootstrab card contains an image of the inscription, the title and the inscription kind -->
                <div class="card">
                    <!-- Retrieve the image that is blob type in database -->
                    <img class="card-img-top"  height="200" src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>"/>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']?></h5>
                        <p class="card-text"><?php echo $row['inscriptionKindDesc']?></p>
                        <!-- stretched-link class, makes the whole card clickable -->
                        <a href="inscriptionSHOW.php?inscriptionID=<?php echo $row['inscriptionID']; ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</body> 
</html>