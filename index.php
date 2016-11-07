<?php
require 'recaptcha.php';
$recaptcha = new Recaptcha();
?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <?= $recaptcha->script();?>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <a class="navbar-brand" href="#">Project name</a>
    <ul class="nav navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
    </ul>
</nav>

<div class="container" style="margin-top: 100px;">

    <?php

    if(!empty($_POST)){
        var_dump($_POST);
        echo $_POST['g-recaptcha-response'];

        if($recaptcha->isValid($_POST['g-recaptcha-response']) === false){?>
            <div class="alert alert-danger">Captcha invalide</div>
        <?php } else{ ?>
            <div class="alert alert-success">Formulaire ok</div>
        <?php }
    }
    ?>


    <div>
        <form action="#" method="POST">
            <input type="email" name="email">
            <?= $recaptcha->html();?>
            
            <button type="submit"> Envoyer</button>
        </form>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src=//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>
</html>
