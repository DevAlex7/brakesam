<?php 
    require_once('config/server.php');
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <?php 
        Component::styles('home');
    ?>
</head>
<body>
<?php
    Component::navbar();
?>
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card" id="card-home">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6">
                        <img src="Imports/resources/pics/logo.png">
                    </div>
                    <div class="col s12 m6">
                        <span class="card-title">
                            ¡Bienvenido a Breaksam!
                        </span>
                        <span class="grey-text">Frenos y más</span>
                        <span class="card-title" id="title-card2">
                            Opciones
                        </span>
                        <div class="row" id="controlButtons">
                            <a class="btn" id="btnSailV"> <i class="material-icons left">swap_vert</i> Registro / Venta</a>
                            <a class="btn" id="btnAddProduct">  <i class="material-icons left"> shop</i>Agregar producto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 offset-m3">
        <div class="card" id="card-list-categories">
            <div class="card-content">
                <div class="center">
                    <span class="card-title" id="title-card3"></span>
                </div>
                <div class="row" id="readCategories">
                </div>
            </div>
        </div>
    </div>  
</div>
<script src="Imports/resources/js/global/jquery-3.2.1.min.js"></script>
<script src="Imports/resources/js/global/materialize.min.js"></script>
<script src="helpers/functions.js"></script>
<script src="controllers/Home.js"></script>
</body>
</html>