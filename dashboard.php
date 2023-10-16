<?php
//include auth_session.php file on all user panel pages

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="add.js"></script>
    <title>DASHBOARD</title>
</head>
<body>
    <?php 
    include("auth_session.php");
    include("database.php");
    $user = $_SESSION['username']; 
    $query = "SELECT * FROM coviddb.hospital WHERE Hospital_ID = $user";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $row = $result->fetch_assoc();
?>
    <div class="topContainer">
        <div class="option">
            <a class="active" href="#login"> DASHBOARD </a>
            <a href="logout.php"> LOGOUT </a>
            <a href="logout.php"> HOME </a>
        </div>
    </div>
    
    <div class="hospDetails">
        <h2>HOSPITAL ID: <?php echo $_SESSION['username']; ?></h2>
        <h1><?php echo $row['Name']; ?></h1>
        <h3>Zone: <?php echo $row['Zone']?></h3>
    </div>
    <?php 
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
    <div class="updTable">
    <form  name="dash" action="dashboard.php" method="post" >
        <table>
            <tr>
                <td colspan="3" class="upd" >UPDATES</td>
            </tr>
            <tr>
                <th>BEDS</th>
                <th>
                <?php
                    $x = '0'; 
                    if($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $x = $row1['units'];
                    }
                    ?>
                    <form class="add" >
                        <!-- <div class="value-button" id="number" onclick="decreaseValue()" value="Decrease Value">-</div> -->
                        <input type="number" id="number" value="<?php echo $x ?>" name="bds" />
                        <!-- <div class="value-button" id="number" onclick="increaseValue()" value="Increase Value">+</div> -->
                    </form>
                </th>
            </tr>
            <tr>
                <th>PLASMA</th>
                <th>
                    <?php
                    $x = '0'; 
                    if($result3->num_rows > 0) {
                        $row3 = $result3->fetch_assoc();
                        $x = $row3['units'];
                    }
                    ?>
                    <form class="add" >
                        <!-- <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div> -->
                        <input type="number" id="number" value="<?php echo $x ?>" name="plsm" />
                        <!-- <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div> -->
                    </form>
                </th>
            </tr>
            <tr>
                <th>OXYGEN CYLINDER </th>
                <th>
                <?php
                    $x = '0'; 
                    if($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $x = $row2['units'];
                    }
                    ?>
                    <form class="add" >
                        <!-- <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div> -->
                        <input type="number" id="number" value="<?php echo $x ?>" name="oxy" />
                        <!-- <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div> -->
                    </form>
                </th>
            </tr>
            <tr>
            
                <td colspan="3" class="submit" ><button class="submit" type="submit" name="submithosp" >ADD</button></td>
            </tr>
        </table>
                </form>
    </div>

    <?php
    $x = 'Hospital Name';
    if(isset($_POST['submithosp']))
    {
      $x = $_REQUEST[`oxy`];
        echo $x;
    }
    
    ?>
    <div class="drDet">
        <h1>ACTIVE DOCTORS</h1>
    </div>
    <?php 
    $query = "SELECT * 
    FROM hospital as Y JOIN doctor as X
    WHERE X.Hospital_ID = Y.Hospital_ID 
    AND X.Hospital_ID = $user";
    $result = mysqli_query($con, $query) or die(mysql_error());
    ?>
    <div class="drContainer">
        <table>
            <td colspan="1" class="headDrId" >ID</td>
            <td colspan="1" class="headDrName" >NAME</td>
            
            <?php
            while ($row = $result->fetch_assoc()) {
                        $field1name = $row["Doctor_ID"];
                        $field2name = $row["Name"];
                
                        echo '<tr> 
                                  <td>'.$field1name.'</td> 
                                  <td>'.$field2name.'</td> 
                              </tr>';
                    }
                    $result->free();
            ?>
        </table>
    </div>

    <div class="dnrDet">
        <h1>DONOR'S DETAILS</h1>
    </div>
    <?php 
    $query = "SELECT *
    FROM donation NATURAL JOIN donor
    WHERE Hospital_ID = $user;";
    $result = mysqli_query($con, $query) or die(mysql_error());
    ?>
    <div class="dnrContainer">
        <table>
            <td colspan="1" class="headTransId" >Trans ID</td>
            <td colspan="1" class="headDnrId" >Donor ID</td>
            <td colspan="1" class="headDnrName" >NAME</td>
            <?php
            while ($row = $result->fetch_assoc()) {
                        $field1name = $row["Donor_ID"];
                        $field2name = $row["Name"];
                        $field3name = $row["Transaction_ID"];
                
                        echo '<tr> 
                                  <td>'.$field1name.'</td> 
                                  <td>'.$field2name.'</td> 
                                  <td>'.$field3name.'</td> 
                              </tr>';
                    }
                    $result->free();
            ?>
           
        </table>
    </div>
    <!-- <div class="form">
        <p>You are now user dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
    </div> -->
</body>
</html>