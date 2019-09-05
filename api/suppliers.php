<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/suppliersModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $supplier = new Suppliers();
        switch($_GET['action']){
            case 'getallSuppliers':
                if($result['dataset'] = $supplier->readSuppliers()){
                    $result['status']=1;
                }
                else{
                    $result['exception']='No hay proveedores disponibles';
                }
            break;
            default:
            exit('Petición rechazada');
        }
        print(json_encode($result));
    }
    else{
        exit('Acción no definida');    
    }
?>