<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="siak_public/siak_css/assets/animate.css" rel="stylesheet">
    <link href="siak_public/siak_css/assets/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
<?php if (Siak_session::siak_get('loggedIn') == true) { ?>
<div class="lock-word animated fadeInDown">
    <span class="first-word">LOCKED</span><span>SCREEN</span>
</div>
    <div class="middle-box text-center lockscreen animated fadeInDown">
        <div>
            <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="siak_public/siak_css/assets/img/avatar1_small.jpg">
            </div>
            <h3>John Smith</h3>
            <p>Your are in lock screen. Main app was shut down and you need to enter your passwor to go back to app.</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="******" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width">Unlock</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
<?php }?>
</html>
