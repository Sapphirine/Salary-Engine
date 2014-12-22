<?php
    include('header.php');
?>

<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
                <h1>Salary Engine</h1>
                <p>Salary Engine is a platform for searching and posting jobs. Find your suitable job from a expanding library, 
                    and predict a reasonable salary from our big data computing tools. It is that easy!</p>
                <p><a href="register.php" class="btn btn-info">Create your free account!</a>
                <?php 
                    if (isset($_SESSION['user'])){
                        if ($_SESSION['type']==="R") {
                            print'<a id="post" class="btn btn-info">Post a new job!</a>'; 
                        }
                    }
                ?>
                </p>
            </div>

            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="loginForm" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Salary</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-5">
                            <input type="textarea" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5 col-sm-offset-3">
                            <button type="submit" class="btn btn-default">Post!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#post').click(function() {
        $('#loginModal').modal('show');
    });
});
</script>

            <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" role="form" action="search.php" method="post">
                <div class="form-group">
            <select name="method" class="form-control">
                    <option value="Position">Position</option>
                    <option value="Salary">Salary</option>
                    <option value="Location">Location</option>
            </select>
                    </div>
                <div class="form-group">
            <input type="text" name="search" size="30" class="form-control">
                    </div>
            <button type="submit" class="btn btn-success">GO!</button>
        
            <button type="button" class="btn btn-success" id="AS">Advanced Search</button>

            </form>
            </div>

            <div class="navbar-collapse collapse">
                <form id="search" class="navbar-form navbar-left" role="form" action="search.php" method="post">
                    <div class="form-group">
                    <p> Position<input type="text" name="Position"/> </P>
                    <p> Salary<input type="text" name="Salary"/> </P>
                    <p> Location<input type="text" name="Location"/> </P>
                    <input type="hidden" name="method" value="Advanced">
                    </div>
                    <p> <button type="submit" class="btn btn-success">Search!</button> </p>
                </form> 
            </div>

            <script type="text/javascript">
            $ (document).ready(function() {
                $("#search").hide();
                $("#AS").click(function() {
                    $("#search").toggle();
                });

            });
            </script>
    </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a href="pos_type.php?id=Accounting" class="list-group-item active">Accounting</a>
                <a href="pos_type.php?id=Engineering" class="list-group-item">Engineering</a>
                <a href="pos_type.php?id=Finance" class="list-group-item">Finance</a>
                <a href="pos_type.php?id=Sales" class="list-group-item">Sales</a>
                <a href="pos_loc.php?id=London" class="list-group-item">London</a>
                <a href="pos_loc.php?id=Birminghan" class="list-group-item">Birminghan</a>
                <a href="pos_loc.php?id=Manchester" class="list-group-item">Manchester</a>
                <a href="pos_loc.php?id=Glascow" class="list-group-item">Glascow</a>
            </div>
        </div><!--/span-->
    </div><!--/row-->

<div class="row">
                <div class="col-6 col-sm-6 col-lg-4">
                    <h2>Newly posted postion</h2>                    
                    <p>
                    <?php
                        $db = "wc2467db.ccfkey37ocrc.us-west-2.rds.amazonaws.com:3306";
                        $dbname = "twitt";
                        $conn = mysql_connect($db, "wc2467", "19910722njCW", $dbname);
                        $query = "select Id, Title, Company from salaryengine LIMIT 5";
                        $r = mysql_db_query($dbname, $query, $conn);
                        while ($result = mysql_fetch_array($r)){
                            print '<li><a href="pos.php?id='.$result['Id'].'">'.$result['Title'].'</a></li> --- '.$result['Company'];
                        }
                    ?>
                    </p>
                    <p><a class="btn btn-default" href="newly_Res.php" role="button">View details &raquo;</a></p>
                </div><!--/span-->
                <div class="col-6 col-sm-6 col-lg-4">
                    <h2>Hot positions</h2>
                    <p>It's pleasure to share your experience here!</p>
                    <?php
                        
                    ?>
                    <p><a class="btn btn-default" href="newly_com.php?id=newly" role="button">View details &raquo;</a></p>
                </div><!--/span-->
                <div class="col-6 col-sm-6 col-lg-4">
                    <h2>Newly posted preview</h2>
                    <?php
                        $query = "select C.CompanyName, U.Username, day(C.Date) as day, month(C.Date) as month, time(C.Date) as time from Users U, Comments C where C.UserId=U.userID order by C.commentID DESC LIMIT 5";
                        $r = mysql_db_query($dbname, $query, $conn);
                        while ($result = mysql_fetch_array($r)){
                            print '<li><a href="res.php?id='.$result['CompanyName'].'">'.$result['CompanyName'].'</a></li> --- '.$result['Username'].'&nbsp'.$result['month'].'-'.$result['day'].'&nbsp'.$result['time'];
                        }
                    ?>
                </p>
                    <p><a class="btn btn-default" href="newly_com.php?id=newly" role="button">View details &raquo;</a></p>
                </div><!--/span-->
            </div><!--/row-->


    <hr>

<?php
include('footer.php');
?>

