<?php
    include('header.php');
?>

<head>

    <!-- Basics -->
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title>Login</title>

    <!-- CSS -->
    
  <link rel="stylesheet" href="login1.css">  
    <link rel="stylesheet" href="login2.css">  
  <link rel="stylesheet" href="login3.css">  
    
</head>

    <!-- Main HTML -->
    
    <!-- Begin Page Content -->
<?php ob_start(); ?>

    <div id="container">
            <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {
        ini_set('display_errors','On');
        $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
        $dbname = "twitt";
        $inputname = $_POST['username'];
        $conn = mysql_connect($db, "XX", "XX", $dbname);
        $query = "select UserId, Username, Password, Type from Users where Username='$inputname'";
        $r = mysql_db_query($dbname, $query, $conn);
        $judge=0;
        $type;
        $userId;
        while ($result = mysql_fetch_array($r)){
            if (($_POST ['username'] == $result['Username']) && ($_POST['password'] == $result['Password'])) {
                $judge=1;
                $type=$result['Type'];
                $userId=$result['UserId'];
                break;
            }
        }
        if ($judge==1) {
            session_start();
            $_SESSION['user']=$_POST['username'];
            $_SESSION['userId']=$userId;
            $_SESSION['type']=$type;
            ob_end_clean();
            header("Location: index.php"); 
            exit();
        }
        else{
            header ('Location: login.php?id=1');
            exit();
        }
    } else { // 表单未填写完整。
    }
} 
if ($_SERVER['REQUEST_METHOD'] == 'GET')  { // 显示表单。
    $notice="";
    if (sizeof($_GET)!=0) {
        $notice='records not match';
    }
    print '<form action="login.php" method="post">
                <label for="username">Username:&nbsp&nbsp';
        print '<font color="red">'.$notice.'</font></label>
                <input type="text" id="username" name="username">
                <label for="password">Password:</label>
                <p><a href="#">Forgot your password?</a></p>
                <input type="password" id="password" name="password">
                <div id="lower">
                    <input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>
                    <input type="submit" value="Login">
                </div><!--/ lower-->
            </form>';
        }
        ?>
            
    </div>
</div>
