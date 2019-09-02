<?php 
    require_once('../helpers/validator.php');
    require_once('../backend/models/usersModel.php');
    require_once('../backend/database/database.php');

    session_start();
    $result = array('status'=>0, 'exception'=>'');
    
    if( isset($_GET['action']) ){
        $users = new Users();
        switch($_GET['action']){
            case 'signup':
                if( $users->setName($_POST['nameUser']) ){
                    if( $users->setLastname($_POST['lastnameUser']) ){
                        if( $users->setEmail($_POST['emailUser']) ){
                            if( $users->setUsername($_POST['Username']) ){
                                if( $users->setPassword($_POST['keyuser']) ){
                                    if( $_POST['keyuser'] != $_POST['Username']){
                                        if( !$users->checkEmail() ){
                                            if(!$users->checkUsername()){
                                                if($_POST['keyuser'] == $_POST['keyuser2']){
                                                    if($users->save()){
                                                        $result['status']=1;
                                                    }
                                                    else{
                                                        $result['exception']='No se puedo crear el perfil';
                                                    }
                                                }
                                                else{
                                                    $result['exception']='Las contraseñas no son iguales';
                                                }
                                            }
                                            else{
                                                $result['exception']='Usuario existente';
                                            }
                                        }
                                        else{
                                            $result['exception']='Email existente';
                                        }
                                    }
                                    else{
                                        $result['exception']='La contraseña no puede ser igual que el usuario';
                                    }
                                }
                                else{
                                    $result['exception']='La contraseña no cumple con lo requerido de 8 carácteres';
                                }
                            }
                            else{
                                $result['exception']='El usuario no cumple los requerimientos solicitados';
                            }   
                        }
                        else{
                            $result['exception']='El ingreso de correo tiene el formato incorrecto';
                        }
                    }else{
                        $result['exception']='El campo apellido no cumple los requerimientos solicitados';
                    }
                }
                else{
                    $result['exception']='El campo nombre no cumple los requerimientos solicitados';
                }
            break;
            case 'login':
                
                if($users->setUsername($_POST['Username'])){
                    if($users->setPassword($_POST['key'])){
                        if( 
                            $users->checkUsername() && $users->checkPassword()
                        ){
                            $users->openSession();
                            $result['status']=1;
                        }
                        else{
                            $result['exception']='Usuario o contraseña incorrectos';
                        }
                    }
                    else{
                        $result['exception']='Ingrese su contraseña para verificar';
                    }
                }
                else{
                    $result['exception']='Ingrese su usuario para verificar';
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