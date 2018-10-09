<?php
// inclui as definições gerais e inicia a sessão
include_once("api/definitions.php");

if(!isset($_SESSION['username'])) {
    header("Location: " . LOGIN_PAGE);
}
?>  

<!DOCTYPE html>
<html>
    <head>
        <title>Painel - Minha rede social</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/material-kit.css">
    </head>
    <body class="index-page">
        <?php if(isset($_GET['msg'])) { ?>
        <fieldset>
            <?php echo $_GET['msg']; ?>
        </fieldset>
        <?php } ?>

        <nav class="navbar navbar-color fixed-top navbar-expand-lg">
            <div class="container">
                <div class="navbar-translate">
                    <a class="navbar-brand" href="./index.html">Rede social</a>
                    <button class="navbar-toggler toggled" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="api/api.php?logout">
                                <i class="material-icons">cloud_download</i> Sair
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="api/api.php?logout">
                                <i class="material-icons">cloud_download</i> Sair
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="api/api.php?logout">
                                <i class="material-icons">cloud_download</i> Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div>
            <h1>Bem vindo, <?php echo ucfirst($_SESSION['username']); ?>! [<a href="api/api.php?show_notifications"><?php echo get_notifications($connection, $_SESSION['username']); ?></a>]</h1>
        </div><br/><br/><br/>

        <div class="main main-raised">
            <form action="api?post" method="post">
                <textarea name="message" placeholder="O que você está pensando?" class="form-control"></textarea>
                <input type="submit" value="Postar!" class="btn btn-lg btn-primary"/>
            </form>

            <section>
                <?php echo get_all_posts($connection); ?>
            </section>
        </div>


        <!--   Core JS Files   -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/material.min.js"></script>

		<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
		<script src="assets/js/nouislider.min.js"></script>

		<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
		<script src="assets/js/bootstrap-datepicker.js"></script>

		<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
		<script src="assets/js/material-kit.js"></script>

        <script src="base.js"></script>
    </body>
</html>
