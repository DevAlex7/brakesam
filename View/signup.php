<?php 
    require_once('config/server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/global/materialize.min.css">
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/global/material-icons.css">
    <link rel="stylesheet" href="<?php print SERVERURL; ?>Imports/resources/css/utilities/signup.css">
</head>
<body>
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card" id="card-login">
                <div class="card-content">
                <div class="center" id="logo">
                        <img src="Imports/resources/pics/logo.png"></img>
                </div>
                <span class="card-title center" id="titleLogin">Crea tu cuenta</span>
                    
                    <div class="row">
                        <form class="col s12" method="POST" id="form-register">
                            <div class="row">
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconUsername">account_circle</i>
                                    <input  autocomplete="off" name="nameUser" type="text" placeholder="Nombre">
                                </div>
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconUsername">account_circle</i>
                                    <input type="text" name="lastnameUser" autocomplete="off" placeholder="Apellido">
                                </div>
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconUsername">mail</i>
                                    <input  type="text" name="emailUser" autocomplete="off" placeholder="Email">
                                </div>
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconUsername">person</i>
                                    <input  name="Username" id="Username" type="text" autocomplete="off" placeholder="Usuario">
                                </div>
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconPassword">vpn_key</i>
                                    <input  type="password" name="keyuser" autocomplete="new-password" placeholder="Contraseña">
                                </div>
                                <div class="input-field col s6 offset-s3">
                                    <i class="material-icons prefix" id="iconPassword">vpn_key</i>
                                    <input  type="password" name="keyuser2" autocomplete="new-password" placeholder="Confirme su contraseña">
                                </div>
                            </div>
                            <div class="center">
                                <button class="btn" id="btnLogin">Registrarme</button>
                                <button class="btn" id="close"> cerrar </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php print SERVERURL; ?>Imports/resources/js/global/jquery-3.2.1.min.js"></script>
<script src="<?php print SERVERURL; ?>Imports/resources/js/global/materialize.min.js"></script>
<script src="<?php print SERVERURL; ?>helpers/functions.js"></script>
<script src="<?php print SERVERURL; ?>controllers/Login.js"></script>
</body>
</html>