<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/productsModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $product = new Products();
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
            default:
            exit('Petición rechazada');
        }
        print(json_encode($result));
    }
    else{
        exit('Acción no definida');    
    }
?>