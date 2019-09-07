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
                    <form method="POST" id="createSupplier">
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">apartment</i>
                            <input type="text" name="name_supplier" placeholder="Nombre" id="name_supplier">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">room</i>
                            <input type="text" name="address_supplier" placeholder="Dirección" id="address_supplier">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">phone</i>
                            <input type="text" name="phone_supplier" placeholder="Numero teléfonico" id="phone_supplier">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">contact_mail</i>
                            <input type="text" name="nit_supplier" placeholder="Numero NIT" id="nit_supplier">   
                        </div>
                        <div class="input-field prefix" id="inputField">
                            <i class="material-icons prefix black-text">contact_mail</i>
                            <input type="text" name="nrc_supplier" placeholder="Numero NRC" id="nrc_supplier">   
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

    <div class="modal white" id="modalEditSuppliers">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12">
                    <span id="editWarehouse" class="center">Editar sucursal</span>
                    <p  class="grey-text">Complete los datos</p>
                    <form method="POST" id="form-updateSu">
                        <div class="row">
                            <input type="hidden" name="id_supplier" id="id_supplier">
                            <div class="col s12 m6 offset-m3">
                                <div class="input-field prefix">
                                    <i class="material-icons prefix">store</i>
                                    <input type="text" name="edit_supplier" id="edit_supplier" placeholder="Nombre del proveedor">
                                </div>
                                <div class="input-field prefix">
                                    <i class="material-icons prefix">room</i>
                                    <input type="text" name="edit_ubicationSu" id="edit_ubicationSu" placeholder="Ubicación del proveedor">
                                </div>
                                <div class="input-field prefix">
                                    <i class="material-icons prefix">phone</i>
                                    <input type="text" name="edit_phoneSu" id="edit_phoneSu" placeholder="Teléfono del proveedor">
                                </div>
                                <div class="input-field prefix">
                                    <i class="material-icons prefix">contact_mail</i>
                                    <input type="text" name="edit_nitSu" id="edit_nitSu" placeholder="NIT del proveedor">
                                </div>
                                <div class="input-field prefix">
                                    <i class="material-icons prefix">contact_mail</i>
                                    <input type="text" name="edit_nrcSu" id="edit_nrcSu" placeholder="NRC del proveedor">
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
        Component::scripts('Suppliers');
    ?>
</body>
</html>