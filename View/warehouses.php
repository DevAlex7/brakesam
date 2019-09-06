<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sucursales</title>
    <?php 
        Component::styles('warehouses');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content"></div>
            </div>
        </div>
    </div>
<?php   
    Component::scripts('Warehouses');
?>
</body>
</html>