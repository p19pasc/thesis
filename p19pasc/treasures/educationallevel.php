<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επίπεδο Εκπαίδευσης</title>
    <style>
        <?php 
        include '../css/navbar.css';
        include '../css/treasures/treasures.css'; 
        include '../css/treasures/treasures_tb2.css';
        ?>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <?php include "../connDB.php";?>
    <?php include "../navbar.php"; ?>
  
    <h3 id="main_title">Επίπεδο Εκπαίδευσης</h3>

    <!-- Responsive container for the display of the data from educationallevel mysql table with table structure -->
    <div class="container col-9 col-sm-6 col-md-5 col-lg-4 col-xl-3 text-center">

        <!-- Table structure for to display the data from the database -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Περιγραφή</th>
                </tr>                
            </thead>
            <?php 
                $table_name = 'educationallevel';
                $id_name = "educationalLevelID";
                $description_name =  "description";

                $sql = "SELECT * from $table_name order by $id_name ASC";
                $result = $conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row = $result->fetch_assoc())
                    { 
            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row[$description_name]?></td>
                        </tr>
                    </tbody>
            <?php   }
                }
                $conn->close();
            ?>
        </table>
    </div>
</body>
</html>