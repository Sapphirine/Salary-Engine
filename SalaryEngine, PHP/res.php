<?php
include('header.php');
?>

<style type="text/css">
    .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 7px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 17px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 10px } .datagrid table tfoot td div{ padding: 0px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
$Rname=$_GET['id'];
$Rname1;
if (isset($_SESSION['userId'])) {
    $userId=$_SESSION['userId'];
}
if (strpos($Rname,"'")!==false)
{
    $Rname1=str_replace("'","''",$Rname);
}
else $Rname1=$Rname;
ini_set('display_errors','On');
$db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
$dbname = "twitt";
$conn = mysql_connect($db, "XX", "XX", $dbname);
$query3="select count(*) as num from Comments where CompanyName='$Rname1'";
$query4="select min(SalaryNormalized) as min, max(SalaryNormalized) as max from salaryengine where Company='$Rname1'";
$query5="select count(*) as num from salaryengine where Company='$Rname1'";
$query6="select avg(SalaryNormalized) as avg from salaryengine where Company='$Rname1'";
$query7="select * from salaryengine where Company='$Rname1' LIMIT 6";
$query8="select Distinct Category from salaryengine where Company='$Rname1'";
$query9="select C.UserId, C.Date, C.Comments, C.Rank, U.Username from Comments C, Users U where C.CompanyName='$Rname1' and C.UserId=U.UserId";

$r3 = mysql_db_query($dbname, $query3, $conn);
$r4 = mysql_db_query($dbname, $query4, $conn);
$r5 = mysql_db_query($dbname, $query5, $conn);
$r6 = mysql_db_query($dbname, $query6, $conn);
$r7 = mysql_db_query($dbname, $query7, $conn);
$r8 = mysql_db_query($dbname, $query8, $conn);
$r9 = mysql_db_query($dbname, $query9, $conn);

$result3 = mysql_fetch_array($r3);
$result4 = mysql_fetch_array($r4);
$result5 = mysql_fetch_array($r5);
$result6 = mysql_fetch_array($r6);
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <?php 

                    print '<h1>'.$Rname.'</h1>'; 
                ?>

                 <?php
                    if (isset($_SESSION['user'])) { ?>
                    <p>&nbsp;&nbsp;<a href="reservation.php?id=<? echo $Rname?>" class="btn btn-info">Browse Website</a>
                    <a href="bookmark.php?id=<? echo $Rname?>" class="btn btn-info">Share Exp</a>
                    <a href="make_com.php?id=<? echo $Rname?>" class="btn btn-info">Follow</a>
                     </p>
                <?php } ?>
                <!-- Author -->

                <!-- Date/Time -->
                <?php
                $tag = "tag: ";
                if (isset($r8)) {
                    while ($result8 = mysql_fetch_array($r8))
                        $tmp = (String)$result8['Category'];
                        $tagTmp = substr($tmp,0,strlen($tmp)-5);
                        $tag = $tag.$tagTmp.',';
                        $tag = substr($tag,0,strlen($tag)-1);
                }
                print '<p><span class="glyphicon glyphicon-time"></span>&nbsp;'.$tag.'</p>';
                ?>

                <hr>

                <!-- Preview Image -->
              <div class="row">
                <div class="col-6 col-sm-6 col-lg-7">
                <figure>
                    <img class="img-responsive" src="NotFound.jpg" alt="">
                    <figcaption><?php echo $Rname?></figcaption>
                </figure>
                </div>

                <div class="col-6 col-sm-6 col-lg-5">
                    <h3><font color="blue"><?php print $result5['num'].' opening jobs'; ?></font></h3>
                    <p> &nbsp&nbsp&nbsp<?php print 'salary scale: '.$result4['min'].'~'.$result4['max'];?></p>
                    <p> &nbsp&nbsp&nbsp<?php print 'salary average: '.$result6['avg'];?></p>
                    <h3><font color="blue"><?php print $result3['num'].' comments in total'; ?></font></h3>
                </div>
            </div>
                <hr>
                <!-- Post Content -->
                <style type="text/css">
               table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  padding: 0.25rem;
  text-align: left;
  border: 1px solid #ccc;
}
tbody tr:nth-child(odd) {
  background: #eee;
}
</style>
<table class="zebra"> 
<thead> 
<tr> 
    <th>Title</th> 
    <th>Location</th> 
    <th>Category</th> 
    <th>Salary</th> 
</tr> 
</thead> 
<tbody> 
    <h2>Jobs</h2>
    <?php 
        while ($result7 = mysql_fetch_array($r7)){
            print '<tr><td>'.$result7['Title'].'</td><td>'.$result7['LocationNormalized'].'</td><td>'.$result7['Category'].'</td><td>'.$result7['SalaryNormalized'].'</td></tr>';
        }
    ?>
</tbody> 
</table> 
</br>
<p><a class="btn btn-default" href="all_pos.php?id=<?php echo $Rname1;?> " role="button">View All &raquo;</a></p>

                <hr>

                <!-- Blog Comments -->
                <!-- Comments Form -->
                <?php
                    if (isset($_SESSION['user'])) { ?>
                    <div class="well">
                    <h4><p id="demo"> Be the first to leave a Comment:</p></h4>
                    <form role="form" action="post_comments.php" method="post">
                        <div class="form-group">
                            <p> feeling 
                                <select name="feeling">
                                    <option value=3>positive</option>
                                    <option value=2>medium</option>
                                    <option value=1>nagetive</option>
                                </select>
                            </p>
                            <input type="hidden" name="companyName" value="<?php echo $Rname1?>">
                            <textarea name="comments" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <hr>
            <?php } ?>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                $judge = 0;
                if (isset($r9)) {
                    while ($result9 = mysql_fetch_array($r9)) {
                        $judge = 1;
                        $comment_userId = $result9['UserId'];
                        $comment_user = $result9['Username'];
                        $comment_date = $result9['Date'];
                        $comment_content = $result9['Comments'];
                        $comment_rank = $result9['Rank'];
                
                        print '<div class="media">
                            <a class="pull-left" href="#">
                            <img class="media-object" src="user'.$comment_userId.'.jpg" alt="">
                            </a>
                            <div class="media-body">
                             <h4 class="media-heading">'.$comment_user.'
                                <small>'.$comment_date.'</small>';
                            switch ($comment_rank) {
                                case 1:
                                    print '<small><font color="red">&nbspNot Recommend</font></small>';
                                    break;
                                case 2:
                                    break;
                                case 3:
                                    print '<small><font color="green">&nbspRecommend</font></small>';
                                    break;
                            }
                            print '</h4>'
                                .$comment_content.   
                            '</div>
                            </div>'; 
                        }
                    }

                if ($judge == 1) { ?>
                    <script>
                        document.getElementById("demo").innerHTML="Leave a Comment";
                    </script>
                <?php }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4><font color="red">Brief Info</font></h4>
                    <hr>
                    <p> XXX is a company focuses on providing XX technology as well as ......
                    </p>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4><font color="red">More</font></h4>
                    <hr>
                    <p>CEO:</p>
                <p>Asset:</p>
                <p>Employer:</p>
                <p>Stock Price:</p>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4><font color="red">Contact Info</font></h4>
                    <hr>
                   <p>Address:</p>
                    <p>Tele:</p>
                    <p>E-mail:</p>
                     <p>Website:</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>