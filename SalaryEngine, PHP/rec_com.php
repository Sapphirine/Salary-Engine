<?php
include('header.php');
?>

<style type="text/css">
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
}
</style>
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

<div class="loader">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
</script>

</div>

<div class="container">
    <h2><?php print 'Companies you may like'; ?></h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

    <table class="order-table table">
        <thead>
            <tr>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
<?php
    $userId=$_SESSION['userId'];
    $username=$_SESSION['user'];
    $res=file_get_contents("http://localhost:8080/SalaryEngine/CompanyRecommender?userId=".$userId); 
    $array=explode(",", $res);
    $length=count($array);
    for ($i=0;$i<$length;$i++) {
        $conpanyName=$array[$i];
        print '<tr><td><a href="res.php?id='.$conpanyName.'">'.$conpanyName.'</td></tr>';
    }
?>
        </tbody>
    </table>

</section>

<?php
include('footer.php');
?>