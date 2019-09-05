<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proveedores</title>
    <?php 
        Component::styles('suppliers');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row">
        <div class="col s12 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title"> <i class="material-icons left">group</i> Empresa</span>
                    <span class="grey-text"> Complete datos de la empresa proveedora</span>
                    <form method="POST">
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">apartment</i>
                            <input type="text" name="" placeholder="Nombre" id="">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">room</i>
                            <input type="text" name="" placeholder="Dirección" id="">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">phone</i>
                            <input type="text" name="" placeholder="Numero teléfonico" id="">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">contact_mail</i>
                            <input type="text" name="" placeholder="Numero NIT" id="">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">contact_mail</i>
                            <input type="text" name="" placeholder="Numero NRC" id="">   
                        </div>
                        <div class="center">
                            <button type="submit" class="btn" id="btnAddSupplier">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s12 m8">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Proveedores</span>
                    <div id="contentDiv">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        Component::scripts('Suppliers');
    ?>
</body>
</html>