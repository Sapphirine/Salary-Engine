<?php
include('header.php');
?>

<style type="text/css">
    .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 7px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 17px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 10px } .datagrid table tfoot td div{ padding: 0px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>

<style type="text/css">
    header, section, footer, aside, nav, article, figure, figcaption {
        display: block;}
    body {
        color: #666666;
        background-color: #f9f8f6;
        background-position: center;
        font-family: Georgia, Times, serif;
        line-height: 1.4em;
        margin: 0px;}
    .wrapper {
        width: 1030px;
        margin: 20px auto 20px auto;
        border: 2px solid #000000;
        background-color: #ffffff;}
    header {
        height: 160px;
    }
    h1 {
        text-indent: -9999px;
        width: 940px;
        height: 130px;
        margin: 0px;}
    nav, footer {
        clear: both;
        color: #ffffff;
        background-color: #aeaca8;
        height: 30px;}
    nav ul {
        margin: 0px;
        padding: 5px 0px 5px 30px;}
    nav li {
        display: inline;
        margin-right: 40px;}
    nav li a {
        color: #ffffff;}
    nav li a:hover, nav li a.current {
        color: #000000;}
    section.courses {
        float: left;
        width: 659px;
        border-right: 1px solid #eeeeee;}
    article {
        clear: both;
        overflow: auto;
        width: 90%;}
    hgroup {
        margin-top: 40px;}
    figure {
        float: left;
        width: 290px;
        height: 220px;
        padding: 5px;
        margin: 20px;
        border: 1px solid #eeeeee;}
    figcaption {
        font-size: 90%;
        text-align: left;}
    aside {
        width: 230px;
        float: left;
        padding: 0px 0px 0px 20px;}
    aside section a {
        display: block;
        padding: 10px;
        border-bottom: 1px solid #eeeeee;}
    aside section a:hover {
        color: #985d6a;
        background-color: #efefef;}
    a {
        color: #de6581;
        text-decoration: none;}
    h1, h2, h3 {
        font-weight: normal;}
    h2 {
        margin: 10px 0px 5px 0px;
        padding: 0px;}
    h3 {
        margin: 0px 0px 10px 0px;
        color: #de6581;}
    aside h2 {
        padding: 30px 0px 10px 0px;
        color: #de6581;}
    footer {
        font-size: 80%;
        padding: 7px 0px 0px 20px;}
</style>

<?php
function numtostar($num)
{
    switch($num){
        case 1:
            $star="*";
            break;
        case 2:
            $star="**";
            break;
        case 3:
            $star="***";
            break;
        case 4:
            $star="****";
            break;
        case 5:
            $star="*****";
            break;
    }
    return $star;
} ?>

<?php
$Rname=$_GET['id'];
$Rname1;
if (strpos($Rname,"'")!==false)
{
    $Rname1=str_replace("'","''",$Rname);
}
else $Rname1=$Rname;
ini_set('display_errors','On');
$db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
$dbname = "twitt";
$conn = mysql_connect($db, "XX", "XX", $dbname);
$query4="select min(SalaryNormalized) as min, max(SalaryNormalized) as max from salaryengine where Company='$Rname1'";
$query5="select count(*) as num from salaryengine where Company='$Rname1'";
$query6="select avg(SalaryNormalized) as avg from salaryengine where Company='$Rname1'";
$query7="select * from salaryengine where Company='$Rname1' LIMIT 10";
$query8="select Distinct Category from salaryengine where Company='$Rname1'";

$r4 = mysql_db_query($dbname, $query4, $conn);
$r5 = mysql_db_query($dbname, $query5, $conn);
$r6 = mysql_db_query($dbname, $query6, $conn);
$r7 = mysql_db_query($dbname, $query7, $conn);
$r8 = mysql_db_query($dbname, $query8, $conn);

$result4 = mysql_fetch_array($r4);
$result5 = mysql_fetch_array($r5);
$result6 = mysql_fetch_array($r6);
?>


<div class="wrapper">
    <?php print '<h2><p>&nbsp;'.$Rname.'</h2></p>'; ?>
    <?php
    if (isset($_SESSION['user'])) { ?>

 <!--   <form class="navbar-form navbar-left" action="reservation.php?id=< echo $Rname?> " role="form" method="post">
        <button type="submit" class="btn btn-info">Make reservation</button>
    </form>

    <form class="navbar-form navbar-left" action="bookmark.php?id=< echo $Rname?>" role="form" method="post">

        <button type="submit" class="btn btn-info">I like it</button>
    </form>

    <form class="navbar-form navbar-left" action="make_com.php?id=< echo $Rname?>" role="form" method="post">

        <button type="submit" class="btn btn-info">Make Comments</button>
        </form>
-->
   <!--     <p>&nbsp;&nbsp;<a href="reservation.php?id=< echo $Rname?>" class="btn btn-info">make reservation</a>  -->
        <p>&nbsp;&nbsp;<a href="reservation.php?id=<? echo $Rname?>" class="btn btn-info">Browse Website</a>
            <a href="bookmark.php?id=<? echo $Rname?>" class="btn btn-info">Share Exp</a>
            <a href="make_com.php?id=<? echo $Rname?>" class="btn btn-info">Follow</a>
            </p>
    <?php } ?>
    <nav>
        <ul>
            <?php
                $tag = "tag: ";
                if (isset($r8)) {
                    while ($result8 = mysql_fetch_array($r8))
                        $tmp = (String)$result8['Category'];
                        $tagTmp = substr($tmp,0,strlen($tmp)-5);
                        $tag = $tag.$tagTmp.',';
                        $tag = substr($tag,0,strlen($tag)-1);
                }
                print $tag;
            ?>
        </ul>
    </nav>
    <section class="courses">
        <article>
            <figure>
                <img src="NotFound.jpg" />
                <figcaption><?php echo $Rname?></figcaption>
            </figure>
            <hgroup>
                <h3> <?php print $result5['num'].' opening jobs'; ?> </h3>
                <p> <?php print 'salary scale: '.$result4['min'].'~'.$result4['max'];?></p>
                <p> <?php print 'salary average: '.$result6['avg'];?></p>
            </hgroup>
        </article>
        <article>
            <hgroup>
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
    <?php 
        while ($result7 = mysql_fetch_array($r7)){
            print '<tr><td>'.$result7['Title'].'</td><td>'.$result7['LocationNormalized'].'</td><td>'.$result7['Category'].'</td><td>'.$result7['SalaryNormalized'].'</td></tr>';
        }
    ?>
</tbody> 
</table> 
<br />
<p><a class="btn btn-default" href="all_pos.php?id=<?php echo $Rname1;?> " role="button">View All &raquo;</a></p>
            </hgroup>
        </article>
        <h2><p>&nbsp;Comments:</p></h2>
                <?php
                if (isset($r8))
                {
                while ($result8 = mysql_fetch_array($r8)){
                    print '<p>&nbsp;&nbsp;Cost: '.$result8['COST'].' Rank: '.$result8['RANK'].'<br>'.
                        '&nbsp;&nbsp;"'.$result8['CONTENT'].'"<br>'.'&nbsp;&nbsp;--'.$result8['USERNAME'].' '.$result8['TIME'].'</p>';
                }
                }
                ?>
    </section>

    <aside>
        <section class="popular-recipes">
            <h2>Brief Info</h2>
            <p>XXX is a company focuses on providing XX technology as well as ......<p>
        </section>
        <section class="contact-details">
            <h2>More</h2>
            <p>CEO:</p>
            <p>Asset:</p>
            <p>Employer:</p>
            <p>Stock Price:</p>
        </section>
        <section class="contact-details">
            <h2>Contact Info</h2>
            <p>Address:</p>
            <p>Tele:</p>
            <p>E-mail:</p>
            <p>Website:</p>
        </section>
    </aside>


    <hr>
<?php
include('footer.php');
mysql_close($conn);
?>

