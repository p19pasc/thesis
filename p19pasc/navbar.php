<!-- Navigation bar that expands when the window is >= 1200px (specifically when the tabs does not fit in the same line). For <1200px a toggle button appears-->
<nav class="navbar navbar-expand-xl">
  <!-- Container leaves spaces left-right and make nav bar more good looking -->
  <div class="container"> 
    <a class="navbar-brand" href="/p19pasc/index.php"><img src="/p19pasc/excavo_140x63.png" alt="excavo"></a>
    <!-- Toggle button <<Menu>> -->
    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav" class="navbar-toggler" aria-controls="collapseNav" aria-expanded="false" aria-label="Toggle navigation"><span>MENU<span></button> 
    <!-- The tabs of nav bar that collapse when window <1200px -->
    <div class="collapse navbar-collapse" id="collapseNav"> 
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/interview/interviewMAIN.php">Συνεντεύξεις</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/bibliography/bibliographyMAIN.php">Βιβλιογραφία</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/treasures/treasures.php">Θησαυροί</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/archiveData/archiveDataMAIN.php">Αρχειακό Υλικό</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/artifacts/artifactsMAIN.php">Τέχνεργα</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/inscription/inscriptionMAIN.php">Επιγραφές</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/p19pasc/ecofact/ecofactMAIN.php">Περιβαλλοντικά Δεδομένα</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    