<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Τέχνεργα</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>
    <?php include "../connDB.php";?>

    <h3 id="main_title">Τέχνεργα</h3>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
            <!-- Create cards to display the options that the user has about the artifacts.
                 Each card is inside col class in order to adjust it with row-cols class. -->
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Αναζήτηση με βάση τον τόπο ανασκαφής</h5>
                        <p class="card-text">Δείτε όλα τα τέχνεργα που βρέθηκαν στον τόπο ανασκαφής που θα επιλέξετε.</p>
                        <a href="artifactsSites.php" class="link-primary link-offset-1 link-underline-opacity-50 link-underline-opacity-100-hover">Εδώ</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Αναζήτηση με βάση τις περιόδους ENG</h5>
                        <p class="card-text">Αναζητήστε τα τέχνεργα με βάση την περίοδο στην οποία ανήκουν ENG</p>
                        <a href="artifactsENG.php" class="link-primary link-offset-1 link-underline-opacity-50 link-underline-opacity-100-hover">Εδώ</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Αναζήτηση με βάση τις περιόδου GR</h5>
                        <p class="card-text">Αναζητήστε τα τέχνεργα με βάση την περίοδο στην οποία ανήκουν GR</p>
                        <a href="artifactsGR.php" class="link-primary link-offset-1 link-underline-opacity-50 link-underline-opacity-100-hover">Εδώ</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Όλα τα τέχνεργα</h5>
                        <p class="card-text">Παρουσίαση όλων των τέχνεργων</p>
                        <a href="artifactsALL.php" class="link-primary link-offset-1 link-underline-opacity-50 link-underline-opacity-100-hover">Εδώ</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Προσθήκη Τέχνεργου</h5>
                        <p class="card-text">Προσθέστε ένα νέο τέχνεργο στη συλλογή</p>
                        <a href="artifactsSUBMIT.php" class="link-primary link-offset-1 link-underline-opacity-50 link-underline-opacity-100-hover">Εδώ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
