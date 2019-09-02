<<<<<<< HEAD
<?php 

class Auth extends Validator {
    private $id;
    private $name;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $role_id;
    private $created_at;

    public function setId($value){
        if($this->validateId($value)){
            $this->id = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setName($value){
        if($this->validateAlphabetic($value,2,150)){
            $this->name = $value;
            return true;
        }else{
            return false;
        }
    }
    public function setLastname($value){
        if($this->validateAlphabetic($value,2,150)){
            $this->lastname = $value;
            return true;
        }else{
            return false;
        }
    }
    public function setUsername($value){
        if($this->validateAlphanumeric($value,2,150)){
            $this->username = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setEmail($value){
        if($this->validateAlphanumeric($value,2,150)){
            $this->email = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setRole($value){
        if($this->validateId($value)){
            $this->role_id = $value;
            return true;
        }else{
            return false;
        }
    } 

    public function Id(){
        return $this->id;
    } 
    public function Name(){
        return $this->name;
    }
    public function Lastname(){
        return $this->lastname;
    }
    public function Username(){
        return $this->username;
    } 
    public function Email(){
        return $this->email;
    } 
    public function Role(){
        return $this->role_id;
    } 

    public function save(){
        
    }

    public function editbyId(){

    }

    public function deletebyId(){

    }

    public function all(){

    }   

    public function allbyId(){

    }
}


?>
