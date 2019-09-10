<?php 
    class Component{
        public static function navbar(){
            print ' 
            <nav>
                <div class="nav-wrapper" id="navbar-template">
                    <span id="title-navbar">Breaksam</span>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="home">Inicio</a></li>
                        <li><a href="categories">Categorias</a></li>
                        <li><a href="suppliers">Proveedores</a></li>
                        <li><a href="warehouses">Sucursales</a></li>
                        <li><a href="products">Productos</a></li>
                        <li><a href="collapsible.html">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </nav>
            ';
        }
        public static function styles($cssFileName){
            print '
                <link rel="stylesheet" href="Imports/resources/css/global/materialize.min.css">
                <link rel="stylesheet" href="Imports/resources/css/global/material-icons.css">
                <link rel="stylesheet" href="Imports/resources/css/global/jquery-confirm.min.css">
                <link rel="stylesheet" href="Imports/resources/css/utilities/'.$cssFileName.'.css">
                <link rel="stylesheet" href="Imports/resources/css/utilities/navbar.css">
            ';
        }
        public static function scripts($controllerFile){
            print '
                <script src="Imports/resources/js/global/jquery-3.2.1.min.js"></script>
                <script src="Imports/resources/js/global/materialize.min.js"></script>
                <script src="Imports/resources/js/global/jquery-confirm.min.js""></script>
                <script src="helpers/functions.js"></script>
                <script src="controllers/'.$controllerFile.'.js"></script>
            ';
        }
    }
?>