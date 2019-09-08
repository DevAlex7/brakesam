<?php 
class Products extends Validator {
    private $id;
    private $product_name;
    private $product_price;
    private $provider_id;
    private $count_stock;
    private $ubication_warehouse;
    private $subcategory_id;
    private $image;
    private $root='../Imports/resources/pics/products/';

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
    public function setPrice($value){
        if($this->validateMoney(($value))){
            $this->count_stock = $value;
            return true;
        }else{
            return false;
        }
    } 
    public function setUbicationWarehouse($value){
        if($this->validateId($value)){
            $this->ubication_warehouse = $value;
            return true;
        }
        else{
            return false;
        }
    }
    public function setSubCategoryId($value){
        if($this->validateId($value)){
            $this->subcategory_id = $value;
            return true;
        }else{
            return false;
        }
    } 

    public function setImage($file, $name){
        if($this->validateImageFile($file, $this->root, $name, 500, 500)){
            $this->image=$this->getImageName();
            return true;
        }
        else{
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
        return $this->subcategory_id;
    } 
    public function getImage(){
        return $this->image;
    }
    public function getRoot(){
        return $this->root;
    }

    public function save(){
        $sql='INSERT INTO products VALUES (NULL, ?,?,?,?,?,?,?)';
        $params = array(
        $this->product_name, $this->product_price, $this->provider_id, 
        $this->count_stock, $this->ubication_warehouse, $this->subcategory_id, $this->image);
        return Database::executeRow($sql,$params);
    }

    public function editbyId(){

    }

    public function deletebyId(){

    }

    public function all(){

    }   
    public function getProductsbySubcategory(){
        $sql='SELECT products.* FROM (products INNER JOIN subcategories_products ON products.subcategory_id = subcategories_products.id) WHERE subcategories_products.id = ?';
        $params = array($this->subcategory_id);
        return Database::getRows($sql,$params);
    }
    public function allbyId(){
        
    }
}


?>