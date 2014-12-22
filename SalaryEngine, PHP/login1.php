<?php
define('TITLE', 'Login');
include('header.php');
?>

<div class="container">
<?php
print '<h2>Login Form</h2>
<p>Users who are logged in can take advantage of certain features.</p>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {
        ini_set('display_errors','On');
        $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
        $dbname = "twitt";
        $inputname = $_POST['username'];
        $conn = mysql_connect($db, "XX", "XX", $dbname);
        $query = "select Username, Password, Type from Users where Username='$inputname'";
        $r = mysql_db_query($dbname, $query, $conn);
        $judge=0;
        $type;
        while ($result = mysql_fetch_array($r)){
            if (($_POST ['username'] == $result['Username']) && ($_POST['password'] == $result['Password'])) {
                $judge=1;
                $type=$result['Type'];
                break;
            }
        }
        if ($judge==1) {
            session_start();
            $_SESSION['user']=$_POST['username'];
            $_SESSION['type']=$type;
            ob_end_clean();
            header ('Location: index.php');
            exit();
        }
        else{
            print '<p>The submitted email address and password do not match those on
  file!<br/>Go back and try again.</p>';
        }
    } else { // 表单未填写完整。
    }
} else { // 显示表单。
    print '<form action="login.php" method="post">
    <p>Username: <input type="text" name="username" size="20" /></p>
    <p>Password: <input type="password" name="password" size="20" /></p>
    <p><input type="submit" name= "submit" value="Log In!" /></p>
 </form>';
}
?>
?>
    <hr>
    <?php
include('footer.php'); // 包含页脚文件。
?>