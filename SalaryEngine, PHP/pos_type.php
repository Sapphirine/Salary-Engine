<?php
    include('header.php');
?>

<?php
    $Type = $_GET['id'];
?>

<script>
(function(document) {
    'use strict';

    var LightTableFilter = (function(Arr) {

        var _input;

        function _onInputEvent(e) {
            _input = e.target;
            var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
            Arr.forEach.call(tables, function(table) {
                Arr.forEach.call(table.tBodies, function(tbody) {
                    Arr.forEach.call(tbody.rows, _filter);
                });
            });
        }

        function _filter(row) {
            var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }

        return {
            init: function() {
                var inputs = document.getElementsByClassName('light-table-filter');
                Arr.forEach.call(inputs, function(input) {
                    input.oninput = _onInputEvent;
                });
            }
        };
    })(Array.prototype);

    document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });

})(document);
</script>

<section class="container">

    <h2><?php print $Type.' related positions'?></h2>

    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

    <table class="order-table table">
        <thead>
            <tr>
                <th>Company</th>
                <th>Title</th>
                <th>Location</th>
                <th>Category</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $Type = strtoupper($Type);
            ini_set('display_errors','On');
            $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
            $dbname = "twitt";
            $conn = mysql_connect($db, "XX", "XX", $dbname);
            $query = "select * from salaryengine where upper(Category) like '%".$Type."%' LIMIT 200";
            $r = mysql_db_query($dbname, $query, $conn);
            while ($result = mysql_fetch_array($r)){
                print '<tr><td><a href="res.php?id='.$result['Company'].'">'.$result['Company'].'</td><td><a href="pos.php?id='.$result['Id'].'">'.$result['Title'].'</td><td>'.$result['LocationNormalized'].'</td><td>'.$result['Category'].'</td><td>'.$result['SalaryNormalized'].'</td></tr>';
            }
        ?>
        </tbody>
    </table>

</section>

<?php
include('footer.php');
?>

