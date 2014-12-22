<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Salary Engine</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">
    <link href="mynew.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="jquery-1.11.1.min.js"> </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</head>

<body>

<script>
$(document).ready(function () {
    $("input#submit").click(function(){
        $.ajax({
            type: "POST",
            url: "process.php", //process to mail
            data: $('form.contact').serialize(),
            success: function(msg){
                $("#thanks").html(msg) //hide button and show thank you
                $("#form-content").modal('hide'); //hide popup  
            },
            error: function(){
                alert("failure");
            }
        });
    });
});
</script>

<style type="text/css">
        body { margin: 50px; background: url(assets/bglight.png); }
        .well { background: #fff; text-align: center; }
        .modal { text-align: left; }
    </style>

<div class="container">
    <div class="well well-large">
        <h2>Twitter Bootstrap Modal Contact Form Demo</h2>
        <div id="form-content" class="modal hide fade in" style="display: none;">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Send me a message</h3>
            </div>
            <div class="modal-body">
                <form class="contact" name="contact">
                    <label class="label" for="name">Your Name</label><br>
                    <input type="text" name="name" class="input-xlarge"><br>
                    <label class="label" for="email">Your E-mail</label><br>
                    <input type="email" name="email" class="input-xlarge"><br>
                    <label class="label" for="message">Enter a Message</label><br>
                    <textarea name="message" class="input-xlarge"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <input class="btn btn-success" type="submit" value="Send!" id="submit">
                <a href="#" class="btn" data-dismiss="modal">Nah.</a>
            </div>
        </div>
        <div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-primary btn-large">Modal powers, activate!</a></p></div>
    </div>
</div>

<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <?php
                session_start();
                if (isset($_SESSION['user'])){
                    if ($_SESSION['type']==="U") {
                        print '<li><a href="recommend.php">Recommend</a></li>';
                    }
                    else {
                        print '<li><a href="post.php">Post</a></li>';
                        print '<li><a href="predict.php">Predict</a></li>';
                    }
                    print '<li><a href="logout.php">Log out</a></li>';
                }
                ?>
            </ul>

            <div class="navbar-right">
            <?php
            if (isset($_SESSION['user'])){
               print '<p class="whiteone"><br>Welcome, '.$_SESSION['user'].'!</br></p>';
               ?>
            <?php }
             else {   ?>
            <form class="navbar-form navbar-right" action='login.php' role="form">

                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
            <?php } ?>
        </div>

        </div><!--/.navbar-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar -->
