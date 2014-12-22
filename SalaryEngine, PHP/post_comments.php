<?php
include('header.php');
?>

    <?php
        date_default_timezone_set('America/New_York');
        $userId = (int)$_SESSION['userId'];
        $comments = $_POST['comments'];
        $companyName = $_POST['companyName'];
        print $companyName;
        $rank = (int)$_POST['feeling'];
        $date = date('Y-m-d H:i:s');
        ini_set('display_errors','On');
            $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
            $dbname = "twitt";
            $conn = mysql_connect($db, "XX", "XX", $dbname);
        $query = "insert into Comments(UserId, CompanyName, Comments, Rank, Date) VALUES ('$userId','$companyName','$comments','$rank','$date')";
        mysql_db_query($dbname, $query, $conn);
        header('Location: res.php?id='.$companyName);
    ?>