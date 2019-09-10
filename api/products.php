<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/productsModel.php');
    require_once('../backend/models/binnacleModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $product = new Products();
        $binnacle = new Binnacle();
        switch($_GET['action']){
            case 'insertProduct':
            if($product->setNameProduct($_POST['name_product'])){
                if($product->setProductPrice($_POST['price_product'])){
                    if($product->setProviderId($_POST['listProvider'])){
                        if($product->setCountStock($_POST['count_product'])){
                            if($product->setUbicationWarehouse($_POST['listWarehouses'])){
                                if($product->setSubCategoryId($_POST['listSubcategories'])){
                                    if(is_uploaded_file($_FILES['product_image']['tmp_name'])){
                                        if($product->setImage($_FILES['product_image'],null)){
                                            if($product->saveFile($_FILES['product_image'], $product->getRoot(), $product->getImage())){
                                                if($product->save()){   
                                                    $result['status']=1;
                                                }
                                                else{
                                                    $result['exception']='No se pudo ingresar el producto';
                                                }
                                            }
                                            else{
                                                $result['status'] = 2;
                                                $result['exception'] = 'No se guardó el archivo';
                                            }
                                        }
                                        else{
                                            $result['exception']=$gender->getImageError();                                
                                        }
                                    }
                                    else{
                                        $result['exception'] = 'Seleccione una imagen';
                                    }
                                }
                                else{
                                    $result['exception']='No se ha seleccionado una subcategoría';
                                }
                            }
                            else{
                                $result['exception']='No se ha seleccionado una sucursal';
                            }
                        }
                        else{
                            $result['exception']='Cantidad Invalida';
                        }
                    }
                    else{
                        $result['exception']='No se ha seleccionado un proveedor';
                    }
                }
                else{
                    $result['exception']='Formato de precio invalido';
                }
            }
            else{
                $result['exception']='Nombre de producto incorrecto';
            }
            break;
            case 'allProducts':
                if($product->setSubCategoryId($_POST['id_subcategory'])){
                    if($result['dataset'] = $product->getProductsbySubcategory()){
                        $result['status'] = 1;
                    }
                    else{
                        $result['exception']='No hay productos de esta categoría';
                    }
                }
                else{
                    $result['exception']='Error al obtener información';
                }
            break;
            case 'getProductbyId':
                if($product->setId($_POST['id'])){
                    if($result['dataset'] = $product->productbyId()){
                        $result['status'] = 1;
                    }
                    else{   
                        $result['exception']='No hay información';
                    }
                }
                else{
                    $result['exception']='No se ha identificado el producto';
                }
            break;
            case 'all':
                if($result['dataset'] = $product->all()){
                    $result['status'] =1;
                }
                else{
                    $result['exception'] = 'No hay productos'; 
                }
            break;
            case 'editProductbyId':
                if($product->setId($_POST['id'])){
                    if($product->setNameProduct($_POST['edit_name_product'])){
                        if($product->setProductPrice($_POST['edit_price_product'])){
                            if($product->setProviderId($_POST['editlistProvider'])){
                                if($product->setCountStock($_POST['edit_count_product'])){
                                    if($product->setUbicationWarehouse($_POST['editlistWarehouses'])){
                                        if($product->setSubCategoryId($_POST['editlistSubcategories'])){

                                            if (is_uploaded_file($_FILES['edit_product_image']['tmp_name'])) {
                                                if ($product->setImage($_FILES['edit_product_image'], $_POST['pic_image'])) {
                                                    $file = true;        
                                                } else {
                                                    $result['exception'] = $product->getImageError();
                                                    $file = false;
                                                }
                                            } 
                                            else {
                                                if ($product->setImage(null, $_POST['pic_image'])) {
                                                    $result['exception'] = 'No se subió ningún archivo';
                                                } else {
                                                    $result['exception'] = $product->getImageError();
                                                }
                                                $file = false;
                                            }

                                        }
                                        else{
                                            $result['exception']='No se ha seleccionado una subcategoría';
                                        }
                                    }
                                    else{
                                        $result['exception']='No se ha seleccionado un almacen';
                                    }
                                }
                                else{
                                    $result['exception']='Cantidad de producto invalido';
                                }
                            }
                            else{
                                $result['exception']='No se ha seleccionado un proveedor';
                            }
                        }
                        else{
                            $result['exception']='Precio invalido de producto';
                        }
                    }
                    else{
                        $result['exception']='Nombre de producto invalido';
                    }

                    if ($product->editbyId()) {
                        if ($file) {
                            if ($product->saveFile($_FILES['edit_product_image'], $product->getRoot(), $product->getImage() )) {
                                if($product->deleteFile($product->getRoot(), $_POST['pic_image'])){
                                    $result['status'] = 1;
                                }
                                else{
                                    $result['status']=0;
                                    $result['exception']='No se borro la imagen, al cambiar';
                                }
                            } else {
                                $result['status'] = 2;
                                $result['exception'] = 'No se guardó el archivo';
                            }
                        } else {
                            $result['status'] = 3;
                        }
                    } else {
                        $result['exception'] = 'Operación fallida';
                    }
                }
                else{
                    $result['exception'] = 'No se ha identificado al producto';
                }
            break;
            case 'deletebyId':
                if($product->setId($_POST['id'])){
                    if ($product->deletebyId()){
                        if ($product->deleteFile($product->getRoot(), $_POST['image'])) {
                            $result['status'] = 1;
                        } else {
                            $result['status'] = 2;
                            $result['exception'] = 'No se borró el archivo';
                        }
                    } else {
                        $result['exception'] = 'Operación fallida';
                    }
                }
                else{
                    $result['exception'] = 'No se ha identificado al producto';
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