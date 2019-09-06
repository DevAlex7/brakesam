<?php
require_once('../helpers/validator.php');
require_once('../backend/models/warehousesModel.php');
require_once('../backend/database/database.php');

session_start();
$result = array('status' => 0, 'exception' => '');

if (isset($_GET['action'])) {
    $warehouse = new Warehouses();
    switch ($_GET['action']) {
        case 'readWarehouses':
            if($result['dataset'] = $warehouse->readWarehouse()){
                $result['status'] =1;
            }
            else{
                $result['exception'] = 'No hay sucursales';
            }
        break;
        case 'insertWarehouse':
            if($warehouse->setHouse($_POST['name_warehouse'])){
                if($warehouse->setUbicationHouse($_POST['ubication_warehouse'])){
                    if($warehouse->createWarehouse()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No se creo la sucursal';
                    }
                }
                else{
                    $result['exception']='Nombre de sucursal invalido';
                }
            }
            else{
                $result['exception']='Nombre de sucursal invalido';
            }
        break;
        default:
            exit('Petición rechazada');
    }
    print(json_encode($result));
} else {
    exit('Acción no definida');
}
