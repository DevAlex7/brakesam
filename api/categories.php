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