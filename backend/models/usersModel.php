<?php 
date_default_timezone_set("America/El_Salvador");
class Users extends Validator {
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
        if($this->validateUsername($value)){
            $this->username = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setEmail($value){
        if($this->validateEmail(($value))){
            $this->email = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setPassword($value){
        if($this->validatePassword($value)){
            $this->password = $value;
            return true;
        }
        else{
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

    public function checkUsername()
	{
		$sql = 'SELECT id, name, lastname, email, username ,role_id, created_at FROM users WHERE username = ?';
		$params = array($this->username);
        $data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['id'];
			$this->name = $data['name'];
            $this->lastname = $data['lastname'];
            $this->email = $data['email'];
            $this->username=$data['username'];
            $this->role_id = $data['role_id'];
            $this->created_at = $data['created_at'];
			return true;
		} else {
			return false;
		}
    }
    public function checkPassword()
	{
		$sql = 'SELECT password FROM users WHERE id = ?';
		$params = array($this->id);
		$data = Database::getRow($sql, $params);
		if (password_verify($this->password, $data['password'])) {
			return true;
		} else {
			return false;
		}
	}
    public function checkEmail(){
        $sql = 'SELECT email FROM users WHERE email = ?';
		$params = array($this->email);
        $data = Database::getRow($sql, $params);
		if ($data) {
            return true;
		} else {
			return false;
		}
    }

    public function save(){
        $hash = password_hash($this->password,PASSWORD_DEFAULT);
        $sql='INSERT INTO users (name, lastname, email, username ,password, role_id, created_at) VALUES (?,?,?,?,?,?,?)';
        $params = array($this->name, $this->lastname, $this->email, $this->username, $hash, 0, date('Y-m-d') );
        return Database::executeRow($sql,$params);
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
