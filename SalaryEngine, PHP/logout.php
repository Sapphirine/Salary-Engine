<?php
include('header.php');
?>

<?php
$_SESSION['user']=null;
$_SESSION['type']=null;
$_SESSION['userId']=null;
header('Location: index.php');
exit();
?>

    <div class="container">
        <h2> You are successfully logout. </h2>
        <p> Thank you for using "Delicacy Finder" </br>
        Hoping your coming back again! </p>


<?php
include('footer.php');
?>