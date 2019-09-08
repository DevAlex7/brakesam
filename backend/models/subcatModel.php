<?php
class Subcategories extends Validator
{
    //Declarando propiedades
    private $id = null;
    private $subcategory = null;
    private $idCat = null;
    

    //Métodos para sobrecargar propiedades
    public function setId($value)
    {
        if ($this->validateId($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSubCategory($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->subcategory = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getSubCategory()
    {
        return $this->subcategory;
    }

    public function setIdCat($value)
    {
        if ($this->validateId($value)) {
            $this->idCat = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdCat()
    {
        return $this->idCat;
    }

    

    //Metodos para manejar el CRUD u operaciones básicas, agregar, leer, eliminar y modificar

    public function createsubCategory()
    {
        $sql = 'INSERT INTO subcategories_products(subcategory, category_id) VALUES (?, ?)';
        $params = array($this->subcategory, $this->idCat);
        return Database::executeRow($sql, $params);   
    }

    public function updatesubCategory()
    {
        $sql = 'UPDATE subcategories_products SET subcategory = ?, category_id= ?  WHERE id = ?';
        $params = array($this->subcategory, $this->idCat, $this->id);
        return Database::executeRow($sql, $params);   
    }

    public function deletesubCategory()
    {
        $sql = 'DELETE FROM subcategories_products WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function readsubCategory()
    {
        $sql = 'SELECT subcategories_products.id AS id_subcategory, subcategories_products.subcategory, categories_products.category FROM (subcategories_products INNER JOIN categories_products ON categories_products.id = subcategories_products.category_id) ORDER BY subcategories_products.id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getSubCategorybyId()
    {
        $sql = 'SELECT subcategories_products.id AS id_subcategory, subcategories_products.subcategory, categories_products.id AS id_category FROM (subcategories_products INNER JOIN categories_products ON categories_products.id = subcategories_products.category_id) WHERE subcategories_products.id =?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function getSubcategoriesbyCategories(){
        $sql = '
            SELECT subcategories_products.subcategory, COUNT(products.id) AS number_products
            FROM subcategories_products 
            LEFT OUTER JOIN products ON 
            subcategories_products.id = products.subcategory_id 
            LEFT JOIN categories_products ON 
            categories_products.id = subcategories_products.category_id 
            WHERE categories_products.id = ? GROUP BY subcategories_products.subcategory
        ';
        $params = array($this->idCat);
        return Database::getRows($sql,$params);
    }
}