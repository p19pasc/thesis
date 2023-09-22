<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Treasures</title>
        <style>
            <?php include '../css/navbar.css'; ?>
            <?php include '../css/treasures/treasure.css'; ?>    
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <?php include "../navbar.php"; ?>

        <h3 id="main_title">Θησαυροί</h3>
        
        <!-- Container that contains the treasures of the database-->
        <div class="container">
            <!-- row sets the col elements  in the same row.
                 row-cols sets the number of col elements in each row based on the given window size(sm,md,..) and the number of col we want  
                 Example: row-cols-lg-3 for screen >=992px and <1200px we will have 3 columns each row
                 g-3 is for the white space between each column -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4  g-3"> 
                <div class="col">
                    <!-- p-3: is padding-top,bottom,right,left. Gives space between col element and <a>.
                         text-center: center the text inside the div element
                         text-truncate: put dots at the end of the text when it does not fit in the box -->
                    <a id="treasure_choice" href="nuts.php"><div class="p-3 text-center border bg-light text-truncate">NUTS Ένδειξη ΕΛΣΤΑΤ</div></a> 
                </div>
                <div class="col">
                    <a id="treasure_choice" href="siteKind.php"><div class="p-3 text-center border bg-light text-truncate">Κατηγορία Θέσης Αρχαιολογικών Καταλοίπων</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="ecofactmethods.php"><div class="p-3 text-center border bg-light text-truncate">Μέθοδοι επεξεργασίας περιβαλλοντικών δεδομένων</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="storageplace.php"><div class="p-3 text-center border bg-light text-truncate">Χώροι Αποθήκευσης Τεχνουργημάτων</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="material.php"><div class="p-3 text-center border bg-light text-truncate">Υλικά Τεχνουργημάτων</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="keywords.php"><div class="p-3 text-center border bg-light text-truncate">Λέξεις Κλειδιά</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="archivesources.php"><div class="p-3 text-center border bg-light text-truncate">Αρχειακές Πηγές</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="documentcategory.php"><div class="p-3 text-center border bg-light text-truncate">Κατηγορίες εγγράφων</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="informationcategory.php"><div class="p-3 text-center border bg-light text-truncate">Κατηγορίες Πληροφορίας</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="interviewtype.php"><div class="p-3 text-center border bg-light text-truncate">Είδος Συνέντευξης</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="recordingmediumtype.php"><div class="p-3 text-center border bg-light text-truncate">Μέσο Καταγραφής</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="maritalstatus.php"><div class="p-3 text-center border bg-light text-truncate">Οικογενειακή Κατάσταση</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="educationallevel.php"><div class="p-3 text-center border bg-light text-truncate">Επίπεδο Εκπαίδευσης</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="literarysourcetype.php"><div class="p-3 text-center border bg-light text-truncate">Είδη Λογοτεχνικών Πηγών</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="journal.php"><div class="p-3 text-center border bg-light text-truncate">Ονόματα Περιοδικών</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="conference.php"  ><div class="p-3 text-center border bg-light text-truncate">Συνέδρια</div></a>
                </div>
                <div class="col">
                    <a id="treasure_choice" href="author.php"><div class="p-3 text-center border bg-light text-truncate">Συγγραφείς</div></a>
                </div>
            </div>
        </div>
    </body>
</html>
