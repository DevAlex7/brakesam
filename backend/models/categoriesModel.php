<?php
class Categories extends Validator
{
    //Declarando propiedades
    private $id = null;
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

    public function createCategory()
    {
        $sql = 'INSERT INTO categories_products(category) VALUES (?)';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function updateCategory()
    {
        $sql = 'UPDATE categories_products SET category = ? WHERE id = ?';
        $params = array($this->category);
        return Database::executeRow($sql, $params);   
    }

    public function deleteCategory()
    {
        $sql = 'DELETE FROM categories_products WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function readCategory()
    {
        $sql = 'SELECT id, category FROM categories_products ORDER BY id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getCategoryNone()
    {
        $sql = 'SELECT id, category FROM categories_products WHERE id = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}