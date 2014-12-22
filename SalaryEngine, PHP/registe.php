<?php
define('TITLE', 'Register');
include('header.php');
?>

<div class="container">
<?php
print '<h2>Registration Form</h2>
       <p>Register so that you can take advantage of certain features.</p>';

    print '<style type="text/css" media="screen">.error { color: red; }

    </style>';

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $problem = FALSE; // 目前一切正常。
        $address = FALSE;
    if (empty($_POST['username']) || strlen($_POST['username'])>20) {
        $problem = TRUE;
        print '<p class="error">Please enter your username!</p>';
    }
    if (empty($_POST['password1'])|| strlen($_POST['password1'])>20) {
        $problem = TRUE;
        print '<p class="error">Please enter a password!</p>';
    }
    if ($_POST['password1'] != $_POST['password2']) {
        $problem = TRUE;
        print '<p class="error">Your password did not match your confirmed password!</p>';
    }
    if (isset($_POST['since']) || isset($_POST['city']) || isset($_POST['region']))
    {
        $address = TRUE;
    }
    if (strlen($_POST['name'])>20)
    {
        $problem = TRUE;
        print '<p class="error">Your full name can not exceed 20 characters!</p>';
    }
    if (strlen($_POST['city'])>30 || strlen($_POST['region'])>50)
    {
    $problem = TRUE;
    print '<p class="error">Some input in your address exceed a ruled length</p>';
    }
    if (!$problem)  {
        ini_set('display_errors','On');
        $db = "w4111f.cs.columbia.edu:1521/adb";
        $conn = oci_connect("XX", "XX", $db);
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $name = $_POST['name'];
        $query4 = "select C.username from Customer C";
        $r4 = oci_parse($conn, $query4);
        oci_execute($r4);
        $check = TRUE;
        while ($result4=oci_fetch_array($r4)){
            if ($result4['USERNAME']==$username){
                $check=FALSE;
                break;
            }
        }
        if ($check) {
        $query = "insert into Customer VALUES ('$username','$name','$password',NULL)";
        $r = oci_parse($conn, $query);
        oci_execute($r);
        if ($address) {
            $since=null;
            $city=null;
            $street=null;
            $no=null;
            if (isset($_POST['since'])){
                $since = $_POST['since'];
            }
            if (isset($_POST['city'])){
                $city = $_POST['city'];
            }
            if (isset($_POST['region'])){
                $region = $_POST['region'];
            }
            if (isset($_POST['street'])){
                $street = $_POST['street'];
            }
            if (isset($_POST['no'])){
                $no = $_POST['no'];
            }
 //           print '<p>since:'.$since.'city:'.$city.'region:'.$region.'street:'.$street.'no:'.$no.'</p>';

            $query1 = "select max(L.aid) as max from Livein L";
            $r1 = oci_parse($conn, $query1);
            oci_execute($r1);
            $result1 = oci_fetch_array($r1);
            $num = $result1['MAX']+1;
            $query5 = "select * from Address A";
            $r5 = oci_parse($conn, $query5);
            oci_execute($r5);
            $addresscheck=TRUE;
            while ($result5=oci_fetch_array($r5)) {
                if ($result5['CITY']==$city && $result5['REGION']==$region && $result5['STREET']==$street && $result5['STREET_NO']==$no)
                {
                    $addresscheck=FALSE;
                    $num=$result5['AID'];
                    break;
                }
            }
            if ($addresscheck)
            {
            $query2 = "insert into Address VALUES ('$num','$city','$region','$street','$no')";
            $r2 = oci_parse($conn,$query2);
            oci_execute($r2);
            }
                $query3 = "insert into Livein VALUES (to_date('$since','yyyy-mm-dd'),'$username','$num')";
                $r3 = oci_parse($conn,$query3);
                oci_execute($r3);

            print '<p>You have successfully create your account!<p>';
        }
        }
        else print '<p class="error"> The user name has already been used! Please pick up another one.</p>';
     //   print '<p>'.$username.$password.$name.'</p>';
    //    print '<p>'.$since.$city.$region.$street.$no.'</p>';

     //   $query = "insert into Customer VALUES ('$_POST['username']',)"
    } else {
        print'<p class="error"> Please try again!</p>';
    }
    }
    ?>
    </div>

    <div class="container">
    <form action="register.php" method="post">
        <p>Username: <input type="text" name="username" size="20" value="<?php if (isset($_POST ['username'])) { print htmlspecialchars($_POST['username']); } ?>" /></p>
        <p>Password: <input type="password" name="password1" size="20" value="<?php if (isset($_POST['password1']))
            { print htmlspecialchars($_POST['password1']); } ?>" /></p>
        <p>Confirm Password: <input type="password" name="password2" size="20" value="<?php if (isset($_POST['password2']))
            { print htmlspecialchars($_POST['password2']); } ?>" /></p>
        <p>Optional: </p>
        <p>Full Name: <input type="text" name="name" size="20" value="<?php if (isset($_POST['name'])) { print htmlspecialchars($_POST['name']); } ?>" /></p>
        <p>Address: Since(format:yyyy-mm-dd) <input type="text" name="since" size="20" value="<?php if (isset($_POST['since'])) { print htmlspecialchars($_POST['since']); } ?>" /></p>
        <p>City: <input type="text" name="city" size="20" value="<?php if (isset($_POST['city'])) { print htmlspecialchars($_POST['city']); } ?>" />
            Region: <input type="text" name="region" size="20" value="<?php if (isset($_POST['region'])) { print htmlspecialchars($_POST['region']); } ?>" /></p>
        <p>Minimal Salary: <input type="text" name="street" size="20" value="<?php if (isset($_POST['street'])) { print htmlspecialchars($_POST['street']); } ?>" />
            Category: <input type="text" name="no" size="20" value="<?php if (isset($_POST['no'])) { print htmlspecialchars($_POST['no']); } ?>" /></p>
        <p><input type="submit" name="submit" value="Register!" /></p>
    </form>

        <hr>
    <?php include('footer.php'); ?>
    </div>