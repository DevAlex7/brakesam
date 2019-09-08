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
    <title>Categorias</title>
    <?php 
        Component::styles('categories');
    ?>
</head>
<body>
<?php 
    Component::navbar();
?>
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        <span class="grey-text card-title">Categorias</span>
                        <div class="row" id="searchPart">
                            <div class="col s12 m6">
                                <form  method="POST" id="createCategory">
                                    <input type="text" id="name_category" name="name_category" placeholder="Ingresa una categoria">
                                    <button class="btn" id="buttonAddCategorie">Agregar</button>
                                </form>
                            </div>
                            <div class="col s12 m12" id="rowSearch">
                                <nav class="white">
                                    <div class="nav-wrapper">
                                        <form id="search" method="POST">
                                            <div class="input-field">
                                                <input id="search" type="search" placeholder="Busca una categoria...">
                                                <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
                                                <i class="material-icons">close</i>
                                            </div>
                                        </form>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12">
                        <div id="categoriesList"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Sub categorias</span>
                <form method="POST" id="addSubCategory">
                    <div class="row">
                        <div class="col s12 m6">
                            <input type="text" name="subcategory_name" placeholder="Crea una subcategoria">
                        </div>
                        <div class="col s12 m6">
                            <select id="selectCategory" name="selectCategory">
                            </select>
                        </div>
                        <div class="center">
                            <button class="btn" id="btnaddSub">Agregar</button>
                        </div>
                    </div>
                </form>
                <div class="row" id="searchPart">
                    <div class="col s12 m12" id="rowSearchSubcategory">
                        <nav class="white">
                            <div class="nav-wrapper">
                                <form id="search" method="POST">
                                    <div class="input-field">
                                        <input id="search" type="search" placeholder="Busca una subcategoria...">
                                        <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
                                        <i class="material-icons">close</i>
                                    </div>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row" id="tableSubcategories">
                    <div class="col s12 m12">
                        <div id="subcategoriesDiv">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal white" id="modalEditCat">
    <div class="modal-content">
        <span id="editCategory">Editar Categoría</span>
        <div class="row">
            <div class="col s12 m12">
                <form method="POST" id="form-editCategory">
                    <input type="hidden" id="id_category" name="id_category">
                    <div class="input-field prefix">
                        <i class="material-icons black-text prefix">edit</i>
                        <input type="text" name="edit_category" id="edit_category">
                    </div>
                    <div class="center">
                        <button class="btn" id="editCategorybtn">Editar</button>
                        <a class="btn modal-close radius red-hover-color">cerrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal white" id="modalEditSubcategory">
    <div class="modal-content">
        <span id="editCategory">Editar subcategoría</span>
        <div class="row" id="inputFields">
            <div class="col s12 m12">
                <form method="POST" id="editSubcategory-form">
                    <input type="hidden" name="id_editsubcategory" id="id_editsubcategory">
                    <div class="input-field prefix">
                        <input type="text" name="editSubcategory" id="editSubcategory">
                        <span class="grey-text">Nombre de la subcategoria</span>
                    </div>
                    <div class="input-field prefix">
                        <select name="edit_categoryCombo" id="edit_categoryCombo"></select>
                        <span class="grey-text">Seleccione una categoria</span>
                    </div>
                    <div class="center">
                        <button type="submit" class="btn" id="editCategorybtn">Editar</button>
                        <a class="btn modal-close radius red-hover-color">Cerrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
Component::scripts('Categories');
?>
</body>
</html>