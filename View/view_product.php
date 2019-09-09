<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Producto</title>
    <?php 
        Component::styles('product_view');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row">
        <div class="col s12 m4 offset-m4">
            <div id="divtitleProduct">
                <span id="ProductTitle"></span>
            </div>    
            <img src="" alt="" id="imgProduct">
            <div id="detailsProduct">   
                <div class="row">
                <span>Datos generales  </span>
                </div>
                <div class="row">
                    <span class="grey-text">Precio</span>
                    <p> <i class="material-icons left">attach_money</i> <span id="priceTitle">4.50</span> </p>
                    <span class="grey-text">Proveedor</span>
                    <p> <i class="material-icons left">person</i> <span id="providerTitle"></span></p>
                    <span class="grey-text">Cantidad</span>
                    <p> <i class="material-icons left">donut_large</i> <span id="countTitle"></span></p>
                    <span class="grey-text">Almacen depositado</span>
                    <p> <i class="material-icons left">store</i> <span id="warehouseTitle"></span></p>
                </div>
                <div class="row">
                    <div class="center">
                        <a href="viewproducts" class="btn-large"> <i class="material-icons left">arrow_left</i> Regresar</a>
                        <a href="" class="btn-large"> <i class="material-icons left">call_made</i> Vender</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    Component::scripts('Product_view');
?>
</body>
</html>