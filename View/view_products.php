<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Productos</title>
    <?php 
        Component::styles('products_view');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row" id="readProducts">
    </div>
<?php 
    Component::scripts('Products_view');
?>
</body>
</html>