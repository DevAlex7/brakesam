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
    <link rel="stylesheet" href="Imports/resources/css/global/materialize.min.css">
    <link rel="stylesheet" href="Imports/resources/css/global/material-icons.css">
    <link rel="stylesheet" href="Imports/resources/css/utilities/categories.css">
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
                                    <input type="text" name="name_category" placeholder="Ingresa una categoria">
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
            </div>
        </div>
    </div>
</div>
<script src="Imports/resources/js/global/jquery-3.2.1.min.js"></script>
<script src="Imports/resources/js/global/materialize.min.js"></script>
<script src="helpers/functions.js"></script>
<script src="controllers/Categories.js"></script>
</body>
</html>