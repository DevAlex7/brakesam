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
        <div class="col s12 m4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Sucursal</span>
                    <span class="grey-text">Ingrese los datos de la sucursal</span>
                    <form method="post" id="createWarehouse">
                        <div class="input-field prefix">
                            <i class="material-icons prefix black-text">store</i>
                            <input 
                                type="text" 
                                name="name_warehouse" 
                                id="name_warehouse"
                                placeholder="Sucursusal"
                            >
                        </div>
                        <div class="input-field prefix">
                            <i class="material-icons prefix black-text">room</i>
                            <input 
                                type="text" 
                                name="ubication_warehouse" 
                                id="ubication_warehouse"
                                placeholder="Ubicación de la sucursal"
                            >
                        </div>
                        <div class="center">
                            <button type="submit" class="btn" id="btnAddWarehouse">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s12 m8">
            <div class="card">
                <div class="card-content">
                    <div id="warehousesRead">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal white" id="modalEditWarehouse">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12">
                    <span id="editWarehouse" class="center">Editar sucursal</span>
                    <p  class="grey-text">Complete los datos</p>
                    <form method="POST" id="form-updateWh">
                        <div class="row">
                            <input type="hidden" name="id_warehouse" id="id_warehouse">
                            <div class="col s12 m6 offset-m3">
                                <div class="input-field prefix">
                                    <i class="material-icons prefix black-text">store</i>
                                    <input type="text" name="edit_warehouse" id="edit_warehouse" placeholder="Nombre de la sucursal">
                                </div>
                                <div class="input-field prefix">
                                    <i class="material-icons prefix black-text">room</i>
                                    <input type="text" name="edit_ubicationWh" id="edit_ubicationWh" placeholder="Ubicación de la sucursal">
                                </div>
                            </div>
                        </div>
                        <div class="center">
                            <button type="submit" class="btn" id="editWh">Editar</button>
                            <a class="modal-close btn" id="cancelbtn">Cerrar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php   
    Component::scripts('Warehouses');
?>
</body>
</html>