<?php
    include('header.php');
?>

<?php 
    $posId = (int) $_GET['id'];
    ini_set('display_errors','On');
	$db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
	$dbname = "twitt";
	$conn = mysql_connect($db, "XX", "XX", $dbname);
	$query = "select * from salaryengine where Id='$posId'";
	$r = mysql_db_query($dbname, $query, $conn);
	$result = mysql_fetch_array($r);
?>

<div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1> <a href="res.php?id=<?php print $result['Company']?>"><?php print $result['Company']?></a></h1>
                <h3> <?php print $result['Title'].'&nbsp&nbsp / Location: '.$result['LocationNormalized'].'   Salary: '.$result['SalaryNormalized'];?></h3>
                <hr>
                <p> <?php print 'Job Description:'.$result['FullDescription']; ?></p>
                <hr>
                <p> <?php print 'Tag: '.$result['Category']; ?> </p> 
            </div>
        </div>
</div>

<?php
include('footer.php');
?>

