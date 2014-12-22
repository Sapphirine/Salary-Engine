<?php
define('TITLE', 'Register');
include('header.php');
?>

<html>
<head>
<title>Rigerster now so that you could take certain functions!</title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" href=http://www.freshdesignweb.com/wp-content/themes/fv28/images/icon.ico />
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="fdw-demo.css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
   
</head>
<body>
 <div class="container">

    <?php
        $problem = TRUE;
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $problem = FALSE;
        }
        if (!$problem) {
            ini_set('display_errors','On');
            $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
            $dbname = "twitt";
            $conn = mysql_connect($db, "XX", "XX", $dbname);
            $email = $_POST['email'];
            $password = $_POST['password'];
            $location = $_POST['location'];
            $categoty = $_POST['categoty'];
            $salary = $_POST['salary'];
            $tele = $_POST['phone'];
            $type = $_POST['type'];
            $query = "insert into Users(Username, Password, Location, Category, Salary, Tele, Type) VALUES ('$email','$password','$location','$categoty','$salary', '$tele', '$type')";
            mysql_db_query($dbname, $query, $conn);
            print '<p>You have successfully create your account!<p>';
        }
    ?>

      <div class="freshdesignweb-top"><h1>Rigerster now so that you could take certain functions!</h1></div><div class="clr"></div>  
      <div  class="form" >
            <form id="contactform" action="register.php" method="post"> 
                <p class="contact"><label for="email">Email</label></p> 
                <input id="email" name="email" placeholder="example@domain.com" required="" tabindex="1" type="email"> 
                 
                <p class="contact"><label for="password">Create a password</label></p> 
                <input type="password" id="password" name="password" required="" tabindex="2"> 

                <p class="contact"><label for="repassword">Confirm your password</label></p> 
                <input type="password" id="repassword" name="repassword" required="" tabindex="3"> 
        
                <p class="contact"><label for="location">Your location</label></p> 
                <input id="location" name="location" placeholder="location" required="" tabindex="4" type="text"> 

                <p class="contact"><label for="salary">Your minimul salary</label></p> 
                <input id="salary" name="salary" placeholder="salary" required="" tabindex="5" type="text"> 

                <p class="contact"><label for="categoty">What kinds of fields you interst</label></p> 
                <input id="categoty" name="categoty" placeholder="categoty" required="" tabindex="6" type="text"> 
  
            <select class="select-style type" name="type">
            <option value="select">i am..</option>
            <option value="U">A User</option>
            <option value="R">Company Recruiter</option>
            </select><br><br>
            
            <p class="contact"><label for="phone">Mobile phone</label></p> 
            <input id="phone" name="phone" placeholder="phone number" required="" type="text"> <br>
            <input class="buttom" name="submit" id="submit" tabindex="7" value="Sign me up!" type="submit">      
   </form> 
  </div>       
</div>
            <!-- freshdesignweb top bar -->
            <div class="freshdesignweb-buttom">
                <div class="clr"></div>
            </div><!--/ freshdesignweb top bar -->
</body>
</html>


    <hr>
<?php include('footer.php'); ?>