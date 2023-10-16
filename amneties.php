<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>AMNETIES</title>
</head>
<body>
    <div class="topContainer">
        <div class="option">
            <a href="index.php"> HOME </a>
            <a class="active" href="amneties.php"> AMNETIES </a>
            <a href="index.php#login"> HOSPITAL LOGIN </a>
            <a href="about.php"> ABOUT </a>
        </div>
    </div>
    <div class="covidGraph" >
    <form  name="Hospitals" action="amneties.php" method="post" >
        <select class="Hospitals" name = "Hospitals" >

            <option value="">Enter Hospital</option> 
            <option value="Geeta Hospital">Geeta Hospital</option>
            <option value="Savitri Bai Hospital">Savitri Bai Hospital</option>
            <option value="Ganga Hospital">Ganga Hospital</option>
            <option value="St. Xaviers">St. Xaviers</option>
            <option value="KGMU">KGMU</option>
            <option value="BHU">BHU</option>
            <option value="AMU">AMU</option>
            <option value="City Hospital">City Hospital</option>
            <option value="GuruDham Cares">GuruDham Cares</option>
             <option value="Fatima Nursing">Fatima Nursing</option>
        </select>
        <button class="optSubmit" type="submit" name="submithosp" >SUBMIT</button>
        
    </form>
</div>
<?php
$x = 'Hospital Name';
if(isset($_POST['submithosp']))
{
  $x = $_POST['Hospitals'];
  
}
?>

<div>
    <h1 class="hospName"><?php echo $x ?></h1>
</div>

<?php
session_start();
require("database.php");
$user = "0003";


$query1 = "SELECT * FROM amneties
WHERE Hospital_ID = $user AND Item = 'Beds'";
$query2 = "SELECT * FROM amneties
WHERE Hospital_ID = $user AND Item = 'Oxygen'"; 
$query3 = "SELECT * FROM amneties
WHERE Hospital_ID = $user AND Item = 'Plasma'";

$result1 = mysqli_query($con, $query1) or die(mysql_error());

$result2 = mysqli_query($con, $query2) or die(mysql_error());

$result3 = mysqli_query($con, $query3) or die(mysql_error());

?>
    
    <div class="containerSecond">
        <div class="amGrap">
            <img src="amenities.png" alt="" class="amImg" >
        </div>
        <div class="amTable">
            <table class="amenitiesTable">
                <tr class="digitsAm" >
                <?php
                    $x = '0'; 
                    if($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $x = $row1['units'];
                    }
                ?>
                <th><?php echo $x ?></th>
                <?php
                    $x = '0'; 
                    if($result3->num_rows > 0) {
                        $row3 = $result3->fetch_assoc();
                        $x = $row3['units'];
                    }
                ?>
                <th><?php echo $x ?></th>
                <?php
                    $x = '0'; 
                    if($result3->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $x = $row2['units'];
                    }
                ?>
                <th><?php echo $x ?></th>
            </tr>
            <tr class="typeAm" >
                <th>BEDS</th>
                <th>PLASMA</th>
                <th>OXYGEN</th>
            </tr>
            <!-- <tr>
                <td colspan="3" class="donate" >+ DONATE +</td> -->
            <!-- </tr> -->
            </table>
        </div>
    </div>
    <?php 
    $query1 = "SELECT COUNT(States) FROM patients as X JOIN statusreport as Y
    WHERE X.Patient_ID = Y.Patient_ID AND Y.States = 'Active' AND X.Hospital_ID = $user";
    $query2 = "SELECT COUNT(States) FROM patients as X JOIN statusreport as Y
    WHERE X.Patient_ID = Y.Patient_ID AND Y.States = 'Deceased' AND X.Hospital_ID = $user"; 
    $query3 = "SELECT COUNT(States) FROM patients as X JOIN statusreport as Y
    WHERE X.Patient_ID = Y.Patient_ID AND Y.States = 'Discharged' AND X.Hospital_ID = $user";

    $result1 = mysqli_query($con, $query1) or die(mysql_error());

    $result2 = mysqli_query($con, $query2) or die(mysql_error());

    $result3 = mysqli_query($con, $query3) or die(mysql_error());

    ?>
    <div class="containerThird">
        <div class="reTable">
            <table class="reportTable">
                <tr class="digitsRe" >
                <?php
                    $x = '0'; 
                    if($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $x = $row2["COUNT(States)"];
                    }
                    ?>
                    <th><?php echo $x ?></th>
                    <?php
                    $x = '0'; 
                    if($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $x = $row1["COUNT(States)"];
                    }
                    ?>
                    <th><?php echo $x ?></th>
                    <?php
                    $x = '0'; 
                    if($result3->num_rows > 0) {
                        $row3 = $result3->fetch_assoc();
                        $x = $row3["COUNT(States)"];
                    }
                    ?>
                    <th><?php echo $x ?></th>
                </tr>
                <tr class="typeRe" >
                    <th>DEATH</th>
                    <th>ACTIVE</th>
                    <th>RECOVER</th>
                </tr>
            </table>
        </div>
        <div class="reGrap">
            <img src="report.png" alt="" class="reImg" >
        </div>
    </div>

</body>
</html>