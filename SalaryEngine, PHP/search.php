<?php
include('header.php');
?>

    <style type="text/css">
        .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 7px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 17px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 10px } .datagrid table tfoot td div{ padding: 0px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
    </style>

<div class="container">
<?php
$type=$_POST['method'];
ini_set('display_errors','On');
$db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
$dbname = "twitt";
$conn = mysql_connect($db, "XX", "XX", $dbname);
global $query4;
switch($type)   {
    case 'Position';
        print '<h2><p>your search result for "'.$_POST['search'].'":</p></h2>';
        $search=$_POST['search'];
        $search=strtoupper($search);
        $query4="select * from salaryengine where upper(Title) like '%".$search."%' LIMIT 10";
        break;
    case 'Salary':
        print '<h2><p>your search result for "'.$_POST['search'].'":</p></h2>';
        $search=$_POST['search'];
        $salary=(int)$search;
        $query4="select * from salaryengine where SalaryNormalized>='$salary' LIMIT 10" ;
        break;
    case 'Location':
        print '<h2><p>your search result for "'.$_POST['search'].'":</p></h2>';
        $search=$_POST['search'];
        $search=strtoupper($search);
        $query4="select * from salaryengine where upper(LocationNormalized) like '%".$search."%' LIMIT 10";
        break;
    case 'Advanced':
        $pos=strtoupper($_POST['Position']);
        $Sal=(int)$_POST['Salary'];
        $Loc=$_POST['Location'];
        print '<h2><p>your search result for "'.$pos.' &nbsp '.$Sal.' &nbsp '.$Loc.'":</p></h2>';
        $query4="select * from salaryengine where upper(Title) like '%".$pos."%' AND SalaryNormalized>='$Sal' AND 
        upper(LocationNormalized) like '%".$Loc."%' LIMIT 10"; 
}

$r4 = mysql_db_query($dbname, $query4, $conn);


    if (!isset($r4))
    {
        print '<p>Sorry, there is no result for your search!</p>';
    }
    else {
?>
    <div class="datagrid">
        <table>
            <?php
            print '<thead><tr><th>Company</th><th>Title</th><th>Location</th><th>category</th><th>Salary</th></tr></thead>';
            $i=1;
            while ($result4 = mysql_fetch_array($r4)){
                $i++;
                if ($i%2==1)
                { print'<tr class="alt"><td><a href="res.php?id='.$result4['Company'].'">'.$result4['Company'].'</a></td><td><a href="pos.php?id='.$result4['Id'].'">'.$result4['Title'].'</td><td>'.$result4['LocationNormalized'].'</td><td>'.
                    $result4['Category'].'</td><td>'.$result4['SalaryNormalized'].'</td></tr>'; }
                else {
                    print'<tr><td><a href="res.php?id='.$result4['Company'].'">'.$result4['Company'].'</a></td><td><a href="pos.php?id='.$result4['Id'].'">'.$result4['Title'].'</td><td>'.$result4['LocationNormalized'].'</td><td>'.
                        $result4['Category'].'</td><td>'.$result4['SalaryNormalized'].'</td></tr>';
                }
            }
            ?>
        </table>
    </div>

    <?php }?>
    <hr>

<?php
include('footer.php');
?>