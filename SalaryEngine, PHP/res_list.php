<?php
include('header.php');
?>

<style type="text/css">
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 7px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 17px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 10px } .datagrid table tfoot td div{ padding: 0px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
</style>


<?php
global $query3;
global $head;
switch ($_GET['id']) {
    case 'all':
        $query3="select * from Res_Loc R, Address A where R.aid=A.aid";
        $head="The List of All Restaurant";
        break;
    case 'American':
        $query3="select * from Res_Loc R, Address A where R.aid=A.aid and instr(R.category,'American')>0";
        $head="The List of American Restaurant";
        break;
    case 'Korean':
        $query3="select * from Res_Loc R, Address A where R.aid=A.aid and instr(R.category,'Korean')>0";
        $head="The List of Korean Restaurant";
        break;
    case 'Chinese':
        $query3="select * from Res_Loc R, Address A where R.aid=A.aid and instr(R.category,'Chinese')>0";
        $head="The List of Chinese Restaurant";
        break;
    case 'Japanese':
        $query3="select * from Res_Loc R, Address A where R.aid=A.aid and instr(R.category,'Japanese')>0";
        $head="The List of Japanese Restaurant";
        break;
}

?>

<div class="container">
    <?php
    print '<p><h2>'.$head.'</h2></p>';
    ini_set('display_errors','On');
    $db = "w4111f.cs.columbia.edu:1521/adb";
    $conn = oci_connect("XX", "XX", $db);
    $r3 = oci_parse($conn,$query3);
    oci_execute($r3);
    ?>

    <div class="datagrid">
        <table>
            <?php
            print '<thead><tr><th>Restaurant</th><th>Rank</th><th>cost</th><th>category</th><th>Address</th></tr></thead>';
            $i=1;
            while ($result3 = oci_fetch_array($r3)){
                $i++;
                if ($i%2==1)
                { print'<tr class="alt"><td><a href="res.php?id='.$result3['RNAME'].'">'.$result3['RNAME'].'</a></td><td>'.$result3['SCORE'].'</td><td>'.$result3['AVG_COST'].'</td><td>'.
                    $result3['CATEGORY'].'</td><td>'.$result3['STREET_NO'].$result3['STREET'].$result3['REGION'].$result3['CITY'].'</td></tr>'; }
                else {
                    print'<tr><td><a href="res.php?id='.$result3['RNAME'].'">'.$result3['RNAME'].'</a></td><td>'.$result3['SCORE'].'</td><td>'.$result3['AVG_COST'].'</td><td>'.
                        $result3['CATEGORY'].'</td><td>'.$result3['STREET_NO'].$result3['STREET'].$result3['REGION'].$result3['CITY'].'</td></tr>';
                }
            }
            ?>
        </table>
    </div>

    <hr>
<?php
include('footer.php');
?>