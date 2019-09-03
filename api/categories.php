<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/categoriesModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $category = new Categories();
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
            default:
            exit('Petición rechazada');
        }
        print(json_encode($result));
    }
    else{
        exit('Acción no definida');    
    }
?>