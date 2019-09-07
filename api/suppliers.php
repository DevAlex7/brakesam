<?php
require_once('../helpers/validator.php');
require_once('../backend/models/suppliersModel.php');
require_once('../backend/database/database.php');

session_start();
$result = array('status' => 0, 'exception' => '');

if (isset($_GET['action'])) {
    $supplier = new Suppliers();
    switch ($_GET['action']) {
        case 'getallSuppliers':
            if ($result['dataset'] = $supplier->readSuppliers()) {
                $result['status'] = 1;
            } else {
                $result['exception'] = 'No hay proveedores disponibles';
            }
        break;
        case 'createSupplier':
            if ($supplier->setEnterpriseName($_POST['name_supplier'])) {
                if ($supplier->setUbication($_POST['address_supplier'])) {
                    if ($supplier->setPhone($_POST['phone_supplier'])) {
                        if($supplier->setNit($_POST['nit_supplier'])) {
                            if ($supplier->setNrc($_POST['nrc_supplier'])) {
                                if ($supplier->createSupplier()) {
                                        $result['status'] = 1;
                                } else {
                                    $result['exception'] = 'Fallo al crear la categoría';
                                }
                            } else {
                                $result['exception'] = 'NRC incorrecto ';
                            }
                        } else {
                            $result['exception'] = 'Número de Identificación Tributaria incorrecto';
                        }
                    } else {
                        $result['exception'] = 'Teléfono incorrecto';
                    }
                }else {
                    $result['exception'] = 'Ubicación desconocida';
                }
            } else {
                $result['exception'] = 'Nombre de la categoria invalido';
            }
        break;
        case 'updateSupplier':
            if($supplier->setId($_POST['id_supplier'])) {
            if ($supplier->setEnterpriseName($_POST['edit_supplier'])) {
                if ($supplier->setUbication($_POST['edit_ubicationSu'])) {
                    if ($supplier->setPhone($_POST['edit_phoneSu'])) {
                        if ($supplier->setNit($_POST['edit_nitSu'])) {
                            if ($supplier->setNrc($_POST['edit_nrcSu'])) {
                                    if($supplier->updateSupplier()) {
                                        $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Fallo al actualizar información';
                                    }
                            
                            } else {
                                $result['exception'] = 'No se puede actualizar el NRC';
                            }
                        } else {
                            $result['exception'] = 'No se puede actualizar el NIT';
                        }
                    } else {
                        $result['exception'] = 'No se puede actualizar el teléfono';
                    }
                } else {
                    $result ['exception'] = 'No se puede actualizar la ubicación';
                }
            } else {
                $result['exception'] = 'No se puede actualizar el nombre del proveedor';
            }
        } else {
            $result['exception'] = 'id desconocido';
        }

        break;
        case 'readSupplier':
        if($result['dataset'] = $supplier->readSuppliers()){
            $result['status']=1;
        }
        else{
            $result['exception'] ='No hay proveedores agregadas';
        }
        break;
        case 'deleteSupplier':
        if ($supplier->setId($_POST['id'])){
            if($supplier->deleteSupplier()) {
                $result['status'] = 1;
            } else {
                $result['exception'] = 'No se puede eliminar este proveedor';
            }

        } else {
            $result['exception'] = 'Id desconocido';
        }
        break;
        case 'supplierbyId':
            if($supplier->setId($_POST['id'])){
                if($result['dataset'] = $supplier->getSupplierbyId()){
                    $result['status']=1;
                }
                else{
                    $result['exception']='Proveedor no encontrado';
                }
            }
            else{
                $result['exception']='No se ha encontrado información del proveedor';
            }
        break;
        default:
            exit('Petición rechazada');
    }
    print(json_encode($result));
} else {
    exit('Acción no definida');
}
