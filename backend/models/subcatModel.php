<?php
class Subcategories extends Validator
{
    //Declarando propiedades
    private $id = null;
    private $idCat = null;
    private $category = null;

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

    public function setCategory($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->category = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getCategory()
    {
        return $this->category;
    }

    //Metodos para manejar el CRUD u operaciones básicas, agregar, leer, eliminar y modificar

    public function createsubCategory()
    {
        $sql = 'INSERT INTO subcategories_products(subcategory, category_id) VALUES (?, ?)';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function updatesubCategory()
    {
        $sql = 'UPDATE subcategories_products SET subcategory = ?, category_id= ?  WHERE id = ?';
        $params = array($this->category, $this->idCat);
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
        $sql = 'SELECT id, subcategory, category_id, category FROM subcategories_products INNER JOIN categories_products cat ON cat.category_id ORDER BY id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getsubCategoryNone()
    {
        $sql = 'SELECT id, subcategory, category_id, category FROM categories_products INNER JOIN categories_products cat ON cat.category_id WHERE id = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}