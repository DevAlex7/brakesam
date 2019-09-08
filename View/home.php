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
                            <a class="btn modal-trigger" href="#modaladdProduct" id="btnAddProduct">  <i class="material-icons left"> shop</i> Agregar producto</a>
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
<div class="modal white" id="modaladdProduct">
    <div class="modal-content">
        <span class="modal-title">Agregar producto</span>
        <p class="grey-text">Complete los datos</p>
        <form method="POST" id="form-addProduct">

            <div class="input-field prefix">
                <input type="text" name="name_product" id="name_product" placeholder="Nombre">
            </div>

            <div class="input-field prefix">
                <input type="text" name="price_product" id="price_product" placeholder="Precio">
            </div>

            <div class="input-field prefix">
                <select name="listProvider" id="listProvider"></select>
            </div>

            <div class="input-field prefix">
                <input type="text" name="count_product" id="count_product" placeholder="Cantidad">
            </div>

            <div class="input-field prefix">
                <select name="listWarehouses" id="listWarehouses"></select>
            </div>

            <div class="input-field prefix">
                <select name="listSubcategories" id="listSubcategories"></select>
            </div>

            <div class="file-field input-field col s12 m9" id="TimeSection">
                <div class="btn waves-effect">
                    <span><i class="material-icons">image</i></span>
                    <input 
                    id="product_image" 
                    type="file" 
                    name="product_image" 
                    required/>
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path validate" placeholder="Seleccione una imagen"/>
                </div>
            </div>
            <div class="center">
                <button type="submit" class="btn-large" id="addProductBtn">Agregar</button>
                <a class="btn-large red-cover grey button-rounded">Cancelar</a>
            </div>

        </form>
    </div>
</div>  
<?php 
    Component::scripts('Home');
?>
</body>
</html>