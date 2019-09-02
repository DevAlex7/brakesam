<?php 
class Products extends Validator {
    private $id;
    private $product_name;
    private $product_price;
    private $provider_id;
    private $count_stock;
    private $ubication_warehouse;
    private $category_id;

    public function setId($value){
        if($this->validateId($value)){
            $this->id = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setNameProduct($value){
        if($this->validateAlphabetic($value,2,150)){
            $this->product_name = $value;
            return true;
        }else{
            return false;
        }
    }
    public function setProductPrice($value){
        if($this->validateMoney($value)){
            $this->product_price = $value;
            return true;
        }else{
            return false;
        }
    }
    public function setProviderId($value){
        if($this->validateId($value)){
            $this->provider_id = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setCountStock($value){
        if($this->validateId(($value))){
            $this->count_stock = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setUbicationWarehouse($value){
        if($this->id($value)){
            $this->ubication_warehouse = $value;
            return true;
        }
        else{
            return false;
        }
    }
    public function setCategoryId($value){
        if($this->validateId($value)){
            $this->category_id = $value;
            return true;
        }else{
            return false;
        }
    } 

    public function Id(){
        return $this->id;
    } 
    public function getProductName(){
        return $this->product_name;
    }
    public function getProductPrice(){
        return $this->product_price;
    }
    public function getProvider(){
        return $this->provider_id;
    } 
    public function getCountStock(){
        return $this->count_stock;
    } 
    public function getUbicationWarehouse(){
        return $this->ubication_warehouse;
    } 
    public function getCategoryId(){
        return $this->category_id   ;
    } 

    public function save(){
        $sql='INSERT INTO ';
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

?>