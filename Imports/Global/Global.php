<?php 
include 'config/server.php';
class ImportGlobal{

    //To import the Global Materialize Library
    public static function ImportMaterializeCss(){
        print 
        '<link rel="stylesheet" href="'.print SERVERULR.'Imports/resources/css/global/materialize.min.css">';
    }

    //To import the file to put style page
    public static function ImportFileCss($fileCss){
        print
        '<link rel="stylesheet" href="../Imports/resources/css/utilities/'. $fileCss .'.css">';
    }
    public static function ImportFont(){
        print
        '<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
        ';
    }
    public static function ImportSidenavCss($sidenavCss){
        print 
        '<link rel="stylesheet" href="../Imports/resources/css/Global/'. $sidenavCss. '.css">';
    }
    public static function ImportMaterialIcons(){
        print 
        '<link rel="stylesheet" href="http://localhost/breaksam/Imports/resources/css/Global/material-icons.css">';
    }
    public static function ImportIco(){
        print ('
            <link rel="shortcut icon" type="image/x-icon" href="../Imports/resources/pics/utilities/ico.png"></link>
        ');
    }
    //To import the Global Jquery 
    public static function ImportJQuery(){
        print 
        '<script src="../Imports/resources/js/global/jquery-3.2.1.min.js"></script>';
    }
    public static function ImportSaveFile(){
        print 
        '<script src="../Imports/resources/js/global/FileSaver.min.js"></script>';
    }
    public static function ImportBlob(){
        print 
        '<script src="../Imports/resources/js/global/canvas-to-blob.js"></script>';
    }
    //To import the Global Materialize Js
    public static function ImportMaterializeJS(){
        print 
        '<script src="../Imports/resources/js/global/materialize.min.js"></script>';
    }
    //To import inactivy code
    public static function ImportInactivity(){
        print 
        '<script src="../Helpers/Inactivity.js"></script>';
    }
    //To import the global JS functions
    public static function ImportJSFunctions(){
        print 
        '<script src="../Helpers/functions.js"></script>';
    }
    public static function ImportChart(){
        print 
        '<script src="../Imports/resources/js/global/chart.js"></script>';
    }
    public static function ImportComponentChart(){
        print 
        '<script src="../Helpers/components.js"></script>';
    }
    public static function ImportInactivityPHP(){
        require_once('../Helpers/Inactivity.php');
    }
    //To import the Controller that you will use :)
    public static function ImportControllerJs($Controller){
        print 
        '<script src="../Http/Controllers/'.$Controller.'.js"></script>';
    }

    public static function ImportChartHelpers($Controller){
        print 
        '<script src="../Helpers/'.$Controller.'.js"></script>';
    }

    public static function ImportRoutesJs(){
        print 
        '<script src="../Helpers/router.js"></script>';
    }
    public static function ImportMomentJS(){
        print 
        '<script src="../Imports/resources/js/global/moment.min.js"></script>';
    }
    
    public static function ImportFooter(){
        print 
        '  
        <div class="container red">
            <div class="row">
                <div class="col l6 s12">
                <h5 class="white-text">Distribuidora Illussion</h5>
                <p class="grey-text text-lighten-4">Tu organizador de eventos, más especializado.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                <h6 class="white-text">¡Puedes encontrarnos en donde sea!</h6>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">YouTube</a></li>
                </ul>
                </div>
            </div>
        </div>
        ';
    }
    
    /** Funciones para sitios publicos  */
    
    public static function ImportPublicMaterializeCss(){
        print 
        '<link rel="stylesheet" href="Imports/resources/css/global/materialize.min.css">';
    }
    public static function ImportPublicFileCss($fileCss){
        print
        '<link rel="stylesheet" href="Imports/resources/css/utilities/'. $fileCss .'.css">';
    }
    public static function publicStyle(){
        print ('
            <link rel="stylesheet" href="Imports/resources/css/utilities/style.css"></link>
        ');
    }
    public static function publicIco(){
        print ('
            <link rel="shortcut icon" type="image/x-icon" href="Imports/resources/pics/utilities/ico.png"></link>
        ');
    }
   
    public static function ImportPublicMaterialIcons(){
        print 
        '<link rel="stylesheet" href="Imports/resources/css/Global/material-icons.css">';
    }
    //To import the Global Jquery 
    public static function ImportPublicJQuery(){
        print 
        '<script src="Imports/resources/js/global/jquery-3.2.1.min.js"></script>';
    }
    
    //To import the Global Materialize Js
    public static function ImportPublicMaterializeJS(){
        print 
        '<script src="Imports/resources/js/global/materialize.min.js"></script>';
    }
    //To import the global JS functions
    public static function ImportPublicJSFunctions(){
        print 
        '<script src="Helpers/functions.js"></script>';
    }
    //To import the Controller that you will use :)
    public static function ImportPublicControllerJs($Controller){
        print 
        '<script src="Http/Public/'.$Controller.'.js"></script>';
    }
    
    public static function ImportPublicPlugin(){
        print 
        '<script src="Imports/resources/js/global/plugin.js"></script>';
    }
    public static function ImportPublicInits(){
        print 
        '<script src="Imports/resources/js/global/inits.js"></script>';
    }
    
}
?>