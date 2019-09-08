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
            case 'categoriesWithSubcategories':
                if($result['dataset'] = $category->getCategoriesWithSubCategories()){
                    $result['status']=1;
                }
                else{
                    $result['exception']='No se ha encontrado información';
                }
            break;
            case 'getSubcategoriesbyCategories':
                if($subCategory->setIdCat($_POST['id'])){
                    if($result['dataset'] = $subCategory->getSubcategoriesbyCategories()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No hay subcategorías';
                    }
                }
                else{
                    $result['exception']='No se ha definido la categoría';
                }
            break;
            case 'getCategorybyId':
                if($category->setId($_POST['id'])){
                    if($result['dataset'] = $category->getCategorybyId()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No se pudo obtener la categoría';
                    }
                }
                else{
                    $result['exception']='Ha ocurrido un problema con la información';
                }
            break;
            case 'editCategory':
            if($category->setId($_POST['id_category'])){
                if($category->setCategory($_POST['edit_category'])){
                    if($category->updateCategory()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No se pudo actualizar la categoria';
                    }
                }
                else{
                    $result['exception']='Nombre de la categoria invalido';
                }
            }
            else{
                $result['exception']='Ha ocurrido un problema con la información';
            }
            break;
            case 'deleteCategory':
                if($category->setId($_POST['id'])){
                    if($category->deleteCategory()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No se pudo eliminar la categoría';
                    }   
                }
                else{
                    $result['exception']='Ha ocurrido un problema con la información';
                }
            break;
            case 'getSubcategorybyId':
                if($subCategory->setId($_POST['id'])){
                    if($result['dataset'] = $subCategory->getSubCategorybyId()){
                        $result['status'] = 1;
                    }
                    else{
                        $result['exception']='No se encontro nada en esta subcategoría';
                    }
                }
                else{
                    $result['exception']='Ha ocurrido un problema con la información';
                }
            break;
            case 'updateSubCategory':
                if($subCategory->setId($_POST['id_editsubcategory'])){
                    if($subCategory->setSubCategory($_POST['editSubcategory'])){
                        if($subCategory->setIdCat($_POST['edit_categoryCombo'])){
                            if($subCategory->updatesubCategory()){
                                $result['status'] = 1;
                            }
                            else{
                                $result['exception'] = 'No se actualizo la subcategoria';
                            }
                        }
                        else{
                            $result['exception'] = 'No has seleccionado ninguna categoría';
                        }
                    }
                    else{
                        $result['exception'] = 'Nombre de subcategoria invalido';
                    }
                }
                else{
                    $result['exception']='No se pudo obtener la subcategoría';
                }
            break;
            case 'deleteSubcategorie':
                if($subCategory->setId($_POST['id'])){
                    if($subCategory->deletesubCategory()){
                        $result['status']=1;
                    }
                    else{
                        $result['exception']='No se pudo eliminar la subcategoria';
                    }
                }
                else{
                    $result['exception']='No se pudo obtener la subcategoría';
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