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
            if ($supplier->setEnterpriseName($_POST['enterprise_name'])) {
                if ($supplier->setUbication($_POST['ubication'])) {
                    if ($supplier->setPhone($_POST['cellphone'])) {
                        if($supplier->setNit($_POST['NIT'])) {
                            if ($supplier->setNrc($_POST['NRC'])) {
                                if($supplier->setDate($_POST['date_created'])) {
                                    if ($supplier->createCategory()) {
                                         $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Fallo al crear la categoría';
                                    }
                                } else {
                                    $result['exception'] = 'Fecha incorrecta';
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
            if ($supplier->setEnterpriseName($_POST['enterprise_name'])) {
                if ($supplier->setUbication($_POST['ubication'])) {
                    if ($supplier->setPhone($_POST['cellphone'])) {
                        if ($supplier->setNit($_POST['NIT'])) {
                            if ($supplier->setNrc($_POST['NRC'])) {
                                if ($supplier->setDate($_POST['date_created'])) {
                                    if($supplier->updateSupplier()) {
                                        $result['status'] = 1;
                                    } else {
                                        $result['exception'] = 'Fallo al actualizar información';
                                    }

                                } else {
                                    $result['exception'] = 'No se puede actualizar la fecha de creación'
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
        break;
        case 'deleteSupplier':
        break;
        default:
            exit('Petición rechazada');
    }
    print(json_encode($result));
} else {
    exit('Acción no definida');
}
