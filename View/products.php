<?php 
    require_once('helpers/components.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
    <?php 
        Component::styles('products');
    ?>
</head>
<body>
    <?php 
        Component::navbar();
    ?>
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <div class="center">
                        <span id="titleProducts">Productos</span>
                    </div>
                    <table id="table">
                        <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Cantidad</th>
                            <th>Sucursal</th>
                            <th>Subcategoría</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody id="tableProducts">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalEditProduct">
        <div class="modal-content">
            <div class="center">
                <span id="titleProducts">Editar producto</span>
                <form method="POST" id="form-updateProduct">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="pic_image" id="pic_image">
                    <div class="input-field prefix">
                        <input type="text" name="edit_name_product" id="edit_name_product" placeholder="Nombre">
                    </div>

                    <div class="input-field prefix">
                        <input type="text" name="edit_price_product" id="edit_price_product" placeholder="Precio">
                    </div>

                    <div class="input-field prefix">
                        <select name="editlistProvider" id="editlistProvider"></select>
                    </div>

                    <div class="input-field prefix">
                        <input type="text" name="edit_count_product" id="edit_count_product" placeholder="Cantidad">
                    </div>

                    <div class="input-field prefix">
                        <select name="editlistWarehouses" id="editlistWarehouses"></select>
                    </div>

                    <div class="input-field prefix">
                        <select name="editlistSubcategories" id="editlistSubcategories"></select>
                    </div>

                    <div class="file-field input-field col s12 m9" id="TimeSection">
                        <div class="btn waves-effect">
                            <span><i class="material-icons">image</i></span>
                            <input 
                            id="edit_product_image" 
                            type="file" 
                            name="edit_product_image" 
                            />
                        </div>
                        <div class="file-path-wrapper">
                            <input type="text" name="edit_image" id="edit_image" class="file-path validate" placeholder="Seleccione una imagen"/>
                        </div>
                    </div>
                    <div class="center">
                        <button type="submit" class="btn-large" id="addProductBtn">Agregar</button>
                        <a class="btn-large red-cover grey button-rounded">Cancelar</a>
                    </div>
                </form>
            </div>                
        </div>
    </div>
    <?php 
        Component::scripts('Products');
    ?>
</body>
</html>