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
                        <li><a href="badges.html">Proveedores</a></li>
                        <li><a href="collapsible.html">Productos</a></li>
                        <li><a href="collapsible.html">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </nav>
            ';
        }
    }
?>