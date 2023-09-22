<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Καταγραφή νέας Βιβλιογραφίας</title>
    <style>
        <?php include '../css/navbar.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- Cdn for icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../navbar.php"; ?>


    <h3 id="main_title">Εισαγωγή νέας βιβλιογραφίας</h3>

    <!-- Container that includes the form and success/unsuccessful message of the insertion  -->
    <div class="container">
        <?php
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];

                    if($message == "Inserted Succesfully!")
                    {
            ?>
                        <!-- Green box for successful messages  -->
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo $message;?>
                        </div>
            <?php
                    }
                    else
                    {
            ?>
                        <!-- Red box for unsuccessful messages  -->
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $message; ?>
                        </div>
            <?php
                    }
                    // Clear the session variable so the message won't be displayed again on refresh
                    unset($_SESSION['message']);
                }
            ?>

        <a href="bibliographyMAIN.php" class="btn btn-outline-secondary mb-3 btn-sm"><i class="bi bi-arrow-return-left"></i>Go Back</a>

        <form action="bibliographyINSERT.php" method="POST">
            <!-- row class used for creating horizontal groups of columns within the grid system 
            Row-cols-xl-4 is utility class for 4 div class="col" in the same row (xl ≥1200px)
            row-cols-lg-3 is utility class for 3 div class="col" in the same row (΄lg ≥992px)
            row-cols-md-2   is utility class for 2 div class="col" in the same row (md ≥768px)
            row-cols-1 is utility class for 1 div class="col" in the row (for the rest px)
            g-3 utility class for gap between the cols
            -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3">
                <div class="col">
                    <label for="nameBib">Ονοματεπώνυμο Συγγραφέα</label>
                    <!-- The id is used to be connected with the for="" in <label>  -->
                    <input type="text" maxlength="255" class="form-control" id="nameBib" name="nameBib" placeholder="Όνομα - Επώνυμο" >
                </div>

                <div class="col">
                    <label for="title">Τίτλος</label>
                    <input type="text" maxlength="255" class="form-control" id="title" name="title" placeholder="Τίτλος" required>
                </div>

                <div class="col">
                    <label for="subtitle">Υπότιτλος</label>
                    <input type="text" maxlength="255" class="form-control" id="subtitle" name="subtitle" placeholder="Υπότιτλος" >
                </div>

                <div class="col">
                    <label for="editors">Εκδόσεις</label>
                    <input type="text" maxlength="255" class="form-control" id="editors" name="editors" placeholder="Εκδόσεις" >
                </div>

                <div class="col">
                    <label for="editorsPlace">Τόπος Έκδοσης</label>
                    <input type="text" maxlength="255" class="form-control" id="editorsPlace" name="editorsPlace" placeholder="Τόπος Έκδοσης" >
                </div>

                <div class="col">
                    <label for="editionNumber">Αριθμός Έκδοσης</label>
                    <input type="number" class="form-control" id="editionNumber" name="editionNumber" placeholder="Αριθμός Έκδοσης" >
                </div>

                <div class="col">
                    <label for="editionYear">Έτος Έκδοσης</label>
                    <input type="number" class="form-control" id="editionYear" name="editionYear" placeholder="Έτος" >
                </div>

                <div class="col">
                    <label for="chapterTitle">Τίτλος Κεφαλαίου</label>
                    <input type="text" maxlength="255" class="form-control" id="chapterTitle" name="chapterTitle" placeholder="Τίτλος Κεφαλαίου" >
                </div>

                <div class="col">
                    <label for="anouncementTitle">Τίτλος Εισήγησης</label>
                    <input type="text" maxlength="255" class="form-control" id="anouncementTitle" name="anouncementTitle" placeholder="Τίτλος Εισήγησης" >
                </div>

                <div class="col">
                    <label for="paperTitle">Τίτλος Άρθρου</label>
                    <input type="text" maxlength="255" class="form-control" id="paperTitle" name="paperTitle" placeholder="Τίτλος Άρθρου" >
                </div>

                <div class="col">
                    <label for="journalTitle">Τίτλος Περιοδικού</label>
                    <input type="text" maxlength="255" class="form-control" name="journalTitle" id="journalTitle" placeholder="Τίτλος Περιοδικού" >
                </div>

                <div class="col">
                    <label for="newspaperTitle">Τίτλος Εφημερίδας</label>
                    <input type="text" maxlength="255" class="form-control" name="newspaperTitle" id="newspaperTitle" placeholder="Τίτλος Εφημερίδας" >
                </div>

                <div class="col">
                    <label for="volNumber">Αριθμός Τόμου</label>
                    <input type="text" maxlength="10" class="form-control" name="volNumber" id="volNumber" placeholder="Αριθμός Τόμου" >
                </div>

                <div class="col">
                    <label for="issueNumber">Αριθμός Τεύχους</label>
                    <input type="text" maxlength="10" class="form-control" name="issueNumber" id="issueNumber" palceholder="Αριθμός Τεύχους" >
                </div>

                <div class="col">
                    <label for="monthYearIssue">Μήνας και χρόνος κυκλοφορίας</label>
                    <input type="text" maxlength="255" class="form-control" name="monthYearIssue" id="monthYearIssue" palceholder="Μήνας-Χρόνος κυκλοφορίας" >
                </div>

                <div class="col">
                    <label for="dateIssue">Ημερομηνία και έτος κυκλοφορίας</label>
                    <input type="text" maxlength="255" class="form-control" name="dateIssue" id="dateIssue" placeholder="Ημερομηνία και Έτος" >
                </div>

                <div class="col">
                    <label for="editionPeriod">Περίοδος Έκδοσης</label>
                    <input type="text" maxlength="255" class="form-control" name="editionPeriod" id="editionPeriod" placeholder="Περίοδος Έκδοσης" >
                </div>

                <div class="col">
                    <label for="chapterSize">Έκταση Κεφαλαίου</label>
                    <input type="text" maxlength="255" class="form-control" name="chapterSize" id="chapterSize" placeholder="Έκταση Κεφαλαίου" >
                </div>

                <div class="col">
                    <label for="anouncementSize">Έκταση Εισήγησης</label>
                    <input type="text" maxlength="255" class="form-control" name="anouncementSize" id="anouncementSize" placeholder="Έκταση Εισήγησης" >
                </div>

                <div class="col">
                    <label for="articleSize">Έκταση Άρθρου</label>
                    <input type="text" maxlength="10" class="form-control" name="articleSize" id="articleSize" placeholder="Έκταση Άρθρου" >
                </div>

                <div class="col">
                    <label for="collectiveBody">Συλλογικό Όργανο</label>
                    <input type="number" class="form-control" name="collectiveBody" id="collectiveBody" placeholder="Συλλογικό Όργανο" >
                </div>

                <div class="col">
                    <label for="conferenceProcTitle">Τίτλος πρακτικών συνεδρίου</label>
                    <input type="text" maxlength="255" class="form-control" name="conferenceProcTitle" id="conferenceProcTitle" placeholder="Τίτλος πρακτικών συνεδρίου" >
                </div>

                <div class="col">
                    <label for="editorName">Ονοματεπώνυμο Επιμελητή</label>
                    <input type="text" maxlength="255" class="form-control" name="editorName" id="editorName" placeholder="Όνομα-Επώνυμο" >
                </div>

                <div class="col">
                    <label for="introductionName">Όνομα Εισαγωγής</label>
                    <input type="text" maxlength="255" class="form-control" name="introductionName" id="introductionName" placeholder="Όνομα Εισαγωγής" >
                </div>

                <div class="col">
                    <label for="prologueName">Όνομα Προλόγου</label>
                    <input type="text" maxlength="255" class="form-control" name="prologueName" id="prologueName" placeholder="Όνομα Προλόγου" >
                </div>

                <div class="col">
                    <label for="translatorName">Όνομα Μεταφραστή</label>
                    <input type="text" maxlength="255" class="form-control" name="translatorName" id="translatorName"  placeholder="Όνομα Μεταφραστή" >
                </div>
                
                <div class="col">
                    <label for="availableURL">Διάθεση URL</label>
                    <input type="text" maxlength="255" class="form-control" name="availableURL" id="availableURL" placeholder="URL" >
                </div>

                <div class="col">
                    <label for="accessDate">Ημερομηνία Πρόσβασης</label>
                    <input type="date" class="form-control" name="accessDate" id="accessDate" placeholder="YYYY-MM-DD" >
                </div>

                <div class="col">
                    <label for="website">Διαδικτυακός Τόπος</label>
                    <input type="text" maxlength="255" class="form-control" name="website" id="website" placeholder="Διαδικτυακός Τόπος" >
                </div>

                <div class="col">
                    <label for="webpage">Ιστοσελίδα</label>
                    <input type="text" maxlength="255" class="form-control" name="webpage" id="webpage" placeholder="Ιστοσελίδα" >
                </div>

                <div class="col">
                    <label for="phdTitle">Όνομα Διδακτορικής Διατριβής</label>
                    <input type="text" maxlength="255" class="form-control" name="phdTitle" id="phdTitle" placeholder="Όνομα Διδακτορικής Διατριβής" >
                </div>

                <div class="col">
                    <label for="institutionUniversity">Όνομα Ιδρύματος–Πανεπιστήμιο</label>
                    <input type="text" maxlength="255" class="form-control" name="institutionUniversity" id="institutionUniversity" placeholder="Όνομα Ιδρύματος–Πανεπιστήμιο" >
                </div>

                <div class="col">
                    <label for="nonPublishedDissertation">Μη εκδοθείσα Διδακτορική Διατριβή</label>
                    <input type="text" maxlength="255" class="form-control" name="nonPublishedDissertation" id="nonPublishedDissertation" placeholder="Μη εκδοθείσα Διδακτορική Διατριβή" >
                </div>

                <div class="col">
                    <label for="filmTitle">Τίτλος Ταινίας</label>
                    <input type="text" maxlength="255" class="form-control" name="filmTitle" id="filmTitle" placeholder="Τίτλος Ταινίας" >
                </div>

                <div class="col">
                    <label for="directorName">Όνομα Σκηνοθέτη</label>
                    <input type="text" maxlength="255" class="form-control" name="directorName" id="directorName" placeholder="Όνομα Σκηνοθέτη" >
                </div>

                <div class="col">
                    <label for="materialType">Τύπος Υλικού</label>
                    <input type="text" maxlength="255" class="form-control" name="materialType" id="materialType" placeholder="Τύπος Υλικού" >
                </div>

                <div class="col">
                    <label for="distribution">Έτος Διανομής</label>
                    <input type="text" maxlength="255" class="form-control" name="distribution" id="distribution" placeholder="Έτος Διανομής" >
                </div>

                <div class="col">
                    <label for="productionPlace">Τόπος Παραγωγής</label>
                    <input type="text" maxlength="255" class="form-control" name="productionPlace" id="productionPlace" placeholder="Περιγραφή τόπου παραγωγής" >
                </div>

                <div class="col">
                    <label for="productionCompany">Εταιρεία Παραγωγής</label>
                    <input type="text" maxlength="255" class="form-control" name="productionCompany" id="productionCompany" placeholder="Όνομα Εταιρείας" >
                </div>

                <div class="col">
                    <label for="remarks">Παρατηρήσεις</label>
                    <input type="text" class="form-control" name="remarks" id="remarks" placeholdeer="Παρατηρήσεις" >
                </div>

            </div>     
            
            <!-- Create a div with text-center to center the button and mt-2 mb-2 for margin  top and bottom -->
            <div class="text-center mt-2 mb-2">
                <button type="submit" name="submit_bibliography" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

