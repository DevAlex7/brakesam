<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/categoriesModel.php');
    require_once('../backend/models/subcatModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $category = new Categories();
        $subCategory =  new Subcategories();
        switch($_GET['action']){
            case 'allCategories':
                if($result['dataset'] = $category->readAllCategories())
                {      
                    $result['status']=1;
                }
                else{
                    $result['exception']='No hay categorias todavia';
                }
            break;  
            case 'createCategory':
                if($category->setCategory($_POST['name_category'])){
                    if($category->createCategory()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='Fallo al crear la categoría';
                    }
                }
                else{
                    $result['exception']='Nombre de la categoria invalido';
                }
            break;
            case 'createSubcategory':
            if(isset($_POST['selectCategory'])){
                if($subCategory->setSubCategory($_POST['subcategory_name'])){
                    if($subCategory->setIdCat($_POST['selectCategory'])){ 
                        if($subCategory->createsubCategory()){
                            $result['status']=1;
                        }
                        else{
                            $result['exception']='Fallo al crear la subcategoria';
                        }
                    }
                    else{
                        $result['exception']='No se ha seleccionado una categoria';
                    }
                }
                else{
                    $result['exception']='El nombre de la subcategoria es invalido';
                }
            }   
            else{
                $result['exception']='No se ha seleccionado una categoria';
            } 
            break;
            case 'allSubCategories':
                if($result['dataset'] = $subCategory->readsubCategory()){
                    $result['status']=1;
                }
                else{
                    $result['exception'] ='No hay subcategorias agregadas';
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