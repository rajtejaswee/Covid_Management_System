<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="topContainer">
        <div class="option">
            <a class="active" href=""> HOME </a>
            <a href="amneties.php"> AMNETIES </a>
            <a href="#login"> HOSPITAL LOGIN </a>
            <a href="register.php"> REGISTER </a>

            <a href="about.php"> ABOUT </a>
        </div>
    </div>

    <div class="onoffswitch3">
        <input type="checkbox" name="onoffswitch3" class="onoffswitch3-checkbox" id="myonoffswitch3" checked>
        <label class="onoffswitch3-label" for="myonoffswitch3">
            <span class="onoffswitch3-inner">
                <span class="onoffswitch3-active">
                    <marquee class="scroll-text">Covid 19 in India News LIVE: India reports 1,247 new Covid cases and 1 death in last 24 hours, active caseload rises to 11,860. 
                        <span class="glyphicon glyphicon-forward"></span> India has reported 1,247 new Covid cases and 1 death in last 24 hours, the Union health ministry said on Tuesday. 
                        <span class="glyphicon glyphicon-forward"></span>  Covid-19: Centre extends insurance scheme for health workers for another 180 days.</marquee>
                    <span class="onoffswitch3-switch">ALERT..  </span>
                </span>
                <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">SHOW BREAKING NEWS</span></span>
            </span>
        </label>
    </div>

    <div>
        <h1 class="stats" >COVID STATISTICS</h1>
    </div>

    <div class="containerFirst">
        
        <div class="covidGraph">
            <select class="typesOfCases" name="typesOfCases"required>
                <option value="">New Cases</option> 
                <option value="">Death</option>
            </select>

            <select class="country" name="country"required>
                <option value="">Asia</option> 
                <option value="">Australia</option>
                <option value="">America</option>
                <option value="">Africa</option>
                <option value="">Australia</option>
            </select>
            
            <select class="regions" name="regions"required>
                <option value="">All regions</option> 
                <option value="">Andhra Pradesh</option> 
                <option value="">Bihar</option>
                <option value="">Delhi</option>
                <option value="">UP</option>
                <option value="">Gujarat</option>
            </select>
            <button class="optSubmit" type="submit">SUBMIT</button>
            <img src="graph.png" alt="" class="graph">
        </div>
        <div class="covidImg">
            <img src="covid.png" alt="" class="covid">
        </div>
    </div>

    <div class="loginContainer">
        
      <div class="loginImg">
        <img src="hospLogin.svg" alt="">
      </div>
      
      <?php
    require('database.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            header("Location: index.php");
                }
            } else {
?>
    <div class="login" id = "login"> 
      <form class="form" method="post" name="login">
        <div class="lContainer">
          <input type="text" class="left" name="username" placeholder="HOSPITAL ID" autofocus="true" required/>
          <input type="password" name="password" placeholder="PASSWORD" required/>
          <button class="lButton" type="submit">Login</button>
          <!-- <p class="link"><a href="register.php">New Registration</a></p> -->
        </div>
      </form>

            </div>
    </div>

<?php
    }
    ?>
</body>
</html>
<!--
session_start();
require("database.php");

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$query = "SELECT * FROM hospital";
$result = $con->query($query);

// echo "
// <table>
//       <thead>
//         <tr>
//           <th>Hospital_ID</th>
//           <th>Name</th>
//           <th>PhoneNo</th>
//           <th>Zone</th>
//         </tr>
//       </thead>
//     </table>
//     <table>
//     <tbody>
// ";
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $field1name = $row["Hospital_ID"];
//         $field2name = $row["Name"];
//         $field3name = $row["PhoneNo"];
//         $field4name = $row["Zone"];

//         echo '<tr> 
//                   <td>'.$field1name.'</td> 
//                   <td>'.$field2name.'</td> 
//                   <td>'.$field3name.'</td> 
//                   <td>'.$field4name.'</td> 
//               </tr>';
//     }
//     $result->free();
// } else {
//     echo "0 Results";
// }
// $con->close();

// ?>



